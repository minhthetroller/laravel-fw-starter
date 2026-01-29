@extends('layouts.app')

@section('title', 'Create Account')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-slate-800">Create Account</h2>
        <p class="text-slate-600 mt-2">Join us by filling in your information</p>
    </div>

    {{-- Registration Form --}}
    <form method="POST" action="{{ route('register') }}" class="bg-white rounded-lg shadow-md p-6 space-y-4">
        @csrf

        {{-- Username Field --}}
        <div>
            <label for="username">Username <span class="text-red-500">*</span></label>
            <input 
                type="text" 
                id="username" 
                name="username" 
                value="{{ old('username') }}"
                class="@error('username') border-red-500 @enderror"
                placeholder="Choose a username (letters, numbers, underscores)"
                required
                autocomplete="username"
            >
            @error('username')
                <p class="error mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password Field --}}
        <div>
            <label for="password">Password <span class="text-red-500">*</span></label>
            <input 
                type="password" 
                id="password" 
                name="password"
                class="@error('password') border-red-500 @enderror"
                placeholder="Minimum 6 characters"
                required
                autocomplete="new-password"
            >
            @error('password')
                <p class="error mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password Field --}}
        <div>
            <label for="password_confirmation">Confirm Password <span class="text-red-500">*</span></label>
            <input 
                type="password" 
                id="password_confirmation" 
                name="password_confirmation"
                placeholder="Re-enter your password"
                required
                autocomplete="new-password"
            >
        </div>

        {{-- Student ID Field --}}
        <div>
            <label for="stuId">Student ID <span class="text-red-500">*</span></label>
            <input 
                type="text" 
                id="stuId" 
                name="stuId" 
                value="{{ old('stuId') }}"
                class="@error('stuId') border-red-500 @enderror"
                placeholder="Enter your student ID (numbers only)"
                required
            >
            @error('stuId')
                <p class="error mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Class Field --}}
        <div>
            <label for="class">Class <span class="text-red-500">*</span></label>
            <input 
                type="text" 
                id="class" 
                name="class" 
                value="{{ old('class') }}"
                class="@error('class') border-red-500 @enderror"
                placeholder="Enter your class (e.g., 67PM2)"
                required
            >
            @error('class')
                <p class="error mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Gender Field --}}
        <div>
            <label>Gender <span class="text-red-500">*</span></label>
            <div class="flex gap-6 mt-2">
                <label class="flex items-center cursor-pointer normal-case !mb-0">
                    <input 
                        type="radio" 
                        name="gender" 
                        value="male" 
                        @checked(old('gender') === 'male')
                        class="!w-4 !h-4 !p-0 !shadow-none"
                        required
                    >
                    <span class="ml-2 text-slate-700">Male</span>
                </label>
                <label class="flex items-center cursor-pointer normal-case !mb-0">
                    <input 
                        type="radio" 
                        name="gender" 
                        value="female"
                        @checked(old('gender') === 'female')
                        class="!w-4 !h-4 !p-0 !shadow-none"
                    >
                    <span class="ml-2 text-slate-700">Female</span>
                </label>
                <label class="flex items-center cursor-pointer normal-case !mb-0">
                    <input 
                        type="radio" 
                        name="gender" 
                        value="other"
                        @checked(old('gender') === 'other')
                        class="!w-4 !h-4 !p-0 !shadow-none"
                    >
                    <span class="ml-2 text-slate-700">Other</span>
                </label>
            </div>
            @error('gender')
                <p class="error mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Submit Button --}}
        <div class="pt-2">
            <button type="submit" class="btn w-full bg-white text-white hover:bg-slate-100 py-2">
                Create Account
            </button>
        </div>
    </form>

    {{-- Login Link --}}
    <div class="text-center">
        <p class="text-slate-600">
            Already have an account? 
            <a href="{{ route('login') }}" class="link text-blue-600 hover:text-blue-700">
                Sign in here
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
