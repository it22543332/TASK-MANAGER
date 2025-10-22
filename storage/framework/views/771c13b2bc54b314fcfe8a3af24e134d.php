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
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900"><?php echo e($isAdmin ? 'All Tasks' : 'My Tasks'); ?></h2>
                <p class="text-sm text-gray-600">Manage <?php echo e($isAdmin ? 'team assignments and statuses' : 'your assigned tasks'); ?>.</p>
            </div>
            <a href="<?php echo e($isAdmin ? route('tasks.create') : route('tasks.create')); ?>" class="inline-flex items-center rounded bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500">
                Create Task
            </a>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-6">
        <div class="bg-white shadow rounded">
            <form method="GET" class="border-b border-gray-200 p-4">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-<?php echo e($isAdmin ? '4' : '2'); ?>">
                    <?php if($isAdmin): ?>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500">Category</label>
                            <select name="category" class="mt-1 w-full rounded border-gray-300 text-sm">
                                <option value="">All</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php if(($filters['category'] ?? null) == $category->id): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500">Assigned To</label>
                            <select name="assigned_to" class="mt-1 w-full rounded border-gray-300 text-sm">
                                <option value="">Anyone</option>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>" <?php if(($filters['assigned_to'] ?? null) == $user->id): echo 'selected'; endif; ?>><?php echo e($user->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php endif; ?>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wide text-gray-500">Status</label>
                        <select name="status" class="mt-1 w-full rounded border-gray-300 text-sm">
                            <option value="">All</option>
                            <option value="pending" <?php if(($filters['status'] ?? null) === 'pending'): echo 'selected'; endif; ?>>Pending</option>
                            <option value="in_progress" <?php if(($filters['status'] ?? null) === 'in_progress'): echo 'selected'; endif; ?>>In Progress</option>
                            <option value="done" <?php if(($filters['status'] ?? null) === 'done'): echo 'selected'; endif; ?>>Completed</option>
                        </select>
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit" class="inline-flex items-center rounded bg-gray-900 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-white hover:bg-gray-700">Filter</button>
                        <a href="<?php echo e(route('tasks.index')); ?>" class="inline-flex items-center rounded border border-gray-200 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-gray-600 hover:bg-gray-50">Reset</a>
                    </div>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Title</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Category</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Status</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Deadline</th>
                            <?php if($isAdmin): ?>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Assigned To</th>
                            <?php endif; ?>
                            <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        <?php $__empty_1 = true; $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900"><?php echo e($task->title); ?></td>
                                <td class="px-4 py-3 text-sm text-gray-500"><?php echo e($task->category->name); ?></td>
                                <td class="px-4 py-3">
                                    <span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wide
                                        class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                                            'bg-yellow-100 text-yellow-800' => $task->status === 'pending',
                                            'bg-blue-100 text-blue-800' => $task->status === 'in_progress',
                                            'bg-green-100 text-green-800' => $task->status === 'done',
                                        ]); ?>"
                                    ">
                                        <?php echo e(str_replace('_', ' ', ucfirst($task->status))); ?>

                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-500"><?php echo e($task->deadline->format('M d, Y')); ?></td>
                                <?php if($isAdmin): ?>
                                    <td class="px-4 py-3 text-sm text-gray-500"><?php echo e($task->user->name); ?></td>
                                <?php endif; ?>
                                <td class="px-4 py-3 text-right text-sm font-medium">
                                    <div class="flex justify-end gap-3">
                                        <a href="<?php echo e(route('tasks.edit', $task)); ?>" class="text-indigo-600 hover:text-indigo-500">Edit</a>
                                        <form action="<?php echo e(route('tasks.destroy', $task)); ?>" method="POST" onsubmit="return confirm('Delete this task?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button class="text-red-600 hover:text-red-500" type="submit">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="<?php echo e($isAdmin ? 6 : 5); ?>" class="px-4 py-5 text-center text-sm text-gray-500">No tasks found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if(method_exists($tasks, 'links')): ?>
                <div class="border-t border-gray-200 p-4">
                    <?php echo e($tasks->links()); ?>

                </div>
            <?php endif; ?>
        </div>
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


<?php /**PATH C:\Users\Umair_Salah\Documents\GitHub\TASK-MANAGER\resources\views/tasks/index.blade.php ENDPATH**/ ?>