<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ViewController;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    // Centralize the default/min/max so you can tweak them in one place
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    private ViewController $viewController;


    public function __construct(ViewController $viewController)
    {
        $this->viewController = $viewController;
    }

    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $query = $this->buildFilteredQuery(
            $request,
            Users::class,
            ['Username', 'FirstName', 'LastName', 'Email', 'Telephone', 'Location', 'City', 'EmailConfirmed'],
            ['Gender', 'ICN', 'IdRole', 'FacebookId', 'GoogleId', 'ProfilePicture', 'IsVerified', 'IsPremuim', 'IdentityPicture', 'IsBusinessAccount', 'ICNBusiness', 'BusinessVerificationPicture', 'IdState', 'IdCountry', 'Active'],
            ['BirthDate', 'CreationDate', 'PremiumExpiry', 'LastConnection']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if (isset($data['Password'])) {
            $data['Password'] = Hash::make($data['Password']);
        }
        $item = Users::create($data);
        return response()->json($item, 201);
    }


    public function show($users)
    {
        $profile = Users::findOrFail($users);

        $visitor = auth('api')->user();

        if ($visitor) {
            $this->viewController->registerView(
                $visitor,
                'user',
                $profile
            );
        } else {
            // Guest view
            $profile->ViewCount = ($profile->ViewCount ?? 0) + 1;
            $profile->LastViewedAt = now();
            $profile->save();
        }

        return response()->json([
            'success' => true,
            'data' => $profile
        ]);
    }
    public function update(Request $request, $users)
    {
        $item = Users::findOrFail($users);
        $data = $request->all();
        if (isset($data['Password'])) {
            $data['Password'] = Hash::make($data['Password']);
        } else {
            unset($data['Password']);
        }
        $item->update($data);
        return response()->json($item);
    }

    /**
     * PUT /api/profile
     * Update the currently authenticated user's own profile - no {id}
     * needed, the user is resolved from the Bearer token.
     *
     * Only a safe whitelist of self-editable fields is accepted. Fields
     * like IdRole, IsVerified, Active, ICN, ICNBusiness, IdentityPicture,
     * BusinessVerificationPicture, IsBusinessAccount are intentionally
     * excluded here: those change via the admin/verification flow
     * (see VerificationController + Admin/UserVerificationController),
     * not through a generic profile edit.
     */
    public function updateProfile(Request $request)
    {
        /** @var \App\Models\Users $user */
        $user = $request->user();

        $data = $request->only([
            'Username',
            'FirstName',
            'LastName',
            'BirthDate',
            'Gender',
            'Telephone',
            'Location',
            'City',
            'IdState',
        ]);

        if ($request->hasFile('ProfilePicture')) {
            $request->validate([
                'ProfilePicture' => ['image', 'mimes:jpg,jpeg,png', 'max:5120'], // 5MB
            ]);

            $file = $request->file('ProfilePicture');

            $destination = public_path(config('media.paths.users_profiles'));
            if (! is_dir($destination)) {
                mkdir($destination, 0755, true);
            }

            // Delete the old picture file, but only if it was actually
            // stored locally by us (not a Facebook/Google avatar URL).
            if ($user->ProfilePicture && ! Str::startsWith($user->ProfilePicture, ['http://', 'https://'])) {
                $oldPath = $destination . DIRECTORY_SEPARATOR . basename($user->ProfilePicture);
                if (is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $originalName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $filename     = $user->IdUser . '_' . $originalName . '.' . $file->getClientOriginalExtension();

            $file->move($destination, $filename);

            $data['ProfilePicture'] = $filename;
        }

        if ($request->filled('Password')) {
            $data['Password'] = Hash::make($request->input('Password'));
        }

        $user->update($data);

        return response()->json([
            'success' => true,
            'data'    => $user->fresh(),
        ]);
    }

    public function destroy($users)
    {
        $item = Users::findOrFail($users);
        $item->delete();
        return response()->json(null, 204);
    }

    /**
     * Resolve the per_page value from the request, falling back to a default
     * and clamping it between MIN_PER_PAGE and MAX_PER_PAGE.
     */
    private function resolvePerPage(Request $request): int
    {
        $perPage = (int) $request->query('per_page', self::DEFAULT_PER_PAGE);

        // Guard against negatives or absurdly large values
        return max(self::MIN_PER_PAGE, min($perPage, self::MAX_PER_PAGE));
    }
}
