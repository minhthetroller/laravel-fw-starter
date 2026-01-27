@extends('layouts.app')

@section('title', e($product->name))

@section('content')
<div class="space-y-6">
    {{-- Product Detail Card --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        {{-- Product Image --}}
        @if($product->image)
            <div class="h-64 bg-slate-200 flex items-center justify-center overflow-hidden">
                <img src="{{ e($product->image) }}"
                     alt="{{ e($product->name) }}"
                     class="w-full h-full object-cover"
                     onerror="this.src='https://via.placeholder.com/640x480?text=No+Image'">
            </div>
        @else
            <div class="h-64 bg-slate-200 flex items-center justify-center">
                <svg class="w-24 h-24 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        @endif

        {{-- Product Info --}}
        <div class="p-6">
            <div class="flex justify-between items-start mb-4">
                <h2 class="text-2xl font-bold text-slate-800">{{ e($product->name) }}</h2>
                <span class="text-2xl font-bold text-green-600">${{ number_format($product->price, 2) }}</span>
            </div>

            <div class="prose prose-slate max-w-none">
                <p class="text-slate-600">{{ e($product->description) }}</p>
            </div>

            {{-- Meta Information --}}
            <div class="mt-6 pt-4 border-t border-slate-200">
                <div class="flex justify-between text-sm text-slate-500">
                    <span>Product ID: <code class="bg-slate-100 px-2 py-1 rounded text-xs">{{ $product->id }}</code></span>
                    <span>Added {{ $product->created_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Action Buttons --}}
    <div class="flex justify-between items-center">
        <a href="{{ route('products.index') }}" class="link">← Back to Products</a>
        <a href="{{ route('products.create') }}" class="btn bg-green-500 text-white hover:bg-green-600">
            Add Another Product
        </a>
    </div>
</div>
@endsection
