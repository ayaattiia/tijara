<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    // Centralize the default/min/max so you can tweak them in one place
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

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
        $item = Users::findOrFail($users);
        return response()->json($item);
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
