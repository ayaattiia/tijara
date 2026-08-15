<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmitVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class VerificationController extends Controller
{
    /**
     * POST /api/verification/submit
     * Routes to the correct existing columns based on IsBusinessAccount:
     * - individual: ICN + IdentityPicture
     * - business:   ICNBusiness + BusinessVerificationPicture
     * Sets IsVerified back to false until an admin reviews it.
     */
    public function submit(SubmitVerificationRequest $request)
    {
        $user = $request->user();
        $isBusiness = (bool) $user->IsBusinessAccount;

        $numberField = $isBusiness ? 'ICNBusiness' : 'ICN';
        $photoField  = $isBusiness ? 'BusinessVerificationPicture' : 'IdentityPicture';

        $file = $request->file('identity_photo');
        $destination = public_path(config('media.paths.identity'));

        // Keep the ORIGINAL uploaded filename (sanitized), instead of a
        // random UUID. If a file with that name already exists, append
        // -1, -2, etc. so two different users' "photo.jpg" never collide
        // or overwrite each other.
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension    = $file->getClientOriginalExtension();
        $safeName     = Str::slug($originalName); // strips spaces/accents/special chars

        $filename = $safeName . '.' . $extension;
        $counter  = 1;
        while (is_file($destination . DIRECTORY_SEPARATOR . $filename)) {
            $filename = $safeName . '-' . $counter . '.' . $extension;
            $counter++;
        }

        $file->move($destination, $filename);

        // Delete old photo for this same field if re-submitting
        $oldFilename = $user->{$photoField};
        if ($oldFilename) {
            $oldPath = $destination . DIRECTORY_SEPARATOR . $oldFilename;
            if (is_file($oldPath)) {
                @unlink($oldPath);
            }
        }

        $user->update([
            $numberField    => $request->input('identity_number'),
            $photoField     => $filename,
            'IsVerified'    => false,
            'VerifiedAt'    => null,
            'VerifiedBy'    => null,
        ]);

        return response()->json([
            'message' => 'Verification request submitted successfully. Pending admin review.',
            'data'    => $user->only([
                'IdUser',
                $numberField,
                $photoField,
                'IsVerified',
                'IsBusinessAccount',
            ]),
        ], 200);
    }

    /**
     * GET /api/verification/status
     */
    public function status(Request $request)
    {
        $user = $request->user();
        $isBusiness = (bool) $user->IsBusinessAccount;

        return response()->json([
            'is_verified'      => (bool) $user->IsVerified,
            'is_business'      => $isBusiness,
            'identity_number'  => $isBusiness ? $user->ICNBusiness : $user->ICN,
            'verified_at'      => $user->VerifiedAt,
        ]);
    }
}
