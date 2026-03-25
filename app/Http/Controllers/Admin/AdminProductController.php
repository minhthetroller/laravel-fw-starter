<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($search = $request->query('search')) {
            $search = strip_tags(trim($search));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        /** @var \Illuminate\Pagination\LengthAwarePaginator $products */
        $products = $query->latest()->paginate(20);
        $products->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(ProductRequest $request)
    {
        $validated = $request->validated();
        $validated['name'] = strip_tags($validated['name']);
        $validated['description'] = strip_tags($validated['description']);

        $product = Product::create($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', "Product \"{$product->name}\" created successfully.");
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $validated = $request->validated();
        $validated['name'] = strip_tags($validated['name']);
        $validated['description'] = strip_tags($validated['description']);

        $product->update($validated);

        return redirect()
            ->route('admin.products.index')
            ->with('success', "Product \"{$product->name}\" updated successfully.");
    }

    public function destroy(Product $product)
    {
        $name = $product->name;
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', "Product \"{$name}\" deleted successfully.");
    }
}
