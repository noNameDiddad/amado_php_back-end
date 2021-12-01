<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\UserProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    public function showProduct() {
        $products = cache()->remember('product.main_page', 60*60, function () {
            return Product::orderBy('id','desc')->take(12)->get();
        });
        return view('main', compact('products'));
    }

    public function getPersonaData() {
        $purchases = User::find(1)->products()->get();
        return view('user.persona', compact('purchases'));
    }
}
