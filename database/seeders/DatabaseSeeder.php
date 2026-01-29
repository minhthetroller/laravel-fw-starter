<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed test user for authentication
        $this->call(UserSeeder::class);

        // Seed random products
        Product::factory(15)->create();

        // Create specific products for demonstration
        Product::create([
            'name' => 'Laptop Gaming Pro',
            'description' => 'High-performance gaming laptop with RTX 4080 graphics card, 32GB RAM, and 1TB SSD. Perfect for gaming and content creation.',
            'price' => 1499.99,
            'image' => 'https://via.placeholder.com/640x480/1e40af/ffffff?text=Laptop+Gaming+Pro',
        ]);

        Product::create([
            'name' => 'Wireless Headphones',
            'description' => 'Premium noise-cancelling wireless headphones with 30-hour battery life and studio-quality sound.',
            'price' => 299.99,
            'image' => 'https://via.placeholder.com/640x480/059669/ffffff?text=Wireless+Headphones',
        ]);

        Product::create([
            'name' => 'Smart Watch Series X',
            'description' => 'Advanced smartwatch with health monitoring, GPS, and water resistance up to 50m.',
            'price' => 399.99,
            'image' => 'https://via.placeholder.com/640x480/7c3aed/ffffff?text=Smart+Watch+X',
        ]);

        Product::create([
            'name' => 'Mechanical Keyboard RGB',
            'description' => 'Professional mechanical keyboard with Cherry MX switches and customizable RGB lighting.',
            'price' => 159.99,
            'image' => 'https://via.placeholder.com/640x480/dc2626/ffffff?text=Mechanical+Keyboard',
        ]);

        Product::create([
            'name' => 'Wireless Mouse Pro',
            'description' => 'Ergonomic wireless mouse with precision tracking and programmable buttons.',
            'price' => 79.99,
            'image' => 'https://via.placeholder.com/640x480/ea580c/ffffff?text=Wireless+Mouse',
        ]);

        Product::create([
            'name' => '4K Monitor 32 inch',
            'description' => '32-inch 4K UHD monitor with HDR support and 144Hz refresh rate.',
            'price' => 599.99,
            'image' => 'https://via.placeholder.com/640x480/0891b2/ffffff?text=4K+Monitor',
        ]);
    }
}
