<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- blade-formatter-disable --}}
    <style type="text/tailwindcss">
        .btn {
            @apply rounded-md px-2 py-1 text-slate-700 text-center font-medium shadow-sm ring-1 ring-slate-700/50
            hover:bg-slate-200 cursor-pointer
        }

        .link {
            @apply font-medium text-gray-700 underline text-base
        }

        label {
            @apply block capitalize text-slate-700 mb-1 text-sm font-medium
        }

        input,
        textarea {
            @apply rounded-md shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight
            focus:outline-none
        }

        .error {
            @apply text-red-500 text-sm
        }
    </style>
    {{-- blade-formatter-disable --}}
    <title>My Tasks</title>
    @yield('styles')
</head>
<body class="container mx-auto mt-10 mb-10 max-w-lg">
    <h1 class="mb-4 text-2xl">@yield('title')</h1>

    <div x-data="{ flash: true }">
        @if(session()->has('success'))
        <div x-show="flash"
             class="relative mb-4 border rounded border-green-400 bg-green-100 px-4 py-2 text-lg
             text-green-700">
            <strong class="font-bold">Success!</strong>
            <div>{{ session('success') }}</div>
            <span class="absolute right-0 top-0 px-4 py-4">
                <svg xmlns="http://www.w3.org/2000/svg"
                     viewBox="0 0 50 50"
                     class="h-4 w-4 cursor-pointer fill-green-700"
                @click="flash = false">
                    <path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"></path>
                </svg>
            </span>
        </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
