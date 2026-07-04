<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Username'  => 'required|string|max:250',
            'Email'     => 'required|email|max:250|unique:Users,Email',
            'Password'  => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Users::create([
            'Username'       => $request->Username,
            'Email'          => $request->Email,
            'Password'       => Hash::make($request->Password),
            'FirstName'      => $request->FirstName,
            'LastName'       => $request->LastName,
            'Telephone'      => $request->Telephone,
            'CreationDate'   => now(),
            'Active'         => 1,
            'EmailConfirmed' => 0,
        ]);

        $token = $user->createToken('auth_token')->accessToken;

        return response()->json([
            'user'  => $user,
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Email'    => 'required|email',
            'Password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Users::where('Email', $request->Email)->first();

        if (!$user || !Hash::check($request->Password, $user->Password)) {
            return response()->json(['message' => 'Identifiants invalides'], 401);
        }

        $token = $user->createToken('auth_token')->accessToken;

        return response()->json([
            'user'  => $user,
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Deconnecte avec succes']);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
