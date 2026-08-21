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
     * GET /api/admin/verifications/{user}
     * Full detail for ONE user's verification submission — photo,
     * CIN/Patente number, business status, review state.
     */
    /**
     * GET /api/admin/verifications/{user}
     * Full detail for ONE user's verification submission:
     * - DocumentType: "CIN" (individual) or "Patente" (business)
     * - NumeroIdentite: the CIN number or Matricule Fiscal (ICNBusiness)
     * - PhotoIdentite: the uploaded ID photo filename
     */
    public function show(Users $user)
    {
        $isBusiness = $user->IdentityDocumentType === 'patente';

        return response()->json([
            'IdUser'            => $user->IdUser,
            'Username'          => $user->Username,
            'Email'             => $user->Email,
            'DocumentType'      => $user->IdentityDocumentType === 'patente' ? 'Patente' : 'CIN',
            'NumeroIdentite'    => $isBusiness ? $user->ICNBusiness : $user->ICN,
            'PhotoIdentite'     => $isBusiness ? $user->BusinessVerificationPicture : $user->IdentityPicture,
            'IsVerified'        => (bool) $user->IsVerified,
            'VerifiedAt'        => $user->VerifiedAt,
            'VerifiedBy'        => $user->VerifiedBy,
        ]);
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
            'data' => [
                'IdUser' => $user->IdUser,
                'Username' => $user->Username,
                'Email' => $user->Email,
                'IsVerified' => (bool) $user->IsVerified,
                'VerifiedAt' => $user->VerifiedAt,
                'VerifiedBy' => $user->VerifiedBy,
            ]
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
