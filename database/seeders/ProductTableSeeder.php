<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\UserProduct;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->count(10)->create();
        Product::factory()->count(100)->create();
        UserProduct::factory()->count(30)->create();
    }
}
