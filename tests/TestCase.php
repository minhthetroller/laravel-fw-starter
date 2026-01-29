<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Setup the test environment.
     * Automatically bypasses age verification for all tests.
     */
    protected function setUp(): void
    {
        parent::setUp();

        // Bypass age verification for all tests by default
        session(['verified_age' => 18]);
    }
}
