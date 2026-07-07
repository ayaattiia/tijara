<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdComments;
use Illuminate\Http\Request;

class AdCommentsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        $query = $this->buildFilteredQuery(
            $request,
            AdComments::class,
            ['Content'],
            ['IdAd', 'IdUser', 'Active'],
            ['CreatedAt']
        );

        return response()->json($query->paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = AdComments::create($data);
        return response()->json($item, 201);
    }

    public function show($ad_comments)
    {
        $item = AdComments::findOrFail($ad_comments);
        return response()->json($item);
    }

    public function update(Request $request, $ad_comments)
    {
        $item = AdComments::findOrFail($ad_comments);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($ad_comments)
    {
        $item = AdComments::findOrFail($ad_comments);
        $item->delete();
        return response()->json(null, 204);
    }
}
