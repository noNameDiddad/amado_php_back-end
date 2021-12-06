<?php


namespace App\Cache;


use App\Models\Category;
use App\Models\Product;

class Cache
{
    private $productAmount;
    private $ttl;

    public function __construct($productAmount, $ttl)
    {
        $this->productAmount = $productAmount;
        $this->ttl = $ttl;
    }


    public function cacheCategoryAll()
    {
        return cache()->remember('category.all', $this->ttl, function () {
            return Category::all();
        });
    }

    public function cacheProductOrderByDesc()
    {
        return cache()->remember('product.main_page', $this->ttl, function () {
            return Product::orderBy('id','desc')->take( $this->productAmount)->get();
        });
    }
    public static function cacheForgetAll()
    {
        cache()->forget('product.index.without-filter');
        cache()->forget('product.main_page');
    }
}
