<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PhoneStore') | PhoneStore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        [x-cloak] { display: none !important; }
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    @stack('head')
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">

    {{-- ===== NAVBAR ===== --}}
    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                {{-- Left: Logo + Nav Links --}}
                <div class="flex items-center gap-8">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 text-blue-600 font-bold text-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                        PhoneStore
                    </a>
                    <div class="hidden md:flex items-center gap-6">
                        <a href="{{ route('home') }}"
                           class="text-sm font-medium {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} transition-colors">
                            Home
                        </a>
                        <a href="{{ route('products.index') }}"
                           class="text-sm font-medium {{ request()->routeIs('products.*') ? 'text-blue-600' : 'text-gray-600 hover:text-blue-600' }} transition-colors">
                            Products
                        </a>
                    </div>
                </div>

                {{-- Right: Search + Profile --}}
                <div class="flex items-center gap-4">
                    {{-- Search bar --}}
                    <form method="GET" action="{{ route('products.index') }}" class="hidden sm:flex items-center">
                        <div class="relative">
                            <input type="text" name="search"
                                   value="{{ request('search') }}"
                                   placeholder="Search phones..."
                                   class="w-48 lg:w-56 pl-9 pr-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 bg-gray-50">
                            <svg class="absolute left-2.5 top-2.5 h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </form>

                    {{-- Profile dropdown --}}
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open"
                                    class="flex items-center gap-2 text-sm font-medium text-gray-700 hover:text-blue-600 transition-colors focus:outline-none">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-700 font-bold text-xs uppercase">
                                    {{ substr(auth()->user()->username, 0, 1) }}
                                </div>
                                <span class="hidden md:block">{{ e(auth()->user()->username) }}</span>
                                <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div x-show="open" @click.away="open = false" x-cloak
                                 class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-1 z-50">
                                <div class="px-4 py-2 text-xs text-gray-500 border-b">
                                    Signed in as <span class="font-semibold text-gray-700">{{ e(auth()->user()->username) }}</span>
                                </div>
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('admin.products.index') }}"
                                       class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                        <svg class="h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        Admin Panel
                                    </a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                            class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 text-left">
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                        </svg>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center gap-2">
                            <a href="{{ route('login') }}"
                               class="text-sm font-medium text-gray-600 hover:text-blue-600 transition-colors">
                                Login
                            </a>
                            <a href="{{ route('register') }}"
                               class="text-sm px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                                Register
                            </a>
                        </div>
                    @endauth

                    {{-- Mobile menu button --}}
                    <div x-data="{ open: false }" class="md:hidden">
                        <button @click="open = !open" class="p-2 text-gray-500 hover:text-blue-600">
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak
                             class="absolute left-0 right-0 top-16 bg-white border-t border-gray-100 shadow-lg px-4 py-3 space-y-2">
                            <a href="{{ route('home') }}" class="block py-2 text-sm text-gray-700 hover:text-blue-600">Home</a>
                            <a href="{{ route('products.index') }}" class="block py-2 text-sm text-gray-700 hover:text-blue-600">Products</a>
                            <form method="GET" action="{{ route('products.index') }}" class="py-2">
                                <div class="flex gap-2">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                           placeholder="Search phones..."
                                           class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                                    <button class="px-3 py-2 bg-blue-600 text-white text-sm rounded-lg">Go</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- Flash messages --}}
    @if(session('success'))
        <div id="flash-success" class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-3 text-sm flex items-center gap-2">
            <svg class="h-4 w-4 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-3 text-sm">{{ session('error') }}</div>
    @endif
    @if(session('warning'))
        <div class="bg-yellow-50 border-l-4 border-yellow-500 text-yellow-800 px-6 py-3 text-sm">{{ session('warning') }}</div>
    @endif

    {{-- Main content --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t border-gray-200 mt-auto">
        <div class="max-w-7xl mx-auto px-4 py-6 flex flex-col sm:flex-row items-center justify-between gap-2 text-sm text-gray-500">
            <p>&copy; {{ date('Y') }} PhoneStore. All rights reserved.</p>
            <div class="flex gap-4">
                <a href="{{ route('products.index') }}" class="hover:text-blue-600">Products</a>
                <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>
            </div>
        </div>
    </footer>

    {{-- Alpine.js --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        setTimeout(() => {
            const el = document.getElementById('flash-success');
            if (el) el.style.display = 'none';
        }, 4000);
    </script>
    @stack('scripts')
</body>
</html>
