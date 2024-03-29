<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product',
        'description',
        'number',
        'price',
        'category_id',
        'image_path',
    ];

    protected $hidden  = [
        'updated_at',
    ];

    public function categories(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
