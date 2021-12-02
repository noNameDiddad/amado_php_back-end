<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function sign_in()
    {
        $message = session()->get('message');
        return view('auth.login',compact('message'));
    }

    public function login(LoginRequest $request)
    {
        $remember = false;
        if ($request->remember == true)
        {
            $remember = true;
        }

        if (Auth::attempt($request->only(['email', 'password'], $remember))) {
            return redirect()->route('main');
        } else {
            return redirect()->route('login')->with('message', 'Неверный логин или пароль');
        }
    }

    public function sign_up()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $new_user = User::create($request->all());
        $new_user->password = Hash::make($request->password);
        $new_user->email_verified_at = now();
        $new_user->remember_token =  Str::random(10);

        $new_user->save();
        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect('/');
    }
}
