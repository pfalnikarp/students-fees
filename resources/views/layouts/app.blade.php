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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .block1 {
                display: block;
                width: 50%;
                border: none;
                background-color: #04AA6D;
                color: white;
                padding: 14px 28px;
                font-size: 16px;
                cursor: pointer;
                text-align: center;
                position: center;
            }

            .block1:hover {
                background-color: #ddd;
                color: black;
            }

            .block2 {
                display: block;
                width: 50%;
                border: none;
                background-color: #FF0000;
                color: white;
                padding: 14px 28px;
                font-size: 16px;
                cursor: pointer;
                text-align: center;
                position: center;
            }

            .block1:hover {
                background-color: #ddd;
                color: black;
            }
        </style>
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
                @if(auth()->user()->type == 'admin')
                    <h1> <a href='{{ url('/students') }}'><button class="bg-center block1">STUDENTS MANAGEMENT SYSTEM</button></a></h1>
                    <h1> <a href='{{ url('/payments') }}'><button class="bg-center block2">PAYMENT MANAGEMENT SYSTEM</button></a></h1>
                @endif
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
