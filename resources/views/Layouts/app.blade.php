<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title', 'Website Sederhana')</title>
        @vite('resources/css/app.css')
    </head>
    <body class="bg-gray-50 min-h-screen">
        <x-header />

        <main>
            @yield('content')
        </main>
    </body>
</html>
