<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\PremiumPlans;
use App\Models\PremiumSubscriptions;
use App\Models\Users;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PremiumAdminController extends Controller
{

    /**
     * GET /api/admin/premium/subscriptions
     *
     * Admin: list all Premium subscriptions.
     */
    public function index(Request $request)
    {
        return $this->subscriptions($request);
    }

    /**
     * GET /api/admin/premium/subscriptions/{subscription}
     *
     * Admin: show one Premium subscription.
     */
    public function show($subscription)
    {
        return $this->showSubscription($subscription);
    }
    /*
    *
     * GET /api/admin/premium/plans
     */
    public function plans()
    {
        $plans = PremiumPlans::withCount('subscriptions')
            ->orderBy('DurationMonths')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $plans,
        ]);
    }

    /**
     * POST /api/admin/premium/plans
     *
     * Create a Premium plan.
     */
    public function createPlan(Request $request)
    {
        $data = $request->validate([
            'Name' => 'required|string|max:100',
            'Slug' => 'required|string|max:50|unique:PremiumPlans,Slug',
            'DurationMonths' => 'required|integer|min:1',
            'Price' => 'required|numeric|min:0',
            'Currency' => 'nullable|string|max:10',
            'Active' => 'nullable|boolean',
        ]);

        $plan = PremiumPlans::create([
            'Name' => $data['Name'],
            'Slug' => $data['Slug'],
            'DurationMonths' => $data['DurationMonths'],
            'Price' => $data['Price'],
            'Currency' => $data['Currency'] ?? 'TND',
            'Active' => $data['Active'] ?? true,
            'CreatedAt' => now(),
            'UpdatedAt' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Premium plan created successfully.',
            'data' => $plan,
        ], 201);
    }

    /**
     * PATCH /api/admin/premium/plans/{id}
     */
    public function updatePlan(Request $request, $id)
    {
        $plan = PremiumPlans::findOrFail($id);

        $data = $request->validate([
            'Name' => 'sometimes|string|max:100',
            'Slug' => 'sometimes|string|max:50|unique:PremiumPlans,Slug,' .
                $plan->IdPremiumPlan . ',IdPremiumPlan',
            'DurationMonths' => 'sometimes|integer|min:1',
            'Price' => 'sometimes|numeric|min:0',
            'Currency' => 'sometimes|string|max:10',
            'Active' => 'sometimes|boolean',
        ]);

        $plan->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Premium plan updated successfully.',
            'data' => $plan->fresh(),
        ]);
    }

    /**
     * PATCH /api/admin/premium/plans/{id}/activate
     */
    public function activatePlan($id)
    {
        $plan = PremiumPlans::findOrFail($id);

        $plan->Active = true;
        $plan->save();

        return response()->json([
            'success' => true,
            'message' => 'Premium plan activated.',
            'data' => $plan,
        ]);
    }

    /**
     * PATCH /api/admin/premium/subscriptions/{subscription}/activate
     *
     * Admin: activate a pending Premium subscription.
     */
    public function activate($subscription)
    {
        $subscription = PremiumSubscriptions::with([
            'user',
            'plan',
            'payment',
        ])->find($subscription);

        if (!$subscription) {
            return response()->json([
                'success' => false,
                'message' => 'Premium subscription not found.',
            ], 404);
        }

        /*
     * A cancelled subscription cannot be activated again.
     */
        if ($subscription->Status === 'cancelled') {
            return response()->json([
                'success' => false,
                'message' => 'Cancelled subscription cannot be activated.',
            ], 422);
        }

        /*
     * A subscription without a payment cannot be activated.
     */
        if (!$subscription->payment) {
            return response()->json([
                'success' => false,
                'message' => 'Payment not found.',
            ], 422);
        }

        /*
     * Prevent activating an already-paid payment.
     */
        if ($subscription->payment->Status === 'paid') {
            return response()->json([
                'success' => false,
                'message' => 'This payment has already been completed.',
            ], 409);
        }

        /*
     * The Premium plan must exist.
     */
        if (!$subscription->plan) {
            return response()->json([
                'success' => false,
                'message' => 'Premium plan not found.',
            ], 422);
        }

        /*
     * Do not allow two active Premium subscriptions
     * for the same user.
     */
        $anotherActive = PremiumSubscriptions::where(
            'IdUser',
            $subscription->IdUser
        )
            ->where('Status', 'active')
            ->where('PaymentStatus', 'paid')
            ->where(
                'IdPremiumSubscription',
                '!=',
                $subscription->IdPremiumSubscription
            )
            ->where('EndDate', '>', now())
            ->exists();

        if ($anotherActive) {
            return response()->json([
                'success' => false,
                'message' => 'This user already has an active Premium subscription.',
            ], 409);
        }

        DB::transaction(function () use ($subscription) {

            $now = now();

            /*
         * Lock payment row to prevent concurrent activation.
         */
            $payment = Payments::lockForUpdate()
                ->findOrFail($subscription->IdPayment);

            /*
         * Double-check payment status inside transaction.
         */
            if ($payment->Status === 'paid') {
                throw new \RuntimeException(
                    'This payment has already been completed.'
                );
            }

            /*
         * Mark payment as paid.
         */
            $payment->Status = 'paid';
            $payment->PaidAt = $now;
            $payment->save();

            /*
         * Calculate the REAL Premium period.
         */
            $startDate = $now;

            $endDate = $startDate->copy()
                ->addMonths(
                    (int) $subscription->plan->DurationMonths
                );

            /*
         * Activate subscription.
         */
            $subscription->StartDate = $startDate;
            $subscription->EndDate = $endDate;
            $subscription->PaymentStatus = 'paid';
            $subscription->Status = 'active';
            $subscription->CancelledAt = null;
            $subscription->UpdatedAt = $now;
            $subscription->save();

            /*
         * Synchronize user's Premium status.
         */
            $user = Users::find($subscription->IdUser);

            if ($user) {
                $user->IsPremuim = true;
                $user->PremiumStartedAt = $startDate;
                $user->PremiumExpiry = $endDate;
                $user->save();
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Premium subscription activated successfully by admin.',
            'data' => [
                'subscription' => $subscription
                    ->fresh()
                    ->load([
                        'user',
                        'plan',
                        'payment',
                    ]),
            ],
        ]);
    }

    /**
     * PATCH /api/admin/premium/subscriptions/{subscription}/cancel
     *
     * Admin: cancel an active Premium subscription.
     *
     * Premium access is NOT immediately removed.
     * The subscription remains usable until EndDate.
     */
    public function cancel($subscription)
    {
        $subscription = PremiumSubscriptions::with([
            'user',
            'plan',
            'payment',
        ])->find($subscription);

        if (!$subscription) {
            return response()->json([
                'success' => false,
                'message' => 'Premium subscription not found.',
            ], 404);
        }

        /*
     * Only active subscriptions can be cancelled.
     */
        if ($subscription->Status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Only an active Premium subscription can be cancelled.',
            ], 422);
        }

        /*
     * If already expired according to EndDate,
     * don't cancel it; expire it instead.
     */
        if (!$subscription->EndDate || $subscription->EndDate <= now()) {

            $subscription->Status = 'expired';
            $subscription->save();

            $this->syncAdminUserPremiumStatus(
                $subscription->IdUser
            );

            return response()->json([
                'success' => false,
                'message' => 'Premium subscription has already expired.',
            ], 422);
        }

        DB::transaction(function () use ($subscription) {

            $subscription->Status = 'cancelled';
            $subscription->CancelledAt = now();
            $subscription->UpdatedAt = now();
            $subscription->save();

            /*
         * Keep Premium access until EndDate.
         *
         * If another active subscription exists,
         * synchronize the user's Premium status with it.
         */
            $this->syncAdminUserPremiumStatus(
                $subscription->IdUser
            );
        });

        return response()->json([
            'success' => true,
            'message' => 'Premium subscription cancelled by admin. Premium access remains active until the expiry date.',
            'data' => [
                'subscription' => $subscription
                    ->fresh()
                    ->load([
                        'user',
                        'plan',
                        'payment',
                    ]),
            ],
        ]);
    }

    /**
     * Synchronize a user's Premium state after an admin action.
     *
     * The user can have multiple historical subscriptions,
     * but only the latest valid active subscription should
     * determine the current Premium state.
     */
    private function syncAdminUserPremiumStatus($userId): void
    {
        $user = Users::find($userId);

        if (!$user) {
            return;
        }

        $activeSubscription = PremiumSubscriptions::where(
            'IdUser',
            $userId
        )
            ->where('Status', 'active')
            ->where('PaymentStatus', 'paid')
            ->where('EndDate', '>', now())
            ->latest('EndDate')
            ->first();

        if ($activeSubscription) {

            $user->IsPremuim = true;
            $user->PremiumStartedAt = $activeSubscription->StartDate;
            $user->PremiumExpiry = $activeSubscription->EndDate;
            $user->save();

            return;
        }

        /*
     * No valid active subscription.
     *
     * Expire subscriptions whose EndDate has passed.
     */
        PremiumSubscriptions::where(
            'IdUser',
            $userId
        )
            ->where('Status', 'active')
            ->where('EndDate', '<=', now())
            ->update([
                'Status' => 'expired',
                'UpdatedAt' => now(),
            ]);

        /*
     * Remove Premium status from user.
     */
        $user->IsPremuim = false;
        $user->PremiumStartedAt = null;
        $user->PremiumExpiry = null;
        $user->save();
    }
    /**
     * PATCH /api/admin/premium/subscriptions/{subscription}/expire
     *
     * Admin: manually expire a Premium subscription.
     */
    public function expire($subscription)
    {
        return $this->expireSubscription($subscription);
    }
    /**
     * PATCH /api/admin/premium/plans/{id}/deactivate
     */
    public function deactivatePlan($id)
    {
        $plan = PremiumPlans::findOrFail($id);

        $plan->Active = false;
        $plan->save();

        return response()->json([
            'success' => true,
            'message' => 'Premium plan deactivated.',
            'data' => $plan,
        ]);
    }

    /**
     * GET /api/admin/premium/subscriptions
     */
    public function subscriptions(Request $request)
    {
        $query = PremiumSubscriptions::with([
            'user',
            'plan',
            'payment',
        ]);

        if ($request->filled('Status')) {
            $query->where('Status', $request->Status);
        }

        if ($request->filled('PaymentStatus')) {
            $query->where(
                'PaymentStatus',
                $request->PaymentStatus
            );
        }

        if ($request->filled('IdUser')) {
            $query->where(
                'IdUser',
                $request->IdUser
            );
        }

        return response()->json([
            'success' => true,
            'data' => $query
                ->latest('IdPremiumSubscription')
                ->paginate(20),
        ]);
    }

    /**
     * GET /api/admin/premium/subscriptions/{id}
     */
    public function showSubscription($id)
    {
        $subscription = PremiumSubscriptions::with([
            'user',
            'plan',
            'payment',
        ])->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $subscription,
        ]);
    }

    /**
     * POST /api/admin/premium/subscriptions/{id}/expire
     *
     * Manual expiration for administration.
     */
    public function expireSubscription($id)
    {
        $subscription = PremiumSubscriptions::findOrFail($id);

        if ($subscription->Status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Only active subscriptions can be expired.',
            ], 422);
        }

        DB::transaction(function () use ($subscription) {

            $subscription->Status = 'expired';
            $subscription->save();

            $user = Users::find($subscription->IdUser);

            if (!$user) {
                return;
            }

            /*
             * Check if this user has another active subscription.
             */
            $anotherActive = PremiumSubscriptions::where(
                'IdUser',
                $user->IdUser
            )
                ->where('Status', 'active')
                ->where('PaymentStatus', 'paid')
                ->where(
                    'IdPremiumSubscription',
                    '!=',
                    $subscription->IdPremiumSubscription
                )
                ->where('EndDate', '>', now())
                ->latest('EndDate')
                ->first();

            if ($anotherActive) {
                $user->IsPremuim = true;
                $user->PremiumStartedAt = $anotherActive->StartDate;
                $user->PremiumExpiry = $anotherActive->EndDate;
            } else {
                $user->IsPremuim = false;
                $user->PremiumStartedAt = null;
                $user->PremiumExpiry = null;
            }

            $user->save();
        });

        return response()->json([
            'success' => true,
            'message' => 'Premium subscription expired.',
            'data' => $subscription->fresh()->load([
                'user',
                'plan',
                'payment',
            ]),
        ]);
    }
}
