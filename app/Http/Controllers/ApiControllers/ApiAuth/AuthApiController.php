<?php

namespace App\Http\Controllers\ApiControllers\ApiAuth;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthApiController extends Controller
{
    protected function requestToken(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
                'device_name' => 'required',
            ]
        );

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessage([
                'email' => ['credenciales incorrectas']
            ]);
        }

        return response()->json($this->getUserAndToken($user, $request->device_name));
    }

    protected function requestTokenGoogle(Request $request)
    {
        try {
            $user = Socialite::driver('google')->stateless()->userFromToken($request->token);

            $userFromDb = User::firstOrCreate(
                ['email' => $user->email],
                [
                    'email_verified_at' => Carbon::now(),
                    "apellido" => null,
                    "telefono" => null,
                    "ubicacion" => null,
                    "estado" => false,
                    'name' => $user->name,
                    'foto' => $user->avatar
                ]
            );

            $userFromDb = User::where("email", $user->email)->first();
            return response()->json($this->getUserAndToken($userFromDb, $request->device_name));
        } catch (\Throwable $th) {
            return response()->json(["message" => "credenciales incorrectas", "code" => 401]);
        }
    }

    private function getUserAndToken(User $user, $device_name)
    {
        return ['user' => $user, 'access-token' => $user->createToken($device_name)->plainTextToken];
    }

    protected function logout()
    {
        try {
            auth()->user()->tokens()->delete();
            return response()->json(["message" => "se ha cerrado sesion con exito", "code" => 200]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(["message" => "hubo un problema al cerrar sesion intente de nuevo"], 500);
        }
    }
}
