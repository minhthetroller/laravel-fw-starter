@extends('layouts.app')

@section('title', 'All Phones')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Page header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">All Phones</h1>
        <p class="text-gray-500 text-sm mt-1">{{ $products->total() }} phones available</p>
    </div>

    {{-- Filters --}}
    <form method="GET" action="{{ route('products.index') }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 mb-6">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
            <div class="col-span-2 sm:col-span-3 lg:col-span-1">
                <label class="block text-xs font-medium text-gray-600 mb-1">Search</label>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Name, brand..."
                       class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Brand</label>
                <select name="brand" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">
                    <option value="">All Brands</option>
                    @foreach($brands as $b)
                        <option value="{{ $b }}" {{ request('brand') === $b ? 'selected' : '' }}>{{ $b }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">RAM</label>
                <select name="ram" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">
                    <option value="">All RAM</option>
                    @foreach($rams as $r)
                        <option value="{{ $r }}" {{ request('ram') === $r ? 'selected' : '' }}>{{ $r }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Storage</label>
                <select name="rom" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">
                    <option value="">All Storage</option>
                    @foreach($roms as $r)
                        <option value="{{ $r }}" {{ request('rom') === $r ? 'selected' : '' }}>{{ $r }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Color</label>
                <select name="color" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 bg-white">
                    <option value="">All Colors</option>
                    @foreach($colors as $c)
                        <option value="{{ $c }}" {{ request('color') === $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex items-center gap-2 mt-3">
            <button type="submit" class="px-4 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                Apply Filters
            </button>
            @if(request()->hasAny(['search','brand','ram','rom','color']))
                <a href="{{ route('products.index') }}" class="px-4 py-2 text-sm text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                    Clear
                </a>
            @endif
        </div>
    </form>

    {{-- Product grid --}}
    @if($products->isEmpty())
        <div class="text-center py-20">
            <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
            <p class="text-gray-500 font-medium">No phones found.</p>
            @if(request()->hasAny(['search','brand','ram','rom','color']))
                <a href="{{ route('products.index') }}" class="text-blue-600 text-sm mt-2 inline-block">Clear filters</a>
            @endif
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
            @foreach($products as $product)
                <a href="{{ route('products.show', $product) }}"
                   class="group bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md hover:border-blue-200 transition-all overflow-hidden flex flex-col">
                    {{-- Image --}}
                    <div class="h-44 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center overflow-hidden">
                        @if($product->image)
                            <img src="{{ e($product->image) }}" alt="{{ e($product->name) }}"
                                 class="h-full w-full object-contain p-4 group-hover:scale-105 transition-transform duration-300">
                        @else
                            <svg class="h-16 w-16 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                        @endif
                    </div>

                    {{-- Card body --}}
                    <div class="p-4 flex flex-col flex-1">
                        <div class="flex items-start justify-between gap-2 mb-1">
                            <span class="text-xs font-semibold text-blue-600 uppercase tracking-wide">{{ e($product->brand) }}</span>
                            @if($product->stock > 0)
                                <span class="text-xs text-green-600 bg-green-50 px-2 py-0.5 rounded-full font-medium flex-shrink-0">In Stock</span>
                            @else
                                <span class="text-xs text-red-500 bg-red-50 px-2 py-0.5 rounded-full font-medium flex-shrink-0">Out of Stock</span>
                            @endif
                        </div>
                        <h3 class="font-semibold text-gray-900 line-clamp-2 text-sm leading-snug mb-2 group-hover:text-blue-600 transition-colors">
                            {{ e($product->name) }}
                        </h3>

                        {{-- Spec chips --}}
                        <div class="flex flex-wrap gap-1 mb-3">
                            @if($product->ram)
                                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">{{ e($product->ram) }}</span>
                            @endif
                            @if($product->rom)
                                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">{{ e($product->rom) }}</span>
                            @endif
                            @if($product->color)
                                <span class="text-xs bg-gray-100 text-gray-600 px-2 py-0.5 rounded-full">{{ e($product->color) }}</span>
                            @endif
                        </div>

                        <div class="mt-auto pt-2 border-t border-gray-50">
                            <p class="text-lg font-bold text-gray-900">${{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $products->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
