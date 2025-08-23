<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title', 'Website Sederhana')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-50 min-h-screen">
        @auth
            @if (Auth::user()->isAdmin())
                <x-admin-header />
            @else
                <x-header />
            @endif
        @endauth

        <main>
            @yield('content')
        </main>
    </body>
</html>
