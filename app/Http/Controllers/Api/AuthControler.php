<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthControler extends Controller
{
    public function register(Request $request) {
        $this->validate($request, [
            'phone' =>'required|unique:users|phone:US,BE,KG,RU',
            'password' =>'required',
            'name' => 'required'
        ]);
        $user = User::add($request->all());
        $user->setBalans(0);
        return response()->json([
            'api_token' => $user->api_token,
            'user' => $user
        ],200);
    }

    public  function login (Request $request) {
        $this->validate($request, [
            'phone' =>'required|phone:US,BE,KG,RU',
            'password' =>'required'
        ]);
        if( Auth::attempt([
            'phone' => $request->get('phone'),
            'password' => $request->get('password')
        ]) ){
            $userId = Auth::id();
            $user = User::find($userId);
            $user->generateToken();
            return response()->json([
                'api_token' => $user->api_token,
                'user' => $user
            ],200);
        }
        return response()->json([
            'message' => 'Неверный логин или пароль',
        ],403);
    }
}
