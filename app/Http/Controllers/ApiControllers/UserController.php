<?php

namespace App\Http\Controllers\ApiControllers;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends ApiController
{
    public function saveTelefono(User $user, Request $request)
    {
        $request->validate([
            'telefono' => 'required',
        ]);
        try {
            $user->telefono = $request->telefono;
            $user->estado = true;
            $user->update();
            return $this->showOne($user);
        } catch (\Throwable $th) {
            return $this->errorReponse("no se pudo completar la accion", 500);
        }
    }

    public function getUser()
    {
        $user = auth()->user();
        return $this->showOne($user);
    }

    public function updateUser(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:20',
                'apellido' => 'required|max:30',
                'ubicacion' => 'max:50',
                'fecha_nacimiento' => 'max:50',
            ]
        );
        try {
            $user = auth()->user();
            $user->name = $request->name;
            $user->apellido = $request->apellido;
            $user->ubicacion = $request->ubicacion;

            $user->update();
            return $this->showOne($user);
        } catch (\Throwable $th) {
            //throw $th;
            return $this->errorReponse("no se pudo completar la accion", 401);
        }
    }
}
