<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends ApiController
{
    public function show(User $user)
    {
        return $this->showOne($user);
    }

    public function index()
    {
        return $this->showAll(User::all());
    }
}
