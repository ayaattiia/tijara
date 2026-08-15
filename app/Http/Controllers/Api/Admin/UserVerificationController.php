<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;

class UserVerificationController extends Controller
{
    /**
     * GET /api/admin/verifications
     * Lists users who submitted EITHER an individual or business ID
     * document and are pending review.
     * ?status=pending (default) | verified | all
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');

        $query = Users::where(function ($q) {
            $q->whereNotNull('IdentityPicture')
                ->orWhereNotNull('BusinessVerificationPicture');
        });

        if ($status === 'pending') {
            $query->where('IsVerified', false);
        } elseif ($status === 'verified') {
            $query->where('IsVerified', true);
        }

        $users = $query->latest('IdUser')->paginate(20);

        return response()->json($users);
    }

    /**
     * PATCH /api/admin/verifications/{user}/verify
     */
    public function verify(Request $request, Users $user)
    {
        if (! $user->IdentityPicture && ! $user->BusinessVerificationPicture) {
            return response()->json([
                'message' => 'This user has not submitted an identity document yet.',
            ], 422);
        }

        $user->update([
            'IsVerified' => true,
            'VerifiedAt' => now(),
            'VerifiedBy' => $request->user()->IdUser,
        ]);

        return response()->json([
            'message' => 'User has been verified.',
            'data'    => $user->only(['IdUser', 'Username', 'Email', 'IsVerified', 'VerifiedAt']),
        ]);
    }

    /**
     * PATCH /api/admin/verifications/{user}/reject
     */
    public function reject(Request $request, Users $user)
    {
        $request->validate([
            'reason' => ['nullable', 'string', 'max:255'],
        ]);

        $isBusiness = (bool) $user->IsBusinessAccount;

        $user->update([
            'IsVerified' => false,
            $isBusiness ? 'BusinessVerificationPicture' : 'IdentityPicture' => null,
            'VerifiedAt' => null,
            'VerifiedBy' => null,
        ]);

        return response()->json([
            'message' => 'Verification request rejected. User must resubmit.',
            'reason'  => $request->input('reason'),
        ]);
    }
}
