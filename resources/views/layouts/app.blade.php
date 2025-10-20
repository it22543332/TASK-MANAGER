<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TaskManager') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-white shadow p-4 flex justify-between">
        <div class="font-bold text-xl text-blue-600">{{ config('app.name', 'TaskManager') }}</div>
        <div>
            @auth
                <a href="{{ route('dashboard') }}" class="mr-4 text-gray-700">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-500">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="mr-4 text-gray-700">Login</a>
                <a href="{{ route('register') }}" class="text-gray-700">Register</a>
            @endauth
        </div>
    </nav>

    <main class="p-6">
        {{ $slot ?? '' }}
    </main>
</body>
</html>

