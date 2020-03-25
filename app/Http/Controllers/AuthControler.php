<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthControler extends Controller
{
    public function registrForm () {
        return view('pages.register');
    }

    public function loginForm() {
        return view('pages.login');
    }

    public function register(Request $request) {
        $this->validate($request, [
            'phone' =>'required|unique:users|phone:US,BE,KG,RU',
            'password' =>'required'
        ]);
        $user = User::add($request->all());
        return redirect('/login');
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
            return redirect('/');
        }
        return redirect()->back()->with('status', 'Не правильный логин или пороль');
    }

    public function loguot() {
        Auth::logout();
        return redirect('/login');
    }
}
