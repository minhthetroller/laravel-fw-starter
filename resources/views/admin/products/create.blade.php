@extends('adminlte::page')

@section('title', 'Add Product')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0"><i class="fas fa-plus mr-2"></i>Add Product</h1>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left mr-1"></i> Back to Products
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <form method="POST" action="{{ route('admin.products.store') }}">
                @csrf

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
                                   value="{{ old('name') }}" required maxlength="255"
                                   placeholder="e.g. Samsung Galaxy S25">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="brand">Brand <span class="text-danger">*</span></label>
                                <input type="text" id="brand" name="brand"
                                       class="form-control @error('brand') is-invalid @enderror"
                                       value="{{ old('brand') }}" required maxlength="100"
                                       placeholder="e.g. Samsung">
                                @error('brand')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sku">SKU</label>
                                <input type="text" id="sku" name="sku"
                                       class="form-control @error('sku') is-invalid @enderror"
                                       value="{{ old('sku') }}" maxlength="100"
                                       placeholder="e.g. SAM-S25-BLK-8-256">
                                @error('sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea id="description" name="description" rows="4"
                                      class="form-control @error('description') is-invalid @enderror"
                                      required maxlength="5000"
                                      placeholder="Describe the product...">{{ old('description') }}</textarea>
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
                                           value="{{ old('price') }}" required
                                           min="0" max="999999.99" step="0.01"
                                           placeholder="0.00">
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="stock">Stock Quantity</label>
                                <input type="number" id="stock" name="stock"
                                       class="form-control @error('stock') is-invalid @enderror"
                                       value="{{ old('stock', 0) }}" min="0"
                                       placeholder="0">
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image">Image URL</label>
                            <input type="url" id="image" name="image"
                                   class="form-control @error('image') is-invalid @enderror"
                                   value="{{ old('image') }}" maxlength="500"
                                   placeholder="https://...">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                                       value="{{ old('color') }}" maxlength="50"
                                       placeholder="e.g. Phantom Black">
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="ram">RAM</label>
                                <input type="text" id="ram" name="ram"
                                       class="form-control @error('ram') is-invalid @enderror"
                                       value="{{ old('ram') }}" maxlength="20"
                                       placeholder="e.g. 8GB">
                                @error('ram')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label for="rom">Storage (ROM)</label>
                                <input type="text" id="rom" name="rom"
                                       class="form-control @error('rom') is-invalid @enderror"
                                       value="{{ old('rom') }}" maxlength="20"
                                       placeholder="e.g. 256GB">
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
                                       value="{{ old('screen_size') }}" maxlength="20"
                                       placeholder='e.g. 6.7"'>
                                @error('screen_size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="battery">Battery</label>
                                <input type="text" id="battery" name="battery"
                                       class="form-control @error('battery') is-invalid @enderror"
                                       value="{{ old('battery') }}" maxlength="30"
                                       placeholder="e.g. 5000mAh">
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
                        <i class="fas fa-save mr-1"></i> Save Product
                    </button>
                </div>
            </form>
        </div>

        <div class="col-md-4">
            <div class="card card-outline card-secondary">
                <div class="card-header">
                    <h3 class="card-title">Tips</h3>
                </div>
                <div class="card-body">
                    <ul class="pl-3 text-muted small">
                        <li>SKU must be unique across all products.</li>
                        <li>Name and Brand are required.</li>
                        <li>Specs (RAM, ROM, etc.) are optional but improve search.</li>
                        <li>Stock 0 shows as "Out of Stock" on the store.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop
