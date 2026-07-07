<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            Ads::class,
            ['TitleAd', 'DescriptionAd', 'DetailsAd', 'LocationAd', 'Telephone', 'Email'],
            ['IdPricesDelevery', 'ImageAd', 'VideoAd', 'IdCateg', 'IdUser', 'IdState', 'IdCountry', 'Color', 'Brand', 'Ownerads', 'Idtypecat', 'Active', 'Type'],
            ['PriceAd', 'DatePublication', 'DateEnd', 'StartDate']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Ads::create($data);
        return response()->json($item, 201);
    }

    public function show($ads)
    {
        $item = Ads::findOrFail($ads);
        return response()->json($item);
    }

    public function update(Request $request, $ads)
    {
        $item = Ads::findOrFail($ads);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($ads)
    {
        $item = Ads::findOrFail($ads);
        $item->delete();
        return response()->json(null, 204);
    }
}
