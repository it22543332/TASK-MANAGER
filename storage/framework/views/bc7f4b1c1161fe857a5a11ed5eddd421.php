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
		<h2 class="text-xl font-semibold text-gray-900">Create Category</h2>
	 <?php $__env->endSlot(); ?>

	<div class="mx-auto max-w-2xl py-6">
		<div class="rounded bg-white shadow">
			<form action="<?php echo e(route('categories.store')); ?>" method="POST" class="space-y-6 p-6">
				<?php echo csrf_field(); ?>

				<div>
					<label for="name" class="block text-sm font-semibold text-gray-700">Name</label>
					<input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>" class="mt-1 w-full rounded border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
				</div>

				<div>
					<label for="description" class="block text-sm font-semibold text-gray-700">Description</label>
					<textarea name="description" id="description" rows="3" class="mt-1 w-full rounded border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500"><?php echo e(old('description')); ?></textarea>
				</div>

				<div>
					<label for="status" class="block text-sm font-semibold text-gray-700">Status</label>
					<select name="status" id="status" class="mt-1 w-full rounded border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
						<option value="active" <?php if(old('status') === 'active'): echo 'selected'; endif; ?>>Active</option>
						<option value="inactive" <?php if(old('status') === 'inactive'): echo 'selected'; endif; ?>>Inactive</option>
					</select>
				</div>

				<div class="flex items-center justify-end gap-2">
					<a href="<?php echo e(route('categories.index')); ?>" class="inline-flex items-center rounded border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
					<button type="submit" class="inline-flex items-center rounded bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500">Save Category</button>
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
<?php /**PATH C:\Users\Umair_Salah\Documents\GitHub\TASK-MANAGER\resources\views/categories/create.blade.php ENDPATH**/ ?>