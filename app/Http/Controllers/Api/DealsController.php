<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Deals;
use Illuminate\Http\Request;

class DealsController extends Controller
{
    // Centralize the default/min/max so you can tweak them in one place
    private const DEFAULT_PER_PAGE = 10;
    private const MIN_PER_PAGE = 0;
    private const MAX_PER_PAGE = 50;

    public function index(Request $request)
    {
        $perPage = $this->resolvePerPage($request);

        $query = Deals::with([
            'iduser',
            'idcateg',
            'idtypecat',
            'idstate',
            'idprize'
        ]);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('titleDeal', 'LIKE', "%{$search}%")
                    ->orWhere('descriptionDeal', 'LIKE', "%{$search}%")
                    ->orWhere('detailsDeal', 'LIKE', "%{$search}%")
                    ->orWhere('brand', 'LIKE', "%{$search}%")
                    ->orWhere('locationDeal', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('idUser')) {
            $query->where('idUser', $request->idUser);
        }

        if ($request->filled('idPrize')) {
            $query->where('idPrize', $request->idPrize);
        }

        if ($request->filled('idCateg')) {
            $query->where('idCateg', $request->idCateg);
        }

        if ($request->filled('active')) {
            $query->where('active', $request->active);
        }

        if ($request->filled('price_min')) {
            $query->where('priceDeal', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('priceDeal', '<=', $request->price_max);
        }
        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Deals::create($data);
        return response()->json($item, 201);
    }

    public function show($deals)
    {
        $item = Deals::findOrFail($deals);
        return response()->json($item);
    }

    public function update(Request $request, $deals)
    {
        $item = Deals::findOrFail($deals);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($deals)
    {
        $item = Deals::findOrFail($deals);
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
