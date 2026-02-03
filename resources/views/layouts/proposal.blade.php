<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|space-grotesk:600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="bg-gray-950 text-gray-100 antialiased">
        {{-- Minimal Header --}}
        <header class="fixed top-0 w-full bg-gray-950/80 backdrop-blur-lg z-40 border-b border-gray-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-center py-4">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <x-logo />
                        <picture>
                            <source
                                srcset="{{ asset('images/after-logo.webp') }}"
                                type="image/webp"
                            >
                            <img
                                src="{{ asset('images/after-logo.png') }}"
                                alt="Noctua Core.AI"
                                class="object-contain h-6"
                                width="102"
                                height="24"
                                loading="eager"
                            >
                        </picture>
                    </a>
                </div>
            </div>
        </header>

        <main class="pt-10">
            @yield('content')
        </main>
    </body>
</html>
