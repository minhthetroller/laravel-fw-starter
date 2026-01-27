@extends('layouts.app')

@section('title', 'Welcome Home')

@section('content')
<div class="space-y-6">
    {{-- Hero Section --}}
    <div class="bg-gradient-to-r from-slate-100 to-slate-200 rounded-lg p-8 text-center shadow-md">
        <h2 class="text-3xl font-bold text-slate-800 mb-4">Welcome to Laravel Application</h2>
        <p class="text-slate-600">A comprehensive product management system with student information and chess board visualization</p>
    </div>

    {{-- Quick Links --}}
    <div class="grid grid-cols-2 gap-4">
        <a href="{{ route('products.index') }}" class="block p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-full">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="font-semibold text-slate-700">Products</h3>
                    <p class="text-sm text-slate-500">Browse catalog</p>
                </div>
            </div>
        </a>

        <a href="{{ route('sinhvien') }}" class="block p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="p-3 bg-purple-100 rounded-full">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="font-semibold text-slate-700">Student Info</h3>
                    <p class="text-sm text-slate-500">View student details</p>
                </div>
            </div>
        </a>

        <a href="{{ route('banco', 8) }}" class="block p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
            <div class="flex items-center">
                <div class="p-3 bg-amber-100 rounded-full">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="font-semibold text-slate-700">Chess Board</h3>
                    <p class="text-sm text-slate-500">View 8x8 board</p>
                </div>
            </div>
        </a>
    </div>

    {{-- Footer --}}
    <div class="text-center text-slate-500 text-sm">
        <p>Built with Laravel {{ app()->version() }}</p>
    </div>
</div>
@endsection
