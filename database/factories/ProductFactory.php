<?php

namespace Database\Factories;

use App\Models\Category;
use Faker\Core\Number;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $upload_folder = 'public/images/';
        $product = $this->faker->name;
        $name = str_replace(" ", '',$product);
        $name = $name.".jpg";
        $path = $upload_folder.$name;
        $file1 = Storage::get($upload_folder.'placeholder_image.jpg');
        Storage::put($path, $file1);
        return [
            'product' => $product,
            'description' => $this->faker->realText(500,2),
            'number' => $this->faker->numberBetween(1000,9999)."-".$this->faker->numberBetween(1000,9999),
            'price' => $this->faker->numberBetween(100,1000000),
            'category_id' => $this->faker->numberBetween(1, 10),
            'image_path' => $name,
        ];
    }
}
