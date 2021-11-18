<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function output() {
        $products = Product::orderBy('id','desc')->take(9)->get();

        return view('main', compact('products'));
    }
}
