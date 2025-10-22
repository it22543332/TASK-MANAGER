<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function dashboard()
    {
        $user = $this->currentUser();

        if ($user->isAdmin()) {
            $stats = [
                'total_tasks' => Task::count(),
                'pending_tasks' => Task::where('status', 'pending')->count(),
                'completed_tasks' => Task::where('status', 'done')->count(),
                'categories' => Category::count(),
                'users' => User::count(),
            ];
        } else {
            $stats = [
                'total_tasks' => $user->tasks()->count(),
                'pending_tasks' => $user->tasks()->where('status', 'pending')->count(),
                'completed_tasks' => $user->tasks()->where('status', 'done')->count(),
                'categories' => Category::where('status', 'active')->count(),
            ];
        }

        return view('dashboard', [
            'stats' => $stats,
            'user' => $user,
        ]);
    }

    public function index(Request $request)
    {
        $user = $this->currentUser();
        $query = Task::with(['category', 'user'])->orderBy('deadline');

        if ($user->isAdmin()) {
            if ($request->filled('category')) {
                $query->where('category_id', $request->input('category'));
            }

            if ($request->filled('status')) {
                $query->where('status', $request->input('status'));
            }

            if ($request->filled('assigned_to')) {
                $query->where('user_id', $request->input('assigned_to'));
            }

            $tasks = $query->paginate(10)->withQueryString();

            return view('tasks.index', [
                'tasks' => $tasks,
                'categories' => Category::orderBy('name')->get(),
                'users' => User::orderBy('name')->get(),
                'filters' => $request->only(['category', 'status', 'assigned_to']),
                'isAdmin' => true,
            ]);
        }

        $tasks = $query->where('user_id', $user->id)
            ->paginate(10)
            ->withQueryString();

        return view('tasks.index', [
            'tasks' => $tasks,
            'categories' => Category::where('status', 'active')->orderBy('name')->get(),
            'users' => collect([$user]),
            'filters' => $request->only(['status']),
            'isAdmin' => false,
        ]);
    }

    public function create()
    {
    $user = $this->currentUser();

        $categoriesQuery = Category::orderBy('name');
        if (! $user->isAdmin()) {
            $categoriesQuery->where('status', 'active');
        }

        return view('tasks.create', [
            'task' => new Task(),
            'categories' => $categoriesQuery->get(),
            'users' => $user->isAdmin() ? User::orderBy('name')->get() : collect([$user]),
            'isAdmin' => $user->isAdmin(),
        ]);
    }

    public function store(Request $request)
    {
    $user = $this->currentUser();

        $categoryRule = Rule::exists('categories', 'id');
        if (! $user->isAdmin()) {
            $categoryRule = $categoryRule->where('status', 'active');
        }

        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'deadline' => ['required', 'date', 'after:today'],
            'category_id' => ['required', $categoryRule],
            'status' => ['required', Rule::in(['pending', 'in_progress', 'done'])],
        ];

        if ($user->isAdmin()) {
            $rules['user_id'] = ['required', 'exists:users,id'];
        }

        $validated = $request->validate($rules);

        $assignedUserId = $user->isAdmin() ? $validated['user_id'] : $user->id;

        Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'],
            'user_id' => $assignedUserId,
            'assignment_date' => now(),
            'deadline' => $validated['deadline'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    public function edit(Task $task)
    {
    $user = $this->currentUser();
        $this->authorizeTask($task, $user);

        $categoriesQuery = Category::orderBy('name');
        if (! $user->isAdmin()) {
            $categoriesQuery->where('status', 'active');
        }

        return view('tasks.edit', [
            'task' => $task,
            'categories' => $categoriesQuery->get(),
            'users' => $user->isAdmin() ? User::orderBy('name')->get() : collect([$user]),
            'isAdmin' => $user->isAdmin(),
        ]);
    }

    public function update(Request $request, Task $task)
    {
        $user = Auth::user();
        $this->authorizeTask($task, $user);

        $categoryRule = Rule::exists('categories', 'id');
        if (! $user->isAdmin()) {
            $categoryRule = $categoryRule->where('status', 'active');
        }

        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'deadline' => ['required', 'date', 'after_or_equal:today'],
            'category_id' => ['required', $categoryRule],
            'status' => ['required', Rule::in(['pending', 'in_progress', 'done'])],
        ];

        if ($user->isAdmin()) {
            $rules['user_id'] = ['required', 'exists:users,id'];
        }

        $validated = $request->validate($rules);

        $assignedUserId = $user->isAdmin() ? $validated['user_id'] : $user->id;

        $task->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category_id' => $validated['category_id'],
            'user_id' => $assignedUserId,
            'deadline' => $validated['deadline'],
            'status' => $validated['status'],
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    public function destroy(Task $task)
    {
        $user = Auth::user();
        $this->authorizeTask($task, $user);

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }

    private function currentUser(): User
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            abort(401);
        }

        return $user;
    }

    private function authorizeTask(Task $task, User $user): void
    {
        if ($user->isAdmin()) {
            return;
        }

        if ($task->user_id !== $user->id) {
            abort(403, 'This action is unauthorized.');
        }
    }
}
