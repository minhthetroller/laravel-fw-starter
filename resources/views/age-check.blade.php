@extends('layouts.app')

@section('title', 'Age Verification')

@section('content')
<div class="text-center py-12">
    {{-- Shield Icon --}}
    <div class="mb-8">
        <svg class="w-32 h-32 text-red-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
        </svg>
    </div>

    {{-- Title --}}
    <h2 class="text-2xl font-semibold text-slate-700 mb-4">Age Verification Required</h2>

    <p class="text-slate-500 mb-8 max-w-md mx-auto">
        This content is age-restricted. Please enter your age to continue.
        You must be 18 years or older to access this content.
    </p>

    {{-- Age Form --}}
    <form method="POST" action="{{ route('age-check.verify') }}" class="max-w-xs mx-auto">
        @csrf
        
        <div class="mb-6">
            <label for="age" class="block text-sm font-medium text-slate-700 mb-2">Enter Your Age</label>
            <input 
                type="number" 
                name="age" 
                id="age" 
                min="1" 
                max="120" 
                required
                class="w-full px-4 py-3 text-center text-2xl font-bold border border-slate-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none"
                placeholder="18"
                value="{{ old('age') }}"
            >
            @error('age')
                <p class="error mt-2">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn w-full !text-white bg-red-500 hover:bg-red-600 py-3 text-lg">
            Verify Age
        </button>
    </form>

    {{-- Back Link --}}
    <div class="mt-8">
        <a href="{{ route('home') }}" class="link text-sm">
            ← Back to Home
        </a>
    </div>
</div>
@endsection
