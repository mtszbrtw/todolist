<?php


//test commitu z androida

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


public function index(Request $request)
{
    $query = Auth::user()->tasks();

    if ($request->filled('priority')) {
        $query->where('priority', $request->priority);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('due')) {
        $query->whereDate('due_date', '>=', $request->due);
    }

    $tasks = $query->orderBy('due_date', 'ASC')->get();

    // Jeśli AJAX – zwróć tylko tabelę
    if ($request->ajax()) {
        return view('tasks.partials.table', compact('tasks'))->render();
    }

    // Inaczej – pełen widok
    return view('tasks.index', compact('tasks'));
}
    
    
    
    public function create()
    {
        return view('tasks.create');
    }
    
    
    public function store(Request $request)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'priority' => 'required|in:low,medium,high',
        'status' => 'required|in:to-do,in progress,done',
        'due_date' => 'required|date',
    ]);

    $task = Auth::user()->tasks()->create($data);

    if ($request->ajax()) {
        return response()->json([
            'message' => 'Zadanie utworzone!',
            'task' => $task
        ]);
    } else {
        return redirect()->route('tasks.index')->with('success', 'Zadanie utworzone!');
    }
}

    public function edit(Task $task)
    {
        $this->authorize('update', $task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
{
    $this->authorize('update', $task);

    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'priority' => 'required|in:low,medium,high',
        'status' => 'required|in:to-do,in-progress,done',
        'due_date' => 'required|date',
    ]);

    $task->update($data);

    return response()->json(['success' => true, 'id' => $task->id]);
}

    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();
        return back()->with('success', 'Task deleted.');
    }
}