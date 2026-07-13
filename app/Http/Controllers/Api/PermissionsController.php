<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Permissions;
use Illuminate\Http\Request;

class PermissionsController extends Controller
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
            Permissions::class,
            ['Resource'],
            ['IdRole', 'IdListPermission', 'CanRead', 'CanCreate', 'CanUpdate', 'CanDelete'],
            ['PermissionDate']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Permissions::create($data);
        return response()->json($item, 201);
    }

    public function show($permissions)
    {
        $item = Permissions::findOrFail($permissions);
        return response()->json($item);
    }

    public function update(Request $request, $permissions)
    {
        $item = Permissions::findOrFail($permissions);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($permissions)
    {
        $item = Permissions::findOrFail($permissions);
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
