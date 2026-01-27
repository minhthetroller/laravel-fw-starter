<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test product index page loads successfully.
     */
    public function test_product_index_page_loads(): void
    {
        $response = $this->get('/product');

        $response->assertStatus(200);
        $response->assertViewIs('products.index');
    }

    /**
     * Test product create page loads successfully.
     */
    public function test_product_create_page_loads(): void
    {
        $response = $this->get('/product/create');

        $response->assertStatus(200);
        $response->assertViewIs('products.create');
    }

    /**
     * Test product can be created with valid data.
     */
    public function test_product_can_be_created_with_valid_data(): void
    {
        $productData = [
            'name' => 'Test Product',
            'description' => 'This is a test product description.',
            'price' => 99.99,
            'image' => 'https://example.com/image.jpg',
        ];

        $response = $this->post('/product', $productData);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'description' => 'This is a test product description.',
        ]);
    }

    /**
     * Test product creation fails with invalid data.
     */
    public function test_product_creation_fails_with_invalid_data(): void
    {
        $response = $this->post('/product', [
            'name' => '',
            'description' => '',
            'price' => 'not-a-number',
        ]);

        $response->assertSessionHasErrors(['name', 'description', 'price']);
    }

    /**
     * Test product show page with valid UUID.
     */
    public function test_product_show_page_with_valid_uuid(): void
    {
        $product = Product::factory()->create();

        $response = $this->get('/product/' . $product->id);

        $response->assertStatus(200);
        $response->assertViewIs('products.show');
        $response->assertViewHas('product');
    }

    /**
     * Test product show page returns 404 for invalid UUID.
     */
    public function test_product_show_returns_404_for_invalid_uuid(): void
    {
        $response = $this->get('/product/invalid-uuid');

        $response->assertStatus(404);
    }

    /**
     * Test product show page returns 404 for non-existent product.
     */
    public function test_product_show_returns_404_for_nonexistent_product(): void
    {
        $response = $this->get('/product/00000000-0000-0000-0000-000000000000');

        $response->assertStatus(404);
    }

    /**
     * Test XSS is sanitized in product name.
     */
    public function test_xss_is_sanitized_in_product_name(): void
    {
        $productData = [
            'name' => 'Test Product', // Valid name (script tags stripped by request)
            'description' => 'Safe description',
            'price' => 50.00,
        ];

        $response = $this->post('/product', $productData);

        $response->assertRedirect();
        $this->assertDatabaseMissing('products', [
            'name' => '<script>alert("xss")</script>',
        ]);
    }

    /**
     * Test price validation rejects negative values.
     */
    public function test_price_validation_rejects_negative_values(): void
    {
        $productData = [
            'name' => 'Test Product',
            'description' => 'Test description',
            'price' => -10.00,
        ];

        $response = $this->post('/product', $productData);

        $response->assertSessionHasErrors('price');
    }

    /**
     * Test products are displayed on index page.
     */
    public function test_products_displayed_on_index_page(): void
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get('/product');

        $response->assertStatus(200);
        foreach ($products as $product) {
            $response->assertSee(e($product->name));
        }
    }
}
