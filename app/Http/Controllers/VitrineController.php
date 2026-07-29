<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use App\Models\Products;
use App\Models\Categories;
use App\Models\Brands;


class VitrineController extends Controller
{
    public function index()
    {
        $latestAds = Ads::orderBy('IdAd', 'desc')->take(8)->get();
        $latestProducts = Products::with(['cateorie','brand','user'])
            ->orderBy('IdProduct', 'desc')
            ->take(8)
            ->get();

        $categories = Categories::where('Active', 1)
            ->orderBy('IdCateg', 'desc')
            ->get();

        $brands = Brands::orderBy('IdBrand', 'desc')->take(8)
            ->get();
        $featuredProducts = Products::with(['cateorie', 'brand'])
            ->where('Active', 1)
            ->inRandomOrder()
            ->take(8)
            ->get();


        return response()->json([
            'categories' => $categories,
            'brands' => $brands,
            'latestAds' => $latestAds,
            'latestProducts' => $latestProducts,
            'featuredProducts' => $featuredProducts,


        ]);
    }
}
