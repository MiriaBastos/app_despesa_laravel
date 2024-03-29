<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- <link rel="stylesheet" href="{{ asset('/build/assets/app-0IKQ0ucb.css') }}">
        <link rel="stylesheet" href="{{ asset('/build/assets/adminlte-DZwx4QTG.css') }}">
        <script src="{{ asset('/build/assets/adminlte.min-DCYgbvMu.js') }}"></script>
        <script src="{{ asset('/build/assets/app-BgvOogpt.js') }}"></script> --}}


        @vite([
            'resources/css/app.css',
            'public/dist/css/adminlte.min.css',
            'resources/js/app.js',
            'public/dist/js/adminlte.min.js',
        ])

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

            @stack('javascript')
        </div>
    </body>
</html>
