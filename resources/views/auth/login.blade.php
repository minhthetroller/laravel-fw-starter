@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-slate-800">Welcome Back</h2>
        <p class="text-slate-600 mt-2">Sign in to your account</p>
    </div>

    {{-- Login Form --}}
    <form method="POST" action="{{ route('login') }}" class="bg-white rounded-lg shadow-md p-6 space-y-4">
        @csrf

        {{-- Username Field --}}
        <div>
            <label for="username">Username or Student ID</label>
            <input 
                type="text" 
                id="username" 
                name="username" 
                value="{{ old('username') }}"
                class="@error('username') border-red-500 @enderror"
                placeholder="Enter your username or student ID"
                required
                autocomplete="username"
            >
            @error('username')
                <p class="error mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password Field --}}
        <div>
            <label for="password">Password</label>
            <input 
                type="password" 
                id="password" 
                name="password"
                class="@error('password') border-red-500 @enderror"
                placeholder="Enter your password"
                required
                autocomplete="current-password"
            >
            @error('password')
                <p class="error mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit Button --}}
        <div class="pt-2">
            <button type="submit" class="btn w-full bg-white text-blue-600 hover:bg-slate-100 py-2 ring-1 ring-blue-500">
                Sign In
            </button>
        </div>
    </form>

    {{-- Register Link --}}
    <div class="text-center">
        <p class="text-slate-600">
            Don't have an account? 
            <a href="{{ route('register') }}" class="link text-blue-600 hover:text-blue-700">
                Create one here
            </a>
        </p>
    </div>

    {{-- Back to Home --}}
    <div class="text-center">
        <a href="{{ route('home') }}" class="text-slate-500 hover:text-slate-700 text-sm">
            ← Back to Home
        </a>
    </div>
</div>
@endsection
