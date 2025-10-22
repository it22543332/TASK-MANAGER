<x-app-layout>
	<x-slot name="header">
		<h2 class="text-xl font-semibold text-gray-900">Edit Category</h2>
	</x-slot>

	<div class="mx-auto max-w-2xl py-6">
		<div class="rounded bg-white shadow">
			<form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-6 p-6">
				@csrf
				@method('PUT')

				<div>
					<label for="name" class="block text-sm font-semibold text-gray-700">Name</label>
					<input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="mt-1 w-full rounded border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
				</div>

				<div>
					<label for="description" class="block text-sm font-semibold text-gray-700">Description</label>
					<textarea name="description" id="description" rows="3" class="mt-1 w-full rounded border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">{{ old('description', $category->description) }}</textarea>
				</div>

				<div>
					<label for="status" class="block text-sm font-semibold text-gray-700">Status</label>
					<select name="status" id="status" class="mt-1 w-full rounded border border-gray-300 px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500" required>
						<option value="active" @selected(old('status', $category->status) === 'active')>Active</option>
						<option value="inactive" @selected(old('status', $category->status) === 'inactive')>Inactive</option>
					</select>
				</div>

				<div class="flex items-center justify-end gap-2">
					<a href="{{ route('categories.index') }}" class="inline-flex items-center rounded border border-gray-200 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Cancel</a>
					<button type="submit" class="inline-flex items-center rounded bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500">Update Category</button>
				</div>
			</form>
		</div>
	</div>
</x-app-layout>
