<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($search = $request->query('search')) {
            $search = strip_tags(trim($search));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($brand = $request->query('brand')) {
            $query->where('brand', strip_tags(trim($brand)));
        }

        if ($ram = $request->query('ram')) {
            $query->where('ram', strip_tags(trim($ram)));
        }

        if ($rom = $request->query('rom')) {
            $query->where('rom', strip_tags(trim($rom)));
        }

        if ($color = $request->query('color')) {
            $query->where('color', strip_tags(trim($color)));
        }

        /** @var \Illuminate\Pagination\LengthAwarePaginator $products */
        $products = $query->latest()->paginate(12);
        $products->withQueryString();

        // Distinct filter options for dropdowns
        $brands = Product::select('brand')->distinct()->orderBy('brand')->pluck('brand');
        $rams = Product::select('ram')->whereNotNull('ram')->distinct()->orderBy('ram')->pluck('ram');
        $roms = Product::select('rom')->whereNotNull('rom')->distinct()->orderBy('rom')->pluck('rom');
        $colors = Product::select('color')->whereNotNull('color')->distinct()->orderBy('color')->pluck('color');

        return view('products.index', compact('products', 'brands', 'rams', 'roms', 'colors'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
