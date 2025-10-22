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
        <h2 class="text-xl font-semibold text-gray-900">Create Task</h2>
     <?php $__env->endSlot(); ?>

    <div class="mx-auto max-w-3xl py-6">
        <div class="rounded bg-white shadow">
            <form action="<?php echo e(route('tasks.store')); ?>" method="POST" class="space-y-6 p-6">
                <?php echo csrf_field(); ?>

                <div>
                    <label for="title" class="block text-sm font-semibold text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="<?php echo e(old('title', $task->title)); ?>" class="mt-1 w-full rounded border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="4" class="mt-1 w-full rounded border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500"><?php echo e(old('description', $task->description)); ?></textarea>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="category_id" class="block text-sm font-semibold text-gray-700">Category</label>
                        <select name="category_id" id="category_id" class="mt-1 w-full rounded border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
                            <option value="">Select category</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->id); ?>" <?php if(old('category_id', $task->category_id) == $category->id): echo 'selected'; endif; ?>><?php echo e($category->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-semibold text-gray-700">Status</label>
                        <select name="status" id="status" class="mt-1 w-full rounded border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
                            <option value="pending" <?php if(old('status', $task->status) === 'pending'): echo 'selected'; endif; ?>>Pending</option>
                            <option value="in_progress" <?php if(old('status', $task->status) === 'in_progress'): echo 'selected'; endif; ?>>In Progress</option>
                            <option value="done" <?php if(old('status', $task->status) === 'done'): echo 'selected'; endif; ?>>Completed</option>
                        </select>
                    </div>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <div>
                        <label for="deadline" class="block text-sm font-semibold text-gray-700">Deadline</label>
                        <input type="date" name="deadline" id="deadline" value="<?php echo e(old('deadline', optional($task->deadline)->format('Y-m-d'))); ?>" class="mt-1 w-full rounded border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
                    </div>

                    <?php if($isAdmin): ?>
                        <div>
                            <label for="user_id" class="block text-sm font-semibold text-gray-700">Assign To</label>
                            <select name="user_id" id="user_id" class="mt-1 w-full rounded border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
                                <option value="">Select user</option>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user->id); ?>" <?php if(old('user_id', $task->user_id) == $user->id): echo 'selected'; endif; ?>><?php echo e($user->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="flex items-center justify-end gap-2">
                    <a href="<?php echo e(route('tasks.index')); ?>" class="inline-flex items-center rounded border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
                    <button type="submit" class="inline-flex items-center rounded bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500">Save Task</button>
                </div>
            </form>
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


<?php /**PATH C:\Users\Umair_Salah\Documents\GitHub\TASK-MANAGER\resources\views/tasks/create.blade.php ENDPATH**/ ?>