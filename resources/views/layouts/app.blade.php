<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel Blog') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <nav class="bg-white shadow-md p-4">
        <div class="container mx-auto flex justify-between">
            <a href="{{ route('dashboard') }}" class="text-lg font-semibold">Dashboard</a>
            @auth
                <a href="{{ route('posts.index') }}" class="text-lg font-semibold">Blog</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="ml-4 text-red-500">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-lg font-semibold">Login</a>
                <a href="{{ route('register') }}" class="text-lg font-semibold ml-4">Register</a>
            @endauth
        </div>
    </nav>

    <div class="container mx-auto mt-10">
        @yield('content')
    </div>

</body>
</html>
