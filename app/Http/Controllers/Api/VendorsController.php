<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorsController extends Controller
{
    public function index()
    {
        return response()->json(
            Vendor::where('Active', 1)->get()
        );
    }

    public function show($id)
    {
        return response()->json(
            Vendor::findOrFail($id)
        );
    }

    public function store(Request $request)
    {
        $vendor = Vendor::create($request->all());

        return response()->json([
            'message' => 'Vendor created successfully',
            'data' => $vendor
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);

        $vendor->update($request->all());

        return response()->json([
            'message' => 'Vendor updated successfully',
            'data' => $vendor
        ]);
    }

    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);

        $vendor->delete();

        return response()->json([
            'message' => 'Vendor deleted successfully'
        ]);
    }
}
