@extends('adminlte::page')

@section('title', 'Edit Product')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0"><i class="fas fa-edit mr-2"></i>Edit: {{ $product->name }}</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Back to Products
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <form method="POST" action="{{ route('admin.products.update', $product) }}">
                @csrf
                @method('PUT')

                {{-- Basic Info --}}
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-info-circle mr-1"></i>Basic Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Product Name <span class="text-danger">*</span></label>
                            <input type="text" id="name" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $product->name) }}" required maxlength="255">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="brand">Brand <span class="text-danger">*</span></label>
                                <input type="text" id="brand" name="brand"
                                       class="form-control @error('brand') is-invalid @enderror"
                                       value="{{ old('brand', $product->brand) }}" required maxlength="100">
                                @error('brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sku">SKU</label>
                                <input type="text" id="sku" name="sku"
                                       class="form-control @error('sku') is-invalid @enderror"
                                       value="{{ old('sku', $product->sku) }}" maxlength="100">
                                @error('sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea id="description" name="description" rows="4"
                                      class="form-control @error('description') is-invalid @enderror"
                                      required maxlength="5000">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="price">Price (USD) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" id="price" name="price"
                                           class="form-control @error('price') is-invalid @enderror"
                                           value="{{ old('price', $product->price) }}" required
                                           min="0" max="999999.99" step="0.01">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="stock">Stock Quantity</label>
                                <input type="number" id="stock" name="stock"
                                       class="form-control @error('stock') is-invalid @enderror"
                                       value="{{ old('stock', $product->stock) }}" min="0">
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image">Image URL</label>
                            <input type="url" id="image" name="image"
                                   class="form-control @error('image') is-invalid @enderror"
                                   value="{{ old('image', $product->image) }}" maxlength="500">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($product->image)
                                <img src="{{ e($product->image) }}" alt="Current image"
                                     class="img-thumbnail mt-2" style="max-height:100px;">
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Specs --}}
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-microchip mr-1"></i>Phone Specifications</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="color">Color</label>
                                <input type="text" id="color" name="color"
                                       class="form-control @error('color') is-invalid @enderror"
                                       value="{{ old('color', $product->color) }}" maxlength="50">
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="ram">RAM</label>
                                <input type="text" id="ram" name="ram"
                                       class="form-control @error('ram') is-invalid @enderror"
                                       value="{{ old('ram', $product->ram) }}" maxlength="20">
                                @error('ram')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="rom">Storage (ROM)</label>
                                <input type="text" id="rom" name="rom"
                                       class="form-control @error('rom') is-invalid @enderror"
                                       value="{{ old('rom', $product->rom) }}" maxlength="20">
                                @error('rom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="screen_size">Screen Size</label>
                                <input type="text" id="screen_size" name="screen_size"
                                       class="form-control @error('screen_size') is-invalid @enderror"
                                       value="{{ old('screen_size', $product->screen_size) }}" maxlength="20">
                                @error('screen_size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="battery">Battery</label>
                                <input type="text" id="battery" name="battery"
                                       class="form-control @error('battery') is-invalid @enderror"
                                       value="{{ old('battery', $product->battery) }}" maxlength="30">
                                @error('battery')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mb-4">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary mr-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>

        <div class="col-md-4">
            <div class="card card-outline card-danger">
                <div class="card-header">
                    <h3 class="card-title text-danger"><i class="fas fa-exclamation-triangle mr-1"></i>Danger Zone</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted small">Permanently delete this product. This action cannot be undone.</p>
                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                          onsubmit="return confirm('Delete \'{{ addslashes($product->name) }}\'? This cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block">
                            <i class="fas fa-trash mr-1"></i> Delete Product
                        </button>
                    </form>
                </div>
            </div>

            <div class="card card-outline card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Product Info</h3>
                </div>
                <div class="card-body small text-muted">
                    <p><strong>ID:</strong><br><code>{{ $product->id }}</code></p>
                    <p><strong>Created:</strong><br>{{ $product->created_at->format('d M Y, H:i') }}</p>
                    <p class="mb-0"><strong>Last Updated:</strong><br>{{ $product->updated_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
@stop
