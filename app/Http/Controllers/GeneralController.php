<?php

namespace App\Http\Controllers;

use App\Cache\Cache;
use App\Models\User;
class GeneralController extends Controller
{
    public function showProduct(Cache $cache) {
        $products = $cache->cacheProductOrderByDesc();
        return view('main', compact('products'));
    }

    public function getPersonaData() {
        $purchases = User::find(1)->products()->get();
        return view('user.persona', compact('purchases'));
    }
}
