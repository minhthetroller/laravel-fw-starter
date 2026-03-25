@extends('layouts.app')

@section('title', 'Sign In')

@section('content')
<div class="max-w-md mx-auto px-4 py-10">
    {{-- Header --}}
    <div class="text-center mb-6">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-2xl mb-4">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-900">Welcome Back</h2>
        <p class="text-gray-500 mt-1">Sign in to your account</p>
    </div>

    {{-- Login Form --}}
    <form method="POST" action="{{ route('login') }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
        @csrf

        {{-- Username Field --}}
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
                Username or Student ID
            </label>
            <input
                type="text"
                id="username"
                name="username"
                value="{{ old('username') }}"
                class="w-full px-3 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 {{ $errors->has('username') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
                placeholder="Enter your username or student ID"
                required
                autocomplete="username"
            >
            @error('username')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password Field --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                Password
            </label>
            <input
                type="password"
                id="password"
                name="password"
                class="w-full px-3 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
                placeholder="Enter your password"
                required
                autocomplete="current-password"
            >
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit Button --}}
        <div class="pt-2">
            <button type="submit"
                    class="w-full py-2.5 px-4 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-colors">
                Sign In
            </button>
        </div>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600">
        Don't have an account?
        <a href="{{ route('register') }}" class="font-medium text-blue-600 hover:text-blue-700">
            Create one here
        </a>
    </p>
</div>
@endsection
