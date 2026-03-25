@extends('layouts.app')

@section('title', e($product->name))

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1 text-sm text-blue-600 hover:text-blue-800 mb-6">
        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Back to Products
    </a>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="md:flex">
            {{-- Image panel --}}
            <div class="md:w-2/5 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center min-h-64 p-8">
                @if($product->image)
                    <img src="{{ e($product->image) }}" alt="{{ e($product->name) }}"
                         class="max-h-72 object-contain">
                @else
                    <svg class="h-24 w-24 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                @endif
            </div>

            {{-- Details panel --}}
            <div class="md:w-3/5 p-6 lg:p-8">
                <div class="flex items-start justify-between gap-4 mb-2">
                    <span class="text-sm font-semibold text-blue-600 uppercase tracking-wide">{{ e($product->brand) }}</span>
                    @if($product->sku)
                        <span class="text-xs text-gray-400 bg-gray-100 px-2 py-1 rounded font-mono">{{ e($product->sku) }}</span>
                    @endif
                </div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">{{ e($product->name) }}</h1>

                <div class="flex items-center gap-3 mb-4">
                    <span class="text-3xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                    @if($product->stock > 0)
                        <span class="px-3 py-1 text-sm bg-green-100 text-green-700 rounded-full font-medium">
                            In Stock ({{ $product->stock }})
                        </span>
                    @else
                        <span class="px-3 py-1 text-sm bg-red-100 text-red-600 rounded-full font-medium">Out of Stock</span>
                    @endif
                </div>

                <p class="text-gray-600 leading-relaxed mb-6">{{ e($product->description) }}</p>

                {{-- Specs table --}}
                @if($product->ram || $product->rom || $product->color || $product->screen_size || $product->battery)
                    <div class="border-t border-gray-100 pt-4">
                        <h3 class="text-sm font-semibold text-gray-800 mb-3">Specifications</h3>
                        <dl class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">
                            @if($product->ram)
                                <div>
                                    <dt class="text-gray-500">RAM</dt>
                                    <dd class="font-medium text-gray-900">{{ e($product->ram) }}</dd>
                                </div>
                            @endif
                            @if($product->rom)
                                <div>
                                    <dt class="text-gray-500">Storage</dt>
                                    <dd class="font-medium text-gray-900">{{ e($product->rom) }}</dd>
                                </div>
                            @endif
                            @if($product->color)
                                <div>
                                    <dt class="text-gray-500">Color</dt>
                                    <dd class="font-medium text-gray-900">{{ e($product->color) }}</dd>
                                </div>
                            @endif
                            @if($product->screen_size)
                                <div>
                                    <dt class="text-gray-500">Screen</dt>
                                    <dd class="font-medium text-gray-900">{{ e($product->screen_size) }}</dd>
                                </div>
                            @endif
                            @if($product->battery)
                                <div>
                                    <dt class="text-gray-500">Battery</dt>
                                    <dd class="font-medium text-gray-900">{{ e($product->battery) }}</dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                @endif

                <div class="mt-6 pt-4 border-t border-gray-100 text-xs text-gray-400">
                    Added {{ $product->created_at->diffForHumans() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
