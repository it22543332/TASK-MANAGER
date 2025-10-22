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
				<h2 class="text-xl font-semibold text-gray-900">Categories</h2>
				<p class="text-sm text-gray-600"><?php echo e($isAdmin ? 'Manage categories for tasks.' : 'Browse available categories.'); ?></p>
			</div>
			<?php if($isAdmin): ?>
				<a href="<?php echo e(route('categories.create')); ?>" class="inline-flex items-center rounded bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500">
					Add Category
				</a>
			<?php endif; ?>
		</div>
	 <?php $__env->endSlot(); ?>

	<div class="py-6">
		<div class="overflow-hidden rounded bg-white shadow">
			<table class="min-w-full divide-y divide-gray-200">
				<thead class="bg-gray-50">
					<tr>
						<th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Name</th>
						<th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Description</th>
						<th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Status</th>
						<?php if($isAdmin): ?>
							<th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500">Actions</th>
						<?php endif; ?>
					</tr>
				</thead>
				<tbody class="divide-y divide-gray-200 bg-white">
					<?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
						<tr>
							<td class="px-4 py-3 text-sm font-medium text-gray-900"><?php echo e($category->name); ?></td>
							<td class="px-4 py-3 text-sm text-gray-500"><?php echo e($category->description ?? '—'); ?></td>
							<td class="px-4 py-3">
								<span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wide <?php echo e($category->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-700'); ?>">
									<?php echo e(ucfirst($category->status)); ?>

								</span>
							</td>
							<?php if($isAdmin): ?>
								<td class="px-4 py-3 text-right text-sm font-medium">
									<div class="flex justify-end gap-3">
										<a href="<?php echo e(route('categories.edit', $category)); ?>" class="text-indigo-600 hover:text-indigo-500">Edit</a>
										<form action="<?php echo e(route('categories.toggle', $category)); ?>" method="POST">
											<?php echo csrf_field(); ?>
											<?php echo method_field('PATCH'); ?>
											<button class="text-gray-600 hover:text-gray-500" type="submit">
												<?php echo e($category->status === 'active' ? 'Deactivate' : 'Activate'); ?>

											</button>
										</form>
										<form action="<?php echo e(route('categories.destroy', $category)); ?>" method="POST" onsubmit="return confirm('Delete this category?')">
											<?php echo csrf_field(); ?>
											<?php echo method_field('DELETE'); ?>
											<button class="text-red-600 hover:text-red-500" type="submit">Delete</button>
										</form>
									</div>
								</td>
							<?php endif; ?>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
						<tr>
							<td colspan="<?php echo e($isAdmin ? 4 : 3); ?>" class="px-4 py-5 text-center text-sm text-gray-500">No categories found.</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>

			<?php if($isAdmin && method_exists($categories, 'links')): ?>
				<div class="border-t border-gray-200 p-4">
					<?php echo e($categories->links()); ?>

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
<?php /**PATH C:\Users\Umair_Salah\Documents\GitHub\TASK-MANAGER\resources\views/categories/index.blade.php ENDPATH**/ ?>