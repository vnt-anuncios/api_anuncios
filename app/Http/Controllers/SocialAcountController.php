<?php

namespace App\Http\Controllers;


use App\User;
use Laravel\Socialite\Facades\Socialite;
use App\SocialAcount;

class SocialAcountController extends Controller
{


    public function redirectToProvider($provider)
    {

        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallBack($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        try {
            $user = Socialite::driver($provider)->stateless()->user();
        } catch (\Throwable $th) {
            return response()->json(['error' => 'credenciales invalidas del proveedor']);
        }

        $userCreated = User::firstOrCreate(
            ['email' => $user->getEmail()],
            [
                'email_verified_at' => now(),
                'name' => $user->getName(),
                'status' => true,
            ],
        );

        $userCreated->socialAcounts()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $user->getId(),
            ],
            [
                'avatar' => $user->getAvatar()
            ]
        );

        $token = $userCreated->createToken('token-name')->plainTextToken;

        return response()->json($userCreated, 200, ['Access-Token' => $token]);
    }

    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['google', 'facebook'])) {
            return response()->json(['error' => 'Por favor, ingrese usando google, facebook'], 422);
        }
    }
}
