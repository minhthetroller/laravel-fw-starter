@extends('layouts.app')

@section('title', 'Home')

@section('content')
{{-- Hero --}}
<section class="relative overflow-hidden bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white">
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
            <polygon fill="white" points="0,100 100,0 100,100"/>
        </svg>
    </div>
    <div class="relative max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <div class="inline-flex items-center gap-2 bg-white/10 border border-white/20 rounded-full px-4 py-1.5 text-sm font-medium mb-6">
            <span class="h-2 w-2 bg-green-400 rounded-full"></span>
            New arrivals in stock
        </div>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight mb-4">
            Find Your<br><span class="text-blue-200">Perfect Phone</span>
        </h1>
        <p class="text-lg text-blue-100 mb-8 max-w-xl mx-auto">
            Explore our curated collection of flagship and budget smartphones with detailed specs at your fingertips.
        </p>
        <div class="flex flex-wrap gap-3 justify-center">
            <a href="{{ route('products.index') }}"
               class="inline-flex items-center gap-2 bg-white text-blue-700 hover:bg-blue-50 font-semibold px-6 py-3 rounded-xl shadow-lg transition-colors">
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                Shop Now
            </a>
            @auth
                @if(auth()->user()->is_admin)
                <a href="/admin" class="inline-flex items-center gap-2 border border-white/40 hover:bg-white/10 font-semibold px-6 py-3 rounded-xl transition-colors">
                    Admin Panel
                </a>
                @endif
            @else
            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 border border-white/40 hover:bg-white/10 font-semibold px-6 py-3 rounded-xl transition-colors">
                Create Account
            </a>
            @endauth
        </div>
    </div>
</section>

{{-- Featured Phones --}}
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Featured Phones</h2>
            <p class="text-gray-500 mt-1">Handpicked latest arrivals</p>
        </div>
        <a href="{{ route('products.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
            View all &rarr;
        </a>
    </div>

    @if($featured->isEmpty())
        <div class="text-center py-16 text-gray-400">
            <svg class="h-12 w-12 mx-auto mb-4 opacity-40" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
            </svg>
            <p>No products yet. Check back soon!</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($featured as $product)
            <a href="{{ route('products.show', $product) }}"
               class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all overflow-hidden flex flex-col">
                {{-- Image --}}
                <div class="h-44 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center">
                    @if($product->image)
                        <img src="{{ e($product->image) }}" alt="{{ e($product->name) }}"
                             class="h-full w-full object-contain">
                    @else
                        <svg class="h-16 w-16 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    @endif
                </div>
                <div class="p-4 flex flex-col flex-1">
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-xs font-semibold text-blue-600 uppercase tracking-wide">{{ e($product->brand) }}</span>
                        @if($product->stock > 0)
                            <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">In Stock</span>
                        @else
                            <span class="text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded-full">Out of Stock</span>
                        @endif
                    </div>
                    <h3 class="font-semibold text-gray-900 text-sm line-clamp-2 flex-1 mb-3 group-hover:text-blue-600 transition-colors">
                        {{ e($product->name) }}
                    </h3>
                    <div class="flex flex-wrap gap-1.5 mb-3">
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
                    <p class="font-bold text-gray-900">${{ number_format($product->price, 2) }}</p>
                </div>
            </a>
            @endforeach
        </div>
    @endif
</section>

{{-- Why Us --}}
<section class="bg-gray-50 border-t border-gray-100">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-2xl font-bold text-gray-900 text-center mb-12">Why Choose PhoneStore?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="inline-flex items-center justify-center h-14 w-14 bg-blue-100 text-blue-600 rounded-2xl mb-4">
                    <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Best Prices</h3>
                <p class="text-sm text-gray-500">Competitive pricing across all major brands so you always get the best deal.</p>
            </div>
            <div class="text-center">
                <div class="inline-flex items-center justify-center h-14 w-14 bg-indigo-100 text-indigo-600 rounded-2xl mb-4">
                    <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Detailed Specs</h3>
                <p class="text-sm text-gray-500">Full specifications for every phone — RAM, storage, screen, battery, and more.</p>
            </div>
            <div class="text-center">
                <div class="inline-flex items-center justify-center h-14 w-14 bg-green-100 text-green-600 rounded-2xl mb-4">
                    <svg class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Trusted Brands</h3>
                <p class="text-sm text-gray-500">We stock only genuine devices from Samsung, Apple, Xiaomi, and other top brands.</p>
            </div>
        </div>
    </div>
</section>
@endsection
