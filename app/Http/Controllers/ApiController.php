<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class ApiController extends Controller
{
    public function getProductsAll()
    {
        return Product::all();
    }

    public function getProductsNews(Request $request)
    {
        $count = $request->count;
        return Product::orderBy('id', 'desc')->take($count)->get();
    }

    public function getCurrentUser(Request $request)
    {
        return $request->user();
    }

    public function registerToken(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (PersonalAccessToken::where('tokenable_id', $user->id)->first() == null) {
            if (User::where('email', $request->email)->first() != null) {
                if (Auth::attempt($request->only(['email', 'password']))) {
                    $message = $user->createToken('token-name', ['server:update'])->plainTextToken;
                } else {
                    $message = "Неверный пароль";
                }
            } else {
                $message = "Несуществующий пользователь";
            }
        } else {
            $message = "На данного пользователя уже создан токен";
        }
        return $message;
    }
}
