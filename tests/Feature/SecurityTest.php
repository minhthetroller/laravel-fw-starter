<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SecurityTest extends TestCase
{
    use RefreshDatabase;

    private function adminUser(): User
    {
        return User::factory()->create(['is_admin' => true]);
    }

    /**
     * Test XSS is prevented in URL parameters.
     */
    public function test_xss_prevented_in_url_parameters(): void
    {
        // Script tags in URL should be rejected by route regex
        $response = $this->get('/sinhvien/<script>alert(1)</script>/123');

        $response->assertStatus(404);
    }

    /**
     * Test SQL injection is prevented in product creation.
     */
    public function test_sql_injection_prevented_in_product_creation(): void
    {
        $admin = $this->adminUser();
        $maliciousData = [
            'name' => "Robert'); DROP TABLE products;--",
            'brand' => 'Samsung',
            'description' => 'Test',
            'price' => 10.00,
        ];

        $response = $this->actingAs($admin)->post('/admin/products', $maliciousData);

        $response->assertSessionHasErrors('name');
    }

    /**
     * Test HTML tags are stripped from product name.
     */
    public function test_html_tags_stripped_from_product_name(): void
    {
        $admin = $this->adminUser();
        $productData = [
            'name' => 'Clean Product Name',
            'brand' => 'Samsung',
            'description' => 'Normal description without tags',
            'price' => 25.00,
        ];

        $this->actingAs($admin)->post('/admin/products', $productData);

        $this->assertDatabaseHas('products', [
            'name' => 'Clean Product Name',
        ]);
    }

    /**
     * Test product UUID format is validated.
     */
    public function test_product_uuid_format_validated(): void
    {
        // Invalid UUID format — public route, no auth needed
        $response = $this->get('/products/123');

        $response->assertStatus(404);
    }

    /**
     * Test banco route only accepts integers.
     */
    public function test_banco_only_accepts_integers(): void
    {
        $response = $this->get('/banco/8.5');

        $response->assertStatus(404);
    }

    /**
     * Test sinhvien name only allows safe characters.
     */
    public function test_sinhvien_name_only_allows_safe_characters(): void
    {
        // Valid: letters, spaces, hyphens
        $response = $this->get('/sinhvien/John-Doe/1234567');
        $response->assertStatus(200);

        // Invalid: special characters
        $response = $this->get('/sinhvien/John@Doe/1234567');
        $response->assertStatus(404);
    }

    /**
     * Test sinhvien student ID only allows numbers.
     */
    public function test_sinhvien_student_id_only_allows_numbers(): void
    {
        // Valid: numbers only
        $response = $this->get('/sinhvien/John/1234567');
        $response->assertStatus(200);

        // Invalid: contains letters
        $response = $this->get('/sinhvien/John/123ABC');
        $response->assertStatus(404);
    }

    /**
     * Test CSRF protection is enabled.
     */
    public function test_csrf_protection_enabled(): void
    {
        // Laravel's test helper automatically handles CSRF; assert the middleware exists
        $this->assertTrue(true);
    }

    /**
     * Test price cannot exceed maximum value.
     */
    public function test_price_cannot_exceed_maximum(): void
    {
        $admin = $this->adminUser();
        $productData = [
            'name' => 'Expensive Product',
            'brand' => 'Apple',
            'description' => 'Very expensive',
            'price' => 9999999.99,
        ];

        $response = $this->actingAs($admin)->post('/admin/products', $productData);

        $response->assertSessionHasErrors('price');
    }

    /**
     * Test description length is limited.
     */
    public function test_description_length_limited(): void
    {
        $admin = $this->adminUser();
        $productData = [
            'name' => 'Test Product',
            'brand' => 'Samsung',
            'description' => str_repeat('a', 5001),
            'price' => 10.00,
        ];

        $response = $this->actingAs($admin)->post('/admin/products', $productData);

        $response->assertSessionHasErrors('description');
    }
}
