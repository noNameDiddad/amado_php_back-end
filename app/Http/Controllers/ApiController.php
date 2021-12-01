<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getProductsAll()
    {
        return Product::all();
    }

    public function getProductsNews(Request $request)
    {
        $count = $request->count;
        return Product::orderBy('id','desc')->take($count)->get();;
    }

    public function getCurrentUser(Request $request)
    {
        return $request->user();
    }

    public function createToken()
    {
        $user = User::find(1);
        $user->createToken('token-name', ['server:update'])->plainTextToken;
        return $user->createToken('token-name', ['server:update'])->plainTextToken;
    }
}
