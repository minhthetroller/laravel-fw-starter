<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::latest()->paginate(12);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created product in storage.
     * Uses ProductRequest for validation and SQL injection prevention.
     */
    public function store(ProductRequest $request)
    {
        // Validated data is already sanitized by ProductRequest
        $validated = $request->validated();

        // Additional XSS sanitization for text fields
        $validated['name'] = $this->sanitizeInput($validated['name']);
        $validated['description'] = $this->sanitizeInput($validated['description']);

        $product = Product::create($validated);

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified product.
     * Route model binding with UUID ensures valid UUID format.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Sanitize input to prevent XSS attacks.
     *
     * @param string $input
     * @return string
     */
    private function sanitizeInput(string $input): string
    {
        // Remove any HTML tags and encode special characters
        $sanitized = strip_tags($input);
        $sanitized = htmlspecialchars($sanitized, ENT_QUOTES, 'UTF-8');

        return $sanitized;
    }
}
