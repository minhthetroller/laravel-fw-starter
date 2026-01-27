@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="space-y-6">
    {{-- Header with Add Button --}}
    <div class="flex justify-between items-center">
        <p class="text-slate-600">Browse our product catalog</p>
        <a href="{{ route('products.create') }}" class="btn bg-green-500 text-white hover:bg-green-600">
            + Add Product
        </a>
    </div>

    {{-- Products Grid --}}
    @if($products->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($products as $product)
                <a href="{{ route('products.show', $product) }}"
                   class="block bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                    {{-- Product Image --}}
                    @if($product->image)
                        <div class="h-40 bg-slate-200 flex items-center justify-center overflow-hidden">
                            <img src="{{ e($product->image) }}"
                                 alt="{{ e($product->name) }}"
                                 class="w-full h-full object-cover"
                                 onerror="this.src='https://via.placeholder.com/640x480?text=No+Image'">
                        </div>
                    @else
                        <div class="h-40 bg-slate-200 flex items-center justify-center">
                            <svg class="w-16 h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif

                    {{-- Product Info --}}
                    <div class="p-4">
                        <h3 class="font-semibold text-slate-800 truncate">{{ e($product->name) }}</h3>
                        <p class="text-sm text-slate-500 mt-1 line-clamp-2">{{ e($product->description) }}</p>
                        <div class="mt-3 flex justify-between items-center">
                            <span class="text-lg font-bold text-green-600">${{ number_format($product->price, 2) }}</span>
                            <span class="text-xs text-slate-400">{{ $product->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-12 bg-slate-50 rounded-lg">
            <svg class="w-16 h-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            <h3 class="text-lg font-medium text-slate-600 mb-2">No Products Yet</h3>
            <p class="text-slate-500 mb-4">Get started by adding your first product.</p>
            <a href="{{ route('products.create') }}" class="btn bg-green-500 text-white hover:bg-green-600">
                Add First Product
            </a>
        </div>
    @endif

    {{-- Back to Home --}}
    <div class="mt-4">
        <a href="{{ route('home') }}" class="link">← Back to Home</a>
    </div>
</div>

@section('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
@endsection
