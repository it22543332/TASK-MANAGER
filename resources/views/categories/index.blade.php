<x-app-layout>
	<x-slot name="header">
		<div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
			<div>
				<h2 class="text-xl font-semibold text-gray-900">Categories</h2>
				<p class="text-sm text-gray-600">{{ $isAdmin ? 'Manage categories for tasks.' : 'Browse available categories.' }}</p>
			</div>
			@if($isAdmin)
				<a href="{{ route('categories.create') }}" class="inline-flex items-center rounded bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-500">
					Add Category
				</a>
			@endif
		</div>
	</x-slot>

	<div class="py-6">
		<div class="overflow-hidden rounded bg-white shadow">
			<table class="min-w-full divide-y divide-gray-200">
				<thead class="bg-gray-50">
					<tr>
						<th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Name</th>
						<th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Description</th>
						<th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Status</th>
						@if($isAdmin)
							<th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500">Actions</th>
						@endif
					</tr>
				</thead>
				<tbody class="divide-y divide-gray-200 bg-white">
					@forelse($categories as $category)
						<tr>
							<td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $category->name }}</td>
							<td class="px-4 py-3 text-sm text-gray-500">{{ $category->description ?? '—' }}</td>
							<td class="px-4 py-3">
								<span class="inline-flex rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-wide {{ $category->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-200 text-gray-700' }}">
									{{ ucfirst($category->status) }}
								</span>
							</td>
							@if($isAdmin)
								<td class="px-4 py-3 text-right text-sm font-medium">
									<div class="flex justify-end gap-3">
										<a href="{{ route('categories.edit', $category) }}" class="text-indigo-600 hover:text-indigo-500">Edit</a>
										<form action="{{ route('categories.toggle', $category) }}" method="POST">
											@csrf
											@method('PATCH')
											<button class="text-gray-600 hover:text-gray-500" type="submit">
												{{ $category->status === 'active' ? 'Deactivate' : 'Activate' }}
											</button>
										</form>
										<form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category?')">
											@csrf
											@method('DELETE')
											<button class="text-red-600 hover:text-red-500" type="submit">Delete</button>
										</form>
									</div>
								</td>
							@endif
						</tr>
					@empty
						<tr>
							<td colspan="{{ $isAdmin ? 4 : 3 }}" class="px-4 py-5 text-center text-sm text-gray-500">No categories found.</td>
						</tr>
					@endforelse
				</tbody>
			</table>

			@if($isAdmin && method_exists($categories, 'links'))
				<div class="border-t border-gray-200 p-4">
					{{ $categories->links() }}
				</div>
			@endif
		</div>
	</div>
</x-app-layout>
