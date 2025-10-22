<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo e(config('app.name', 'TaskManager')); ?></title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex flex-col items-center justify-center h-screen text-center">
        <h1 class="text-5xl font-bold text-blue-600 mb-6">Welcome to TaskManager</h1>
        <p class="text-gray-700 mb-8">Manage your tasks efficiently and effortlessly.</p>
        <div>
            <a href="<?php echo e(route('login')); ?>" class="px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 mr-3">Login</a>
            <a href="<?php echo e(route('register')); ?>" class="px-6 py-3 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Register</a>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\Umair_Salah\Documents\GitHub\TASK-MANAGER\resources\views/welcome.blade.php ENDPATH**/ ?>