@extends('layouts.app')

@section('title', 'Access Denied')

@section('content')
<div class="text-center py-12">
    {{-- Blocked Icon --}}
    <div class="mb-8">
        <svg class="w-32 h-32 text-red-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
        </svg>
    </div>

    {{-- Error Code --}}
    <h1 class="text-6xl font-bold text-red-300 mb-4">18+</h1>

    {{-- Error Message --}}
    <h2 class="text-2xl font-semibold text-slate-700 mb-4">Access Denied</h2>

    {{-- Alert Box --}}
    <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-8 max-w-md mx-auto">
        <div class="flex items-center justify-center mb-3">
            <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
            <span class="font-semibold text-red-700">Age Restriction</span>
        </div>
        <p class="text-red-600">
            You are not old enough to access this content.
            @if(isset($yearsRemaining) && $yearsRemaining > 0)
                <br><br>
                <span class="font-bold text-lg">
                    Come back in {{ $yearsRemaining }} {{ Str::plural('year', $yearsRemaining) }}!
                </span>
            @endif
        </p>
    </div>

    <p class="text-slate-500 mb-8 max-w-md mx-auto">
        This content is restricted to users who are 18 years of age or older.
        Please return when you meet the age requirement.
    </p>

    {{-- Action Buttons --}}
    <div class="space-x-4">
        <a href="{{ route('home') }}" class="btn bg-blue-500 text-white hover:bg-blue-600">
            Go to Home
        </a>
        <a href="{{ route('age-check') }}" class="btn">
            Try Again
        </a>
    </div>

    {{-- Info Text --}}
    <div class="mt-12 pt-8 border-t border-slate-200">
        <p class="text-slate-400 text-sm">
            Age verification is required to protect minors from age-restricted content.
        </p>
    </div>
</div>
@endsection
