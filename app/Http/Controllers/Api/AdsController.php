<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function index()
    {
        $ads = Ads::with([
            'user:IdUser,Username,FirstName,LastName,Email,ProfilePicture',
            'categ',
            'state',
            'country'
        ])->paginate(10);

        return response()->json($ads);
    }

    public function search($search)
    {
        $ads = Ads::with([
            'user:IdUser,Username,FirstName,LastName,Email,ProfilePicture',
            'categ',
            'state',
            'country'
        ])
            ->where(function ($q) use ($search) {
                $q->where('TitleAd', 'like', "%{$search}%")
                    ->orWhere('DescriptionAd', 'like', "%{$search}%")
                    ->orWhere('LocationAd', 'like', "%{$search}%")
                    ->orWhere('Brand', 'like', "%{$search}%");
            })
            ->paginate(10);

        return response()->json($ads);
    }

    public function byCategory($IdCateg)
    {
        $ads = Ads::where('IdCateg', $IdCateg)->paginate(10);
        return response()->json($ads);
    }

    public function byTypeCat($Idtypecat)
    {
        $ads = Ads::where('Idtypecat', $Idtypecat)->paginate(10);
        return response()->json($ads);
    }

    public function byState($IdState)
    {
        $ads = Ads::where('IdState', $IdState)->paginate(10);
        return response()->json($ads);
    }

    public function byCountry($IdCountry)
    {
        $ads = Ads::where('IdCountry', $IdCountry)->paginate(10);
        return response()->json($ads);
    }

    public function byUser($IdUser)
    {
        $ads = Ads::where('IdUser', $IdUser)->paginate(10);
        return response()->json($ads);
    }

    public function byPriceRange($min_price, $max_price)
    {
        $ads = Ads::whereBetween('PriceAd', [$min_price, $max_price])->paginate(10);
        return response()->json($ads);
    }

    public function byActive($Active)
    {
        $ads = Ads::where('Active', $Active)->paginate(10);
        return response()->json($ads);
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
