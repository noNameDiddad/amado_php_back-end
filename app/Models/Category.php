<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
    ];

    protected $hidden  = [
        'updated_at',
    ];

    public static function cacheAll()
    {
        return cache()->remember('product.main_page', 60*60*24, function () {
            return self::all();
        });
    }
}
