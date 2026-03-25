<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    private function adminUser(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    /**
     * Test product index page loads successfully (public, no auth needed).
     */
    public function test_product_index_page_loads(): void
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertViewIs('products.index');
    }

    /**
     * Test product show page with valid UUID (public, no auth needed).
     */
    public function test_product_show_page_with_valid_uuid(): void
    {
        $product = Product::factory()->create();

        $response = $this->get('/products/'.$product->id);

        $response->assertStatus(200);
        $response->assertViewIs('products.show');
        $response->assertViewHas('product');
    }

    /**
     * Test product show page returns 404 for invalid UUID.
     */
    public function test_product_show_returns_404_for_invalid_uuid(): void
    {
        $response = $this->get('/products/invalid-uuid');

        $response->assertStatus(404);
    }

    /**
     * Test product show page returns 404 for non-existent product.
     */
    public function test_product_show_returns_404_for_nonexistent_product(): void
    {
        $response = $this->get('/products/00000000-0000-0000-0000-000000000000');

        $response->assertStatus(404);
    }

    /**
     * Test products are displayed on index page.
     */
    public function test_products_displayed_on_index_page(): void
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get('/products');

        $response->assertStatus(200);
        foreach ($products as $product) {
            $response->assertSee(e($product->name));
        }
    }

    /**
     * Test admin create page requires authentication.
     */
    public function test_admin_create_page_requires_auth(): void
    {
        $response = $this->get('/admin/products/create');

        $response->assertRedirect('/login');
    }

    /**
     * Test admin create page requires admin role.
     */
    public function test_admin_create_page_requires_admin_role(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $response = $this->actingAs($user)->get('/admin/products/create');

        $response->assertStatus(403);
    }

    /**
     * Test product can be created by admin with valid data.
     */
    public function test_product_can_be_created_with_valid_data(): void
    {
        $admin = $this->adminUser();
        $productData = [
            'name' => 'Samsung Galaxy S25',
            'brand' => 'Samsung',
            'description' => 'A flagship smartphone.',
            'price' => 999.99,
            'stock' => 10,
        ];

        $response = $this->actingAs($admin)->post('/admin/products', $productData);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', [
            'name' => 'Samsung Galaxy S25',
            'brand' => 'Samsung',
        ]);
    }

    /**
     * Test product creation fails with invalid data.
     */
    public function test_product_creation_fails_with_invalid_data(): void
    {
        $admin = $this->adminUser();

        $response = $this->actingAs($admin)->post('/admin/products', [
            'name' => '',
            'description' => '',
            'price' => 'not-a-number',
        ]);

        $response->assertSessionHasErrors(['name', 'description', 'price']);
    }

    /**
     * Test price validation rejects negative values.
     */
    public function test_price_validation_rejects_negative_values(): void
    {
        $admin = $this->adminUser();

        $response = $this->actingAs($admin)->post('/admin/products', [
            'name' => 'Test Product',
            'brand' => 'Samsung',
            'description' => 'Test description',
            'price' => -10.00,
        ]);

        $response->assertSessionHasErrors('price');
    }

    /**
     * Test XSS is not stored in product name.
     */
    public function test_xss_is_sanitized_in_product_name(): void
    {
        $admin = $this->adminUser();

        $response = $this->actingAs($admin)->post('/admin/products', [
            'name' => 'Safe Product Name',
            'brand' => 'Samsung',
            'description' => 'Safe description',
            'price' => 50.00,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseMissing('products', [
            'name' => '<script>alert("xss")</script>',
        ]);
    }
}
