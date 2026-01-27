@extends('layouts.app')

@section('title', 'Student Information')

@section('content')
<div class="space-y-6">
    {{-- Student Card --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-purple-500 to-indigo-600 p-6 text-white text-center">
            <div class="w-24 h-24 bg-white rounded-full mx-auto mb-4 flex items-center justify-center">
                <svg class="w-16 h-16 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h2 class="text-2xl font-bold">{{ e($name) }}</h2>
            <p class="text-purple-200">Student</p>
        </div>

        {{-- Student Details --}}
        <div class="p-6">
            <div class="space-y-4">
                <div class="flex justify-between items-center py-3 border-b border-slate-200">
                    <span class="text-slate-600 font-medium">Full Name</span>
                    <span class="text-slate-800 font-semibold">{{ e($name) }}</span>
                </div>

                <div class="flex justify-between items-center py-3 border-b border-slate-200">
                    <span class="text-slate-600 font-medium">Student ID</span>
                    <span class="text-slate-800 font-semibold">{{ e($studentId) }}</span>
                </div>

                <div class="flex justify-between items-center py-3 border-b border-slate-200">
                    <span class="text-slate-600 font-medium">Project</span>
                    <span class="text-slate-800 font-semibold">Laravel Learning</span>
                </div>

                <div class="flex justify-between items-center py-3">
                    <span class="text-slate-600 font-medium">Status</span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        Active
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Custom URL Examples --}}
    <div class="bg-slate-50 rounded-lg p-4">
        <h3 class="font-semibold text-slate-700 mb-3">Try Custom URLs:</h3>
        <div class="space-y-2 text-sm">
            <p class="text-slate-600">
                <code class="bg-white px-2 py-1 rounded border">/sinhvien</code>
                <span class="text-slate-500 ml-2">→ Default student info</span>
            </p>
            <p class="text-slate-600">
                <code class="bg-white px-2 py-1 rounded border">/sinhvien/John-Doe/1234567</code>
                <span class="text-slate-500 ml-2">→ Custom name and ID</span>
            </p>
        </div>
    </div>

    {{-- Back to Home --}}
    <div class="mt-4">
        <a href="{{ route('home') }}" class="link">← Back to Home</a>
    </div>
</div>
@endsection
