<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Support\MediaUrl;
use Illuminate\Http\Request;

class UserVerificationController extends Controller
{
    /**
     * GET /api/admin/verifications
     * List users who submitted an identity document (CIN or Patente).
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
            $query->where(function ($q) {
                $q->whereNull('IsVerified')->orWhere('IsVerified', 0);
            });
        } elseif ($status === 'verified') {
            $query->where('IsVerified', 1);
        }

        $users = $query->orderByDesc('IdUser')->paginate(20);

        return response()->json($users);
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
        ]);

        return response()->json([
            'message' => 'User has been verified.',
            'data'    => $user->only(['IdUser', 'Username', 'Email', 'IsVerified', 'IsBusinessAccount']),
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

        $destination = public_path(config('media.paths.identity'));

        // Clean up whichever document(s) were submitted so the user has to
        // upload a fresh one.
        if ($user->IdentityPicture) {
            $old = $destination . DIRECTORY_SEPARATOR . $user->IdentityPicture;
            if (is_file($old)) {
                @unlink($old);
            }
        }
        if ($user->BusinessVerificationPicture) {
            $old = $destination . DIRECTORY_SEPARATOR . $user->BusinessVerificationPicture;
            if (is_file($old)) {
                @unlink($old);
            }
        }

        $user->update([
            'IsVerified'                   => 0,
            'ICN'                          => null,
            'IdentityPicture'              => null,
            'ICNBusiness'                  => null,
            'BusinessVerificationPicture'  => null,
        ]);

        return response()->json([
            'message' => 'Verification request rejected. User must resubmit.',
            'reason'  => $request->input('reason'),
        ]);
    }
}
