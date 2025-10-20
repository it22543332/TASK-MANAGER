<?php


namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::where('user_id', Auth::id())->with('category')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create() {
        $categories = Category::all();
        return view('tasks.create', compact('categories'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'deadline' => 'required|date|after:today',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:pending,in_progress,done'
        ]);

        Task::create([
            'title' => $request->title,
            'deadline' => $request->deadline,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('tasks.index')->with('success','Task created successfully');
    }

    public function edit(Task $task) {
        $categories = Category::all();
        return view('tasks.edit', compact('task','categories'));
    }

    public function update(Request $request, Task $task) {
        $request->validate([
            'title' => 'required|string|max:255',
            'deadline' => 'required|date|after:today',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:pending,in_progress,done'
        ]);

        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success','Task updated successfully');
    }

    public function destroy(Task $task) {
        $task->delete();
        return redirect()->route('tasks.index')->with('success','Task deleted successfully');
    }
}
