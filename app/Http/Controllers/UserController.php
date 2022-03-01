<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(UserRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw new HttpResponseException(response());
            return response()->json(['failed' => 'The provided credentials are incorrect'], 401);
        }

        return $user;
    }

    public function index()
    {
        if (Auth::check()) {
            /**
             * После проверки уже можешь получать любое свойство модели
             * пользователя через фасад Auth, например id
             */
            $user = Auth::user()->is_admin;
        }
    }
}