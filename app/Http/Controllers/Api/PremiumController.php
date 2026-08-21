<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PremiumPlans;
use App\Models\PremiumSubscriptions;
use App\Models\Payments;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PremiumController extends Controller
{
    /**
     * GET /api/premium/plans
     *
     * Return all active Premium plans.
     */
    public function plans()
    {
        $plans = PremiumPlans::where('Active', true)
            ->orderBy('DurationMonths')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $plans,
        ]);
    }

    /**
     * GET /api/premium/status
     *
     * Return the authenticated user's current Premium status.
     */
    public function status(Request $request)
    {
        $user = $request->user();

        $this->syncPremiumStatus($user);

        $subscription = PremiumSubscriptions::with(['plan', 'payment'])
            ->where('IdUser', $user->IdUser)
            ->where('Status', 'active')
            ->where('PaymentStatus', 'paid')
            ->where('EndDate', '>', now())
            ->latest('IdPremiumSubscription')
            ->first();

        return response()->json([
            'success' => true,
            'data' => [
                'IdUser' => $user->IdUser,
                'is_premium' => (bool) $user->IsPremuim,
                'premium_started_at' => $user->PremiumStartedAt,
                'premium_expiry' => $user->PremiumExpiry,
                'subscription' => $subscription,
            ],
        ]);
    }

    /**
     * POST /api/premium/subscribe
     *
     * Create a Premium subscription and its payment.
     *
     * The subscription stays pending until the payment becomes paid.
     */
    public function subscribe(Request $request)
    {
        $data = $request->validate([
            'IdPremiumPlan' => [
                'required',
                'integer',
                'exists:PremiumPlans,IdPremiumPlan',
            ],

            'Method' => [
                'required',
                'string',
                'max:40',
            ],
        ]);

        $user = $request->user();

        // Synchronize expiration before checking whether the user is Premium.
        $this->syncPremiumStatus($user);

        /*
         * A user cannot create a second active subscription.
         */
        $existing = PremiumSubscriptions::where('IdUser', $user->IdUser)
            ->where('Status', 'active')
            ->where('PaymentStatus', 'paid')
            ->where('EndDate', '>', now())
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'You already have an active Premium subscription.',
                'premium_expiry' => $existing->EndDate,
            ], 409);
        }

        $plan = PremiumPlans::where('IdPremiumPlan', $data['IdPremiumPlan'])
            ->where('Active', true)
            ->first();

        if (!$plan) {
            return response()->json([
                'success' => false,
                'message' => 'Premium plan is not available.',
            ], 404);
        }

        $subscription = DB::transaction(function () use ($user, $plan, $data) {

            /*
             * Create payment first.
             */
            $payment = Payments::create([
                'IdUser' => $user->IdUser,
                'IdOrder' => null,
                'Amount' => $plan->Price,
                'Method' => $data['Method'],
                'Status' => 'pending',
                'Reference' => 'PREMIUM-' . strtoupper(Str::random(10)),
                'TransactionId' => null,
                'CreatedAt' => now(),
                'PaidAt' => null,
            ]);

            /*
             * Subscription is pending until payment is completed.
             */
            $subscription = PremiumSubscriptions::create([
                'IdUser' => $user->IdUser,
                'IdPremiumPlan' => $plan->IdPremiumPlan,
                'IdPayment' => $payment->IdPayment,

                'Price' => $plan->Price,
                'Currency' => $plan->Currency,

                'StartDate' => now(),

                // Temporary end date.
                // It will be recalculated when payment succeeds.
                'EndDate' => now()->copy()
                    ->addMonths((int) $plan->DurationMonths),

                'Status' => 'pending',
                'PaymentStatus' => 'pending',

                'CancelledAt' => null,
                'CreatedAt' => now(),
                'UpdatedAt' => now(),
            ]);

            return $subscription;
        });

        return response()->json([
            'success' => true,
            'message' => 'Premium subscription created. Payment is pending.',
            'data' => $subscription->load(['plan', 'payment']),
        ], 201);
    }

    /**
     * POST /api/premium/{subscription}/activate
     *
     * INTERNAL/TEST endpoint.
     *
     * In production, this should normally be called by the payment gateway
     * callback/webhook instead of directly by the user.
     */
    public function activate(Request $request, $subscription)
    {
        $user = $request->user();

        $subscription = PremiumSubscriptions::with(['plan', 'payment'])
            ->where('IdPremiumSubscription', $subscription)
            ->where('IdUser', $user->IdUser)
            ->first();

        if (!$subscription) {
            return response()->json([
                'success' => false,
                'message' => 'Premium subscription not found.',
            ], 404);
        }

        if ($subscription->Status === 'cancelled') {
            return response()->json([
                'success' => false,
                'message' => 'Cancelled subscription cannot be activated.',
            ], 422);
        }

        if (!$subscription->payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found.',
            ], 422);
        }

        if ($subscription->payment->Status === 'paid') {
            return response()->json([
                'success' => false,
                'message' => 'This payment has already been completed.',
            ], 409);
        }

        DB::transaction(function () use ($subscription, $user) {

            $now = now();

            /*
             * Mark payment as paid.
             */
            $payment = Payments::lockForUpdate()
                ->findOrFail($subscription->IdPayment);

            $payment->Status = 'paid';
            $payment->PaidAt = $now;
            $payment->save();

            /*
             * Calculate the real Premium period.
             */
            $startDate = $now;

            $endDate = $startDate->copy()
                ->addMonths((int) $subscription->plan->DurationMonths);

            $subscription->StartDate = $startDate;
            $subscription->EndDate = $endDate;
            $subscription->PaymentStatus = 'paid';
            $subscription->Status = 'active';
            $subscription->save();

            /*
             * Synchronize Users table.
             */
            $user->IsPremuim = true;
            $user->PremiumStartedAt = $startDate;
            $user->PremiumExpiry = $endDate;
            $user->save();
        });

        return response()->json([
            'success' => true,
            'message' => 'Premium activated successfully.',
            'data' => [
                'subscription' => $subscription->fresh()->load([
                    'plan',
                    'payment',
                ]),
                'is_premium' => true,
                'premium_started_at' => $user->PremiumStartedAt,
                'premium_expiry' => $user->PremiumExpiry,
            ],
        ]);
    }

    /**
     * POST /api/premium/{subscription}/cancel
     *
     * Cancel a Premium subscription.
     *
     * We do NOT immediately delete Premium access.
     * The user keeps Premium until EndDate.
     */
    public function cancel(Request $request, $subscription)
    {
        $user = $request->user();

        $subscription = PremiumSubscriptions::where(
            'IdPremiumSubscription',
            $subscription
        )
            ->where('IdUser', $user->IdUser)
            ->first();

        if (!$subscription) {
            return response()->json([
                'success' => false,
                'message' => 'Premium subscription not found.',
            ], 404);
        }

        if ($subscription->Status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Only an active Premium subscription can be cancelled.',
            ], 422);
        }

        if ($subscription->EndDate <= now()) {
            $this->syncPremiumStatus($user);

            return response()->json([
                'success' => false,
                'message' => 'Premium subscription has already expired.',
            ], 422);
        }

        $subscription->Status = 'cancelled';
        $subscription->CancelledAt = now();
        $subscription->save();

        return response()->json([
            'success' => true,
            'message' => 'Premium subscription cancelled. Premium access remains active until the expiry date.',
            'data' => [
                'subscription' => $subscription,
                'premium_expiry' => $user->PremiumExpiry,
            ],
        ]);
    }
    /**
     * GET /api/premium/{subscription}
     *
     * Return details of a specific Premium subscription
     * belonging to the authenticated user.
     */
    /**
     * GET /api/premium
     *
     * Return the authenticated user's current Premium subscription.
     */
    public function show(Request $request)
    {
        $user = $request->user();

        // Synchronize Premium status first.
        $this->syncPremiumStatus($user);

        $subscription = PremiumSubscriptions::with([
            'plan',
            'payment',
        ])
            ->where('IdUser', $user->IdUser)
            ->where('Status', 'active')
            ->where('PaymentStatus', 'paid')
            ->where('EndDate', '>', now())
            ->latest('IdPremiumSubscription')
            ->first();

        return response()->json([
            'success' => true,
            'data' => [
                'IdUser' => $user->IdUser,
                'is_premium' => (bool) $user->IsPremuim,
                'premium_started_at' => $user->PremiumStartedAt,
                'premium_expiry' => $user->PremiumExpiry,
                'subscription' => $subscription,
            ],
        ]);
    }
    /**
     * GET /api/premium/history
     *
     * Return all Premium subscriptions of the authenticated user.
     */
    public function history(Request $request)
    {
        $user = $request->user();

        $this->syncPremiumStatus($user);

        $subscriptions = PremiumSubscriptions::with([
            'plan',
            'payment',
        ])
            ->where('IdUser', $user->IdUser)
            ->latest('IdPremiumSubscription')
            ->paginate(10);

        return response()->json([
            'success' => true,
            'data' => $subscriptions,
        ]);
    }

    /**
     * Synchronize Users Premium state with the real subscription.
     *
     * This is important because PremiumExpiry can pass while the user
     * never opens the application.
     */
    private function syncPremiumStatus(Users $user): void
    {
        $activeSubscription = PremiumSubscriptions::where(
            'IdUser',
            $user->IdUser
        )
            ->where('Status', 'active')
            ->where('PaymentStatus', 'paid')
            ->where('EndDate', '>', now())
            ->latest('EndDate')
            ->first();

        if ($activeSubscription) {

            if (
                !$user->IsPremuim ||
                $user->PremiumExpiry != $activeSubscription->EndDate
            ) {
                $user->IsPremuim = true;
                $user->PremiumStartedAt = $activeSubscription->StartDate;
                $user->PremiumExpiry = $activeSubscription->EndDate;
                $user->save();
            }

            return;
        }

        /*
         * No active subscription.
         */
        $expiredSubscription = PremiumSubscriptions::where(
            'IdUser',
            $user->IdUser
        )
            ->where('Status', 'active')
            ->where('EndDate', '<=', now())
            ->get();

        foreach ($expiredSubscription as $subscription) {
            $subscription->Status = 'expired';
            $subscription->save();
        }

        if ($user->IsPremuim) {
            $user->IsPremuim = false;
            $user->PremiumStartedAt = null;
            $user->PremiumExpiry = null;
            $user->save();
        }
    }
}
