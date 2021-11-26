<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    public function showProduct() {
        $products = Product::orderBy('id','desc')->take(9)->get();

        return view('main', compact('products'));
    }

    public function getPersonaData() {
        $purchases = UserProduct::where('user_id', Auth::id())->get();
        return view('user.persona', compact('purchases'));
    }

    public function showToken()
    {
        return csrf_token();
    }
}
