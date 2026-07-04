<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EmailTokens;
use Illuminate\Http\Request;

class EmailTokensController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 20);
        return response()->json(EmailTokens::paginate($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $item = EmailTokens::create($data);
        return response()->json($item, 201);
    }

    public function show($email_tokens)
    {
        $item = EmailTokens::findOrFail($email_tokens);
        return response()->json($item);
    }

    public function update(Request $request, $email_tokens)
    {
        $item = EmailTokens::findOrFail($email_tokens);
        $item->update($request->all());
        return response()->json($item);
    }

    public function destroy($email_tokens)
    {
        $item = EmailTokens::findOrFail($email_tokens);
        $item->delete();
        return response()->json(null, 204);
    }
}
