@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="space-y-4">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-blue-100 to-blue-200 rounded-lg p-6 text-center shadow-md">
        <div class="flex justify-center mb-3">
            <div class="p-3 bg-blue-500 rounded-full">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
            </div>
        </div>
        <h2 class="text-2xl font-bold text-slate-800 mb-1">Welcome Back</h2>
        <p class="text-sm text-slate-600">Sign in to continue</p>
    </div>

    {{-- Login Form --}}
    <div class="bg-white rounded-lg shadow-md p-5">
        <form method="POST" action="{{ route('login') }}" class="space-y-3">
            @csrf

            {{-- Username --}}
            <div>
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="Enter your username"
                    required
                    autocomplete="username"
                    class="@error('username') border-red-500 @enderror"
                >
                @error('username')
                    <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                    autocomplete="current-password"
                    class="@error('password') border-red-500 @enderror"
                >
                @error('password')
                    <p class="error mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center">
                <input
                    type="checkbox"
                    id="remember"
                    name="remember"
                    class="w-4 h-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                    {{ old('remember') ? 'checked' : '' }}
                >
                <label for="remember" class="ml-2 text-sm text-slate-600 normal-case mb-0">
                    Remember me
                </label>
            </div>

            {{-- Submit Button --}}
            <button
                type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg shadow-md transition-colors"
            >
                Sign In
            </button>
        </form>

        {{-- Register Link --}}
        <div class="mt-4 pt-4 border-t border-slate-200 flex items-center justify-between">
            <span class="text-sm text-slate-500">Don't have an account?</span>
            <a
                href="{{ route('register') }}"
                class="text-green-600 hover:text-green-700 font-medium text-sm"
            >
                Register →
            </a>
        </div>
    </div>

    {{-- Back to Home --}}
    <div class="text-center">
        <a href="{{ route('home') }}" class="text-sm text-slate-500 hover:text-slate-700">
            ← Back to Home
        </a>
    </div>
</div>
@endsection
