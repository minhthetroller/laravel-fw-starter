<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test home page loads successfully.
     */
    public function test_home_page_loads(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('home');
    }

    /**
     * Test home page contains navigation links.
     */
    public function test_home_page_contains_navigation_links(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Products');
        $response->assertSee('Student Info');
        $response->assertSee('Chess Board');
    }

    /**
     * Test sinhvien route with default parameters.
     */
    public function test_sinhvien_route_with_default_parameters(): void
    {
        $response = $this->get('/sinhvien');

        $response->assertStatus(200);
        $response->assertViewIs('sinhvien');
        $response->assertSee('Nguyen Tuan Minh');
        $response->assertSee('4003867');
    }

    /**
     * Test sinhvien route with custom parameters.
     */
    public function test_sinhvien_route_with_custom_parameters(): void
    {
        $response = $this->get('/sinhvien/John-Doe/1234567');

        $response->assertStatus(200);
        $response->assertViewIs('sinhvien');
        $response->assertSee('John-Doe');
        $response->assertSee('1234567');
    }

    /**
     * Test sinhvien route sanitizes XSS in name.
     */
    public function test_sinhvien_route_sanitizes_xss_in_name(): void
    {
        // The route regex should reject this
        $response = $this->get('/sinhvien/<script>/1234567');

        $response->assertStatus(404);
    }

    /**
     * Test sinhvien route rejects invalid student ID.
     */
    public function test_sinhvien_route_rejects_invalid_student_id(): void
    {
        $response = $this->get('/sinhvien/John/abc123');

        $response->assertStatus(404);
    }

    /**
     * Test banco route with valid size.
     */
    public function test_banco_route_with_valid_size(): void
    {
        $response = $this->get('/banco/8');

        $response->assertStatus(200);
        $response->assertViewIs('banco');
        $response->assertViewHas('n', 8);
    }

    /**
     * Test banco route with different sizes.
     */
    public function test_banco_route_with_different_sizes(): void
    {
        foreach ([4, 8, 10, 12] as $size) {
            $response = $this->get('/banco/' . $size);

            $response->assertStatus(200);
            $response->assertViewHas('n', $size);
        }
    }

    /**
     * Test banco route limits size to maximum 20.
     */
    public function test_banco_route_limits_size_to_maximum(): void
    {
        $response = $this->get('/banco/25');

        $response->assertStatus(200);
        // Size should be capped at 20
        $response->assertViewHas('n', 20);
    }

    /**
     * Test banco route rejects non-numeric size.
     */
    public function test_banco_route_rejects_non_numeric_size(): void
    {
        $response = $this->get('/banco/abc');

        $response->assertStatus(404);
    }

    /**
     * Test fallback route returns 404 page.
     */
    public function test_fallback_route_returns_404(): void
    {
        $response = $this->get('/non-existent-page');

        $response->assertStatus(404);
        $response->assertViewIs('errors.404');
    }

    /**
     * Test 404 page contains helpful content.
     */
    public function test_404_page_contains_helpful_content(): void
    {
        $response = $this->get('/this-page-does-not-exist');

        $response->assertStatus(404);
        $response->assertSee('Page Not Found');
        $response->assertSee('Go to Home');
    }
}
