<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\EmailTokens;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Exception;


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

    // POST /api/forgot-password : { "Email": "..." }
    // Genere un token et envoie un email avec le code de reinitialisation
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Users::where('Email', $request->Email)->first();

        // Message identique que l'email existe ou non (securite : on ne revele pas
        // si un email est enregistre ou pas)
        $genericResponse = response()->json([
            'message' => 'Si cet email existe, un code de reinitialisation a ete envoye.'
        ]);

        if (!$user) {
            return $genericResponse;
        }

        $token = Str::upper(Str::random(6)); // ex: "A1B2C3"

        EmailTokens::create([
            'IdUser'    => $user->IdUser,
            'Token'     => $token,
            'Type'      => 'password_reset',
            'ExpiresAt' => now()->addMinutes(60),
            'Used'      => 0,
            'CreatedAt' => now(),
        ]);

        Mail::to($user->Email)->send(new ResetPasswordMail($token, $user->Username));

        return $genericResponse;
    }

    // POST /api/reset-password : { "Email": "...", "Token": "...", "Password": "...", "Password_confirmation": "..." }
    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Email'                 => 'required|email',
            'Token'                 => 'required|string',
            'Password'              => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = Users::where('Email', $request->Email)->first();

        if (!$user) {
            return response()->json(['message' => 'Requete invalide'], 422);
        }

        $tokenRecord = EmailTokens::where('IdUser', $user->IdUser)
            ->where('Token', $request->Token)
            ->where('Type', 'password_reset')
            ->where('Used', 0)
            ->where('ExpiresAt', '>=', now())
            ->latest('IdToken')
            ->first();

        if (!$tokenRecord) {
            return response()->json(['message' => 'Code invalide ou expire'], 422);
        }

        $user->Password = Hash::make($request->Password);
        $user->save();

        $tokenRecord->Used = 1;
        $tokenRecord->save();

        return response()->json(['message' => 'Mot de passe reinitialise avec succes']);
    }

public function redirectToFacebook()
{
    return Socialite::driver('facebook')
        ->scopes(['email'])
        ->stateless()
        ->redirect();
}

public function handleFacebookCallback()
{
    try {

        $facebookUser = Socialite::driver('facebook')
            ->stateless()
            ->user();

        if (!$facebookUser->getEmail()) {
            return response()->json([
                'message' => 'Facebook did not return an email address.'
            ], 400);
        }

        $user = Users::where('Email', $facebookUser->getEmail())->first();

        if (!$user) {

            $user = Users::create([
                'Username'          => $facebookUser->getName(),
                'FirstName'         => $facebookUser->getName(),
                'Email'             => $facebookUser->getEmail(),
                'Password'          => Hash::make(Str::random(32)),
                'FacebookId'        => $facebookUser->getId(),
                'ProfilePicture'    => $facebookUser->getAvatar(),
                'CreationDate'      => now(),
                'EmailConfirmed'    => 1,
                'Active'            => 1,
            ]);

        } else {

            if (!$user->FacebookId) {
                $user->FacebookId = $facebookUser->getId();
            }

            if (!$user->ProfilePicture) {
                $user->ProfilePicture = $facebookUser->getAvatar();
            }

            $user->save();
        }

        $token = $user->createToken('facebook')->accessToken;

        return redirect(
            env('FRONTEND_URL') .
            '/login-success?token=' .
            urlencode($token)
        );

    } catch (Exception $e) {

        return response()->json([
            'message' => 'Facebook authentication failed.',
            'error' => $e->getMessage(),
        ], 500);

    }
}
}