@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
<div class="text-center py-12">
    {{-- 404 Icon --}}
    <div class="mb-8">
        <svg class="w-32 h-32 text-slate-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
    </div>

    {{-- Error Code --}}
    <h1 class="text-6xl font-bold text-slate-300 mb-4">404</h1>

    {{-- Error Message --}}
    <h2 class="text-2xl font-semibold text-slate-700 mb-4">Page Not Found</h2>

    <p class="text-slate-500 mb-8 max-w-md mx-auto">
        Sorry, the page you're looking for doesn't exist or has been moved.
        Please check the URL or navigate back to the home page.
    </p>

    {{-- Action Buttons --}}
    <div class="space-x-4">
        <a href="{{ route('home') }}" class="btn bg-blue-500 text-white hover:bg-blue-600">
            Go to Home
        </a>
        <a href="javascript:history.back()" class="btn">
            Go Back
        </a>
    </div>

    {{-- Helpful Links --}}
    <div class="mt-12 pt-8 border-t border-slate-200">
        <p class="text-slate-500 mb-4">Perhaps you were looking for:</p>
        <div class="flex justify-center space-x-6 text-sm">
            <a href="{{ route('home') }}" class="link">Home</a>
            <a href="{{ route('products.index') }}" class="link">Products</a>
            <a href="{{ route('sinhvien') }}" class="link">Student Info</a>
            <a href="{{ route('banco', 8) }}" class="link">Chess Board</a>
        </div>
    </div>
</div>
@endsection
