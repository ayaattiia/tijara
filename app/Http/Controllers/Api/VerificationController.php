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
     * Routes to the correct existing columns based on identity_type sent
     * by the client:
     * - "cin"     -> ICN + IdentityPicture
     * - "patente" -> ICNBusiness + BusinessVerificationPicture
     *
     * IMPORTANT: IsBusinessAccount is ALSO updated here to match
     * identity_type. It's the single source of truth every other endpoint
     * (status, show, verify, reject) relies on to know which pair of
     * columns to read - if it's not kept in sync here, those endpoints
     * silently look at the wrong fields.
     *
     * Sets IsVerified back to false until an admin reviews it.
     */
    public function submit(SubmitVerificationRequest $request)
    {
        $user = $request->user();
        $identityType = strtolower(trim($request->input('identity_type')));

        if (!in_array($identityType, ['cin', 'patente'])) {
            return response()->json([
                'message' => 'Invalid identity_type. Use cin or patente.'
            ], 422);
        }

        $isBusiness = $identityType === 'patente';

        $numberField = $isBusiness ? 'ICNBusiness' : 'ICN';
        $photoField  = $isBusiness ? 'BusinessVerificationPicture' : 'IdentityPicture';

        $file = $request->file('identity_photo');
        $destination = public_path(config('media.paths.identity'));
        if (! is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        // Keep the ORIGINAL uploaded filename (sanitized), instead of a
        // random UUID. If a file with that name already exists, append
        // a random suffix so two different users' "photo.jpg" never
        // collide or overwrite each other.
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension    = $file->getClientOriginalExtension();
        $safeName     = Str::slug($originalName); // strips spaces/accents/special chars
        $filename = $safeName . '-' . Str::random(8) . '.' . $extension;

        while (is_file($destination . DIRECTORY_SEPARATOR . $filename)) {
            $filename = $safeName . '-' . Str::random(8) . '.' . $extension;
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
            $numberField        => $request->input('identity_number'),
            $photoField         => $filename,
            'IsBusinessAccount' => $isBusiness ? 1 : 0, // <- keeps every other endpoint consistent
            'IsVerified'        => false,
            'VerifiedAt'        => null,
            'VerifiedBy'        => null,
        ]);

        $user->refresh();

        return response()->json([
            'message' => 'Verification request submitted successfully. Pending admin review.',
            'data' => [
                'IdUser'            => $user->IdUser,
                'identity_number'   => $request->input('identity_number'),
                'identity_picture'  => $filename,
                'document_type'     => strtoupper($identityType),
                'IsVerified'        => (bool) $user->IsVerified,
                'IsBusinessAccount' => (bool) $user->IsBusinessAccount,
            ],
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
            'identity_picture' => $isBusiness ? $user->BusinessVerificationPicture : $user->IdentityPicture,
            'verified_at'      => $user->VerifiedAt,
            'document_type'    => $isBusiness ? 'Patente' : 'CIN',
        ]);
    }
}
