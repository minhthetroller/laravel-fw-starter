@extends('layouts.app')

@section('title', "Chess Board ({$n}x{$n})")

@section('styles')
<style>
    .chess-board {
        display: grid;
        border: 4px solid #374151;
        border-radius: 4px;
        overflow: hidden;
        max-width: 100%;
        aspect-ratio: 1;
    }

    .chess-cell {
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.6rem;
        color: rgba(0, 0, 0, 0.2);
        transition: all 0.2s ease;
    }

    .chess-cell:hover {
        opacity: 0.8;
        transform: scale(1.05);
    }

    .chess-cell.light {
        background-color: #f3e5d3;
    }

    .chess-cell.dark {
        background-color: #b58863;
    }

    /* Responsive font sizes */
    @media (min-width: 640px) {
        .chess-cell {
            font-size: 0.75rem;
        }
    }
</style>
@endsection

@section('content')
<div class="space-y-6">
    {{-- Board Info --}}
    <div class="bg-white rounded-lg shadow-md p-4">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-slate-600">Board Size: <strong>{{ $n }} × {{ $n }}</strong></p>
                <p class="text-slate-500 text-sm">Total Squares: {{ $n * $n }}</p>
            </div>
            <div class="flex space-x-2">
                @foreach([4, 8, 10, 12] as $size)
                    <a href="{{ route('banco', $size) }}"
                       class="btn text-sm {{ $n == $size ? 'bg-amber-500 text-white' : '' }}">
                        {{ $size }}×{{ $size }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Chess Board --}}
    <div class="bg-white rounded-lg shadow-md p-4">
        <div class="chess-board mx-auto" style="grid-template-columns: repeat({{ $n }}, 1fr); max-width: {{ min($n * 50, 500) }}px;">
            @for($row = 0; $row < $n; $row++)
                @for($col = 0; $col < $n; $col++)
                    @php
                        $isLight = ($row + $col) % 2 == 0;
                        $cellLabel = chr(65 + $col) . ($n - $row);
                    @endphp
                    <div class="chess-cell {{ $isLight ? 'light' : 'dark' }}"
                         title="{{ $cellLabel }}">
                        @if($n <= 10)
                            {{ $cellLabel }}
                        @endif
                    </div>
                @endfor
            @endfor
        </div>
    </div>

    {{-- Legend --}}
    <div class="bg-slate-50 rounded-lg p-4">
        <h3 class="font-semibold text-slate-700 mb-3">How to Use:</h3>
        <div class="space-y-2 text-sm">
            <p class="text-slate-600">
                <code class="bg-white px-2 py-1 rounded border">/banco/8</code>
                <span class="text-slate-500 ml-2">→ Standard 8×8 chess board</span>
            </p>
            <p class="text-slate-600">
                <code class="bg-white px-2 py-1 rounded border">/banco/12</code>
                <span class="text-slate-500 ml-2">→ Extended 12×12 board</span>
            </p>
            <p class="text-xs text-slate-400 mt-2">
                * Board size is limited between 1 and 20 for optimal display
            </p>
        </div>
    </div>

    {{-- Back to Home --}}
    <div class="mt-4">
        <a href="{{ route('home') }}" class="link">← Back to Home</a>
    </div>
</div>
@endsection
