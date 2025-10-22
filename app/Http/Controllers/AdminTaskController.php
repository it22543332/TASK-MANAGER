<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTaskController extends Controller
{
    // Show all tasks
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tasks = Task::with('user')
                     ->when($search, fn($q) => $q->where('title', 'like', "%{$search}%"))
                     ->latest()
                     ->paginate(10);

        return view('admin.tasks.index', compact('tasks','search'));
    }

    // Edit task
    public function edit(Task $task)
    {
        return view('admin.tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->only('title','description','status','category_id'));
        return redirect()->route('admin.tasks')->with('success','Task updated successfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('admin.tasks')->with('success','Task deleted successfully');
    }

    // Admin dashboard stats
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalTasks = Task::count();
        $tasksDoing = Task::where('status','Doing')->count();
        $tasksFinished = Task::where('status','Finished')->count();

        return view('admin.dashboard', compact('totalUsers','totalTasks','tasksDoing','tasksFinished'));
    }
}

