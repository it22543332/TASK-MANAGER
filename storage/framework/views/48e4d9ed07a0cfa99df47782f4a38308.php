<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(config('app.name', 'TaskManager')); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-white shadow">
            <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">
                <div class="font-bold text-xl text-blue-600"><?php echo e(config('app.name', 'TaskManager')); ?></div>
                <div class="flex items-center gap-4 text-sm font-medium">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('dashboard')); ?>" class="text-gray-700 hover:text-indigo-600">Dashboard</a>
                        <a href="<?php echo e(route('tasks.index')); ?>" class="text-gray-700 hover:text-indigo-600">Tasks</a>
                        <a href="<?php echo e(route('categories.index')); ?>" class="text-gray-700 hover:text-indigo-600">Categories</a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="text-red-500 hover:text-red-400">Logout</button>
                        </form>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="text-gray-700 hover:text-indigo-600">Login</a>
                        <a href="<?php echo e(route('register')); ?>" class="text-gray-700 hover:text-indigo-600">Register</a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <?php if(isset($header)): ?>
            <header class="bg-white shadow">
                <div class="mx-auto max-w-7xl px-6 py-6">
                    <?php echo e($header); ?>

                </div>
            </header>
        <?php endif; ?>

        <main class="mx-auto max-w-7xl px-6 py-6">
            <?php echo e($slot ?? ''); ?>

        </main>
    </div>
</body>
</html>

<?php /**PATH C:\Users\Umair_Salah\Documents\GitHub\TASK-MANAGER\resources\views/layouts/app.blade.php ENDPATH**/ ?>