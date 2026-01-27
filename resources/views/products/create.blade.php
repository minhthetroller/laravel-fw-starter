@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
<div class="space-y-6">
    <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
        @csrf

        {{-- Name Field --}}
        <div>
            <label for="name">Product Name</label>
            <input type="text"
                   name="name"
                   id="name"
                   value="{{ old('name') }}"
                   placeholder="Enter product name"
                   required
                   maxlength="255"
                   class="@error('name') border-red-500 @enderror">
            @error('name')
                <p class="error mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description Field --}}
        <div>
            <label for="description">Description</label>
            <textarea name="description"
                      id="description"
                      rows="4"
                      placeholder="Enter product description"
                      required
                      maxlength="5000"
                      class="@error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
            @error('description')
                <p class="error mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Price Field --}}
        <div>
            <label for="price">Price ($)</label>
            <input type="number"
                   name="price"
                   id="price"
                   value="{{ old('price') }}"
                   placeholder="0.00"
                   required
                   min="0"
                   max="999999.99"
                   step="0.01"
                   class="@error('price') border-red-500 @enderror">
            @error('price')
                <p class="error mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Image URL Field --}}
        <div>
            <label for="image">Image URL (Optional)</label>
            <input type="url"
                   name="image"
                   id="image"
                   value="{{ old('image') }}"
                   placeholder="https://example.com/image.jpg"
                   maxlength="500"
                   class="@error('image') border-red-500 @enderror">
            @error('image')
                <p class="error mt-1">{{ $message }}</p>
            @enderror
            <p class="text-xs text-slate-500 mt-1">Enter a valid URL for the product image</p>
        </div>

        {{-- Submit Button --}}
        <div class="flex justify-between items-center pt-4">
            <a href="{{ route('products.index') }}" class="link">← Cancel</a>
            <button type="submit" class="btn bg-green-500 text-white hover:bg-green-600">
                Create Product
            </button>
        </div>
    </form>
</div>
@endsection
