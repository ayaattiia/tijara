<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Services\NotificationService;
use Illuminate\Http\Request;

class UserVerificationController extends Controller
{
    public function __construct(private NotificationService $notifications) {}

    /**
     * IsBusinessAccount is the real column that tells us the document
     * type. There is no "IdentityDocumentType" column - using it always
     * evaluated to null/false and silently treated every user, including
     * Patente/business ones, as a CIN submission.
     */
    private function isBusiness(Users $user): bool
    {
        return (bool) $user->IsBusinessAccount;
    }

    /**
     * GET /api/admin/verifications
     * Lists users who submitted EITHER an individual or business ID
     * document. ?status=pending (default) | verified | all
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'pending');

        $query = Users::where(function ($q) {
            $q->whereNotNull('IdentityPicture')
                ->orWhereNotNull('BusinessVerificationPicture');
        });

        if ($status === 'pending') {
            $query->where(function ($q) {
                $q->whereNull('IsVerified')->orWhere('IsVerified', 0);
            });
        } elseif ($status === 'verified') {
            $query->where('IsVerified', 1);
        }

        $users = $query->orderByDesc('IdUser')->paginate(20);

        $users->getCollection()->transform(function ($user) {
            $user->document_type = $this->isBusiness($user) ? 'Patente' : 'CIN';
            return $user;
        });

        return response()->json($users);
    }

    /**
     * GET /api/admin/verifications/{user}
     * Full detail for ONE user's verification submission:
     * - DocumentType: "Patente" (business) or "CIN" (individual)
     * - NumeroIdentite: ICNBusiness (Patente) or ICN (CIN)
     * - PhotoField: which real column the photo lives in -
     *   "BusinessVerificationPicture" or "IdentityPicture"
     * - PhotoIdentite: the actual stored filename from that column
     */
    public function show(Users $user)
    {
        $isBusiness = $this->isBusiness($user);

        return response()->json([
            'IdUser'         => $user->IdUser,
            'Username'       => $user->Username,
            'Email'          => $user->Email,
            'DocumentType'   => $isBusiness ? 'Patente' : 'CIN',
            'NumeroIdentite' => $isBusiness ? $user->ICNBusiness : $user->ICN,
            'PhotoField'     => $isBusiness ? 'BusinessVerificationPicture' : 'IdentityPicture',
            'PhotoIdentite'  => $isBusiness ? $user->BusinessVerificationPicture : $user->IdentityPicture,
            'IsVerified'     => (bool) $user->IsVerified,
            'VerifiedAt'     => $user->VerifiedAt,
            'VerifiedBy'     => $user->VerifiedBy,
        ]);
    }

    /**
     * PATCH /api/admin/verifications/{user}/verify
     * Admin marks a user as verified (pro badge).
     */
    public function verify(Request $request, Users $user)
    {
        if (! $user->IdentityPicture && ! $user->BusinessVerificationPicture) {
            return response()->json([
                'message' => 'This user has not submitted an identity document yet.',
            ], 422);
        }

        $user->update([
            'IsVerified' => 1,
            'VerifiedAt' => now(),
            'VerifiedBy' => $request->user()->IdUser,
        ]);

        $this->notifications->send(
            $user->IdUser,
            'Compte vérifié',
            'Félicitations, votre document d\'identité a été validé. Votre compte est maintenant vérifié.',
            NotificationService::TYPE_VERIFICATION_OK
        );

        return response()->json([
            'message' => 'User has been verified.',
            'data' => [
                'IdUser'        => $user->IdUser,
                'Username'      => $user->Username,
                'Email'         => $user->Email,
                'DocumentType'  => $this->isBusiness($user) ? 'Patente' : 'CIN',
                'IsVerified'    => (bool) $user->IsVerified,
                'VerifiedAt'    => $user->VerifiedAt,
                'VerifiedBy'    => $user->VerifiedBy,
            ],
        ]);
    }

    /**
     * PATCH /api/admin/verifications/{user}/reject
     * Admin rejects the submitted document; user must resubmit.
     */
    public function reject(Request $request, Users $user)
    {
        $request->validate([
            'reason' => ['nullable', 'string', 'max:255'],
        ]);

        $isBusiness = $this->isBusiness($user);
        $destination = public_path(config('media.paths.identity'));

        $photoField = $isBusiness ? 'BusinessVerificationPicture' : 'IdentityPicture';
        $oldPhoto = $user->{$photoField};
        if ($oldPhoto) {
            $oldPath = $destination . DIRECTORY_SEPARATOR . $oldPhoto;
            if (is_file($oldPath)) {
                @unlink($oldPath);
            }
        }

        $user->update([
            'IsVerified' => 0,
            $photoField  => null,
            'VerifiedAt' => null,
            'VerifiedBy' => null,
        ]);

        $this->notifications->send(
            $user->IdUser,
            'Document rejeté',
            $request->input('reason') ?? 'Votre document d\'identité a été refusé. Merci de le soumettre à nouveau.',
            NotificationService::TYPE_VERIFICATION_KO
        );

        return response()->json([
            'message' => 'Verification request rejected. User must resubmit.',
            'reason'  => $request->input('reason'),
        ]);
    }
}
