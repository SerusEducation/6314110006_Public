<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $scanned_directory = array_diff(scandir(public_path().'\images\\'), array('..', '.','danger.png'));
        $images_collection = collect($scanned_directory);
        return [
            'product_name' => fake()->name(),
            'product_image' => $images_collection->random(),
            'product_description' => Str::random(100),
            'price' => rand(1, 1000) * 1.00,
        ];
    }
}
