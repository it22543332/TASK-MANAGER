<x-app-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
        <div class="bg-white shadow rounded p-6">
            <h3 class="font-bold text-lg">Total Tasks</h3>
            <p class="text-2xl mt-2">{{ \App\Models\Task::count() }}</p>
        </div>
        <div class="bg-white shadow rounded p-6">
            <h3 class="font-bold text-lg">Total Categories</h3>
            <p class="text-2xl mt-2">{{ \App\Models\Category::count() }}</p>
        </div>
        <div class="bg-white shadow rounded p-6">
            <h3 class="font-bold text-lg">Your Pending Tasks</h3>
            <p class="text-2xl mt-2">{{ \App\Models\Task::where('status','pending')->count() }}</p>
        </div>
    </div>
</x-app-layout>


