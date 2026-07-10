<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
                <!-- Fuentes corporativas -->
                <style>
                    @font-face {
                        font-family: 'GlyphaLTStd-Bold';
                        src: url('/fonts/GlyphaLTStd-Bold.otf') format('opentype');
                        font-weight: bold;
                        font-style: normal;
                    }
                    @font-face {
                        font-family: 'Montserrat';
                        src: url('/fonts/Montserrat-Regular.otf') format('opentype');
                        font-weight: normal;
                        font-style: normal;
                    }
                    @font-face {
                        font-family: 'Montserrat';
                        src: url('/fonts/Montserrat-Bold.otf') format('opentype');
                        font-weight: bold;
                        font-style: normal;
                    }
                    body, html {
                        font-family: 'Montserrat', Arial, sans-serif;
                    }
                    h1, h2, h3, .hero-title, .page-title {
                        font-family: 'GlyphaLTStd-Bold', Arial, sans-serif !important;
                        color: rgb(55,95,122) !important;
                    }
                </style>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex, nofollow">
        <link rel="icon" type="image/png" href="{{ asset('images/isologo-ife-educabol-ofical-instituto-de-formacion-educabol.png') }}">

        <title>@yield('title', config('app.name', 'verifika'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
    </body>
</html>
