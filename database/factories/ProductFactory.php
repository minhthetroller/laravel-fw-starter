<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brands = ['Samsung', 'Apple', 'Xiaomi', 'OPPO', 'Vivo', 'OnePlus', 'Google', 'Sony'];
        $rams = ['4GB', '6GB', '8GB', '12GB', '16GB'];
        $roms = ['64GB', '128GB', '256GB', '512GB'];
        $colors = ['Black', 'White', 'Blue', 'Silver', 'Gold', 'Green', 'Purple', 'Red'];
        $brand = fake()->randomElement($brands);

        return [
            'name' => $brand . ' ' . fake()->bothify('?? ###'),
            'brand' => $brand,
            'sku' => strtoupper(fake()->unique()->bothify('??-####')),
            'description' => fake()->paragraph(3),
            'price' => fake()->randomFloat(2, 99, 1999),
            'image' => null,
            'color' => fake()->randomElement($colors),
            'ram' => fake()->randomElement($rams),
            'rom' => fake()->randomElement($roms),
            'screen_size' => fake()->randomFloat(1, 5.5, 7.0) . '"',
            'battery' => fake()->numberBetween(3000, 6000) . 'mAh',
            'stock' => fake()->numberBetween(0, 100),
        ];
    }

    /**
     * Indicate that the product is expensive.
     */
    public function expensive(): static
    {
        return $this->state(fn (array $attributes) => [
            'price' => fake()->randomFloat(2, 500, 5000),
        ]);
    }

    /**
     * Indicate that the product is cheap.
     */
    public function cheap(): static
    {
        return $this->state(fn (array $attributes) => [
            'price' => fake()->randomFloat(2, 1, 50),
        ]);
    }
}
