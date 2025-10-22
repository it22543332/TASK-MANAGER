<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TaskManager') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white shadow">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
                <div class="font-bold text-xl text-blue-600">{{ config('app.name', 'TaskManager') }}</div>
                <div class="flex items-center gap-4 text-sm font-medium">
                    @auth
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600">Dashboard</a>
                        <a href="{{ route('tasks.index') }}" class="text-gray-700 hover:text-indigo-600">Tasks</a>
                        <a href="{{ route('categories.index') }}" class="text-gray-700 hover:text-indigo-600">Categories</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-400">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600">Login</a>
                        <a href="{{ route('register') }}" class="text-gray-700 hover:text-indigo-600">Register</a>
                    @endauth
                </div>
            </div>
        </nav>

        @isset($header)
            <header class="bg-white shadow">
                <div class="mx-auto max-w-7xl px-6 py-6">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="mx-auto max-w-7xl px-6 py-6">
            {{ $slot ?? '' }}
        </main>
    </div>
</body>
</html>

