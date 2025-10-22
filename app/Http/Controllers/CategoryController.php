<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
    /** @var User $user */
    $user = Auth::user();
        $query = Category::orderBy('name');

        if ($user->isAdmin()) {
            $categories = $query->paginate(10);

            return view('categories.index', [
                'categories' => $categories,
                'isAdmin' => true,
            ]);
        }

        $categories = $query->where('status', 'active')->get();

        return view('categories.index', [
            'categories' => $categories,
            'isAdmin' => false,
        ]);
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    public function edit(Category $category): View
    {
        return view('categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $category->id],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }

    public function toggleStatus(Category $category): RedirectResponse
    {
        $category->update([
            'status' => $category->status === 'active' ? 'inactive' : 'active',
        ]);

        return redirect()->route('categories.index')->with('success', 'Category status updated');
    }
}
