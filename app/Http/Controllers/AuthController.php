<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function sign_in()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $remember = false;
        if ($request->remember == true)
        {
            $remember = true;
        }

        if (Auth::attempt($request->only(['email', 'password'], $remember))) {
            return redirect()->route('persona');
        }
        return redirect()->route('login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function authorization(RegisterRequest $request)
    {
        $new_user = User::create($request->all());
        $new_user->password = bcrypt($request->password);
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
