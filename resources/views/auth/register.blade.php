@extends('layouts.app')

@section('title', 'Create Account')

@section('content')
<div class="max-w-md mx-auto px-4 py-10">
    {{-- Header --}}
    <div class="text-center mb-6">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-2xl mb-4">
            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-900">Create Account</h2>
        <p class="text-gray-500 mt-1">Join us by filling in your information</p>
    </div>

    {{-- Registration Form --}}
    <form method="POST" action="{{ route('register') }}" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-4">
        @csrf

        {{-- Username Field --}}
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
                Username <span class="text-red-500">*</span>
            </label>
            <input
                type="text"
                id="username"
                name="username"
                value="{{ old('username') }}"
                class="w-full px-3 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 {{ $errors->has('username') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
                placeholder="Choose a username (letters, numbers, underscores)"
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
                Password <span class="text-red-500">*</span>
            </label>
            <input
                type="password"
                id="password"
                name="password"
                class="w-full px-3 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
                placeholder="Minimum 6 characters"
                required
                autocomplete="new-password"
            >
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password Field --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                Confirm Password <span class="text-red-500">*</span>
            </label>
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                placeholder="Re-enter your password"
                required
                autocomplete="new-password"
            >
        </div>

        {{-- Student ID Field --}}
        <div>
            <label for="stuId" class="block text-sm font-medium text-gray-700 mb-1">
                Student ID <span class="text-red-500">*</span>
            </label>
            <input
                type="text"
                id="stuId"
                name="stuId"
                value="{{ old('stuId') }}"
                class="w-full px-3 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 {{ $errors->has('stuId') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
                placeholder="Enter your student ID (numbers only)"
                required
            >
            @error('stuId')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Class Field --}}
        <div>
            <label for="class" class="block text-sm font-medium text-gray-700 mb-1">
                Class <span class="text-red-500">*</span>
            </label>
            <input
                type="text"
                id="class"
                name="class"
                value="{{ old('class') }}"
                class="w-full px-3 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 {{ $errors->has('class') ? 'border-red-400 bg-red-50' : 'border-gray-300' }}"
                placeholder="Enter your class (e.g., 67PM2)"
                required
            >
            @error('class')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Gender Field --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">
                Gender <span class="text-red-500">*</span>
            </label>
            <div class="flex gap-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input
                        type="radio"
                        name="gender"
                        value="male"
                        @checked(old('gender') === 'male')
                        class="h-4 w-4 text-blue-600"
                        required
                    >
                    <span class="text-sm text-gray-700">Male</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input
                        type="radio"
                        name="gender"
                        value="female"
                        @checked(old('gender') === 'female')
                        class="h-4 w-4 text-blue-600"
                    >
                    <span class="text-sm text-gray-700">Female</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input
                        type="radio"
                        name="gender"
                        value="other"
                        @checked(old('gender') === 'other')
                        class="h-4 w-4 text-blue-600"
                    >
                    <span class="text-sm text-gray-700">Other</span>
                </label>
            </div>
            @error('gender')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit Button --}}
        <div class="pt-2">
            <button type="submit"
                    class="w-full py-2.5 px-4 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition-colors">
                Create Account
            </button>
        </div>
    </form>

    <p class="mt-6 text-center text-sm text-gray-600">
        Already have an account?
        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-700">
            Sign in here
        </a>
    </p>
</div>
@endsection
