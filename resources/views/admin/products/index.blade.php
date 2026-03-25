@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="m-0"><i class="fas fa-mobile-alt mr-2"></i>Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Add Product
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-1"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="card card-outline card-primary">
        <div class="card-header">
            <form method="GET" action="{{ route('admin.products.index') }}" class="form-inline">
                <div class="input-group input-group-sm" style="width:300px;">
                    <input type="text" name="search" class="form-control"
                           placeholder="Search name, brand, SKU..."
                           value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-default" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
            <div class="card-tools">
                <span class="badge badge-primary">{{ $products->total() }} total</span>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover table-striped table-sm mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>SKU</th>
                        <th>Color</th>
                        <th>RAM</th>
                        <th>ROM</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>
                                <strong>{{ $product->name }}</strong>
                                @if($product->sku)
                                    <br><small class="text-muted">{{ $product->sku }}</small>
                                @endif
                            </td>
                            <td>{{ $product->brand }}</td>
                            <td>{{ $product->sku ?? '—' }}</td>
                            <td>{{ $product->color ?? '—' }}</td>
                            <td>{{ $product->ram ?? '—' }}</td>
                            <td>{{ $product->rom ?? '—' }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>
                                <span class="badge badge-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="btn btn-xs btn-info">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form method="POST"
                                      action="{{ route('admin.products.destroy', $product) }}"
                                      class="d-inline"
                                      onsubmit="return confirm('Delete {{ addslashes($product->name) }}? This cannot be undone.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-danger">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                No products found.
                                <a href="{{ route('admin.products.create') }}">Add one now</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($products->hasPages())
            <div class="card-footer">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@stop

@section('css')
    <style>
        .table td { vertical-align: middle; }
    </style>
@stop
