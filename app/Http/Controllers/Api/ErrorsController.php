<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Errors;
use Illuminate\Http\Request;

class ErrorsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(Errors::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = Errors::create($data);
        return response()->json($item, 201);
    }

    public function show($errors)
    {
        $item = Errors::findOrFail($errors);
        return response()->json($item);
    }

    public function update(Request $request, $errors)
    {
        $item = Errors::findOrFail($errors);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($errors)
    {
        $item = Errors::findOrFail($errors);
        $item->delete();
        return response()->json(null, 204);
    }
}
