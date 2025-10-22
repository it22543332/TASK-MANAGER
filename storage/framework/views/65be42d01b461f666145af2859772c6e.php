<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">Dashboard</h2>
                <p class="text-sm text-gray-600">Welcome back, <?php echo e($user->name); ?>.</p>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <a href="<?php echo e(route('tasks.index')); ?>" class="inline-flex items-center rounded border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-100">
                    View Tasks
                </a>
                <a href="<?php echo e(route('tasks.create')); ?>" class="inline-flex items-center rounded bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500">
                    Create Task
                </a>

                <?php if($user->isAdmin()): ?>
                    <a href="<?php echo e(route('categories.create')); ?>" class="inline-flex items-center rounded border border-indigo-600 px-4 py-2 text-sm font-semibold text-indigo-600 hover:bg-indigo-50">
                        Create Category
                    </a>
                <?php endif; ?>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-<?php echo e($user->isAdmin() ? '5' : '3'); ?>">
        <div class="bg-white shadow rounded p-6">
            <h3 class="font-semibold text-sm text-gray-500 uppercase">Total Tasks</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($stats['total_tasks']); ?></p>
        </div>
        <div class="bg-white shadow rounded p-6">
            <h3 class="font-semibold text-sm text-gray-500 uppercase">Pending</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($stats['pending_tasks']); ?></p>
        </div>
        <div class="bg-white shadow rounded p-6">
            <h3 class="font-semibold text-sm text-gray-500 uppercase">Completed</h3>
            <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($stats['completed_tasks']); ?></p>
        </div>

        <?php if($user->isAdmin()): ?>
            <div class="bg-white shadow rounded p-6">
                <h3 class="font-semibold text-sm text-gray-500 uppercase">Categories</h3>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($stats['categories']); ?></p>
            </div>
            <div class="bg-white shadow rounded p-6">
                <h3 class="font-semibold text-sm text-gray-500 uppercase">Users</h3>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($stats['users']); ?></p>
            </div>
        <?php else: ?>
            <div class="bg-white shadow rounded p-6">
                <h3 class="font-semibold text-sm text-gray-500 uppercase">Active Categories</h3>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($stats['categories']); ?></p>
            </div>
        <?php endif; ?>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>


<?php /**PATH C:\Users\Umair_Salah\Documents\GitHub\TASK-MANAGER\resources\views/dashboard.blade.php ENDPATH**/ ?>