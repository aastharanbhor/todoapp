<?php

namespace App\Http\Controllers;

use App\Models\Task; // Ensure this line is present
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Display all tasks
    public function index()
    {
        $user = auth()->user();
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please log in to view your tasks.');
        }
    
        // Retrieve non-soft-deleted tasks for the authenticated user
        $tasks = $user->tasks()->whereNull('deleted_at')->get();
    
        return view('tasks.index', compact('tasks'));
    }
    

    // Show form to create a new task
    public function create()
    {
        return view('tasks.create');
    }

    // Store a new task in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
        ]);

        
        Task::create([
            'name' => $request->name,
            'completed' => false,
            'user_id' => auth()->id(), // Assign the logged-in user’s ID
        ]);
        
        return redirect()->route('tasks.index');
    }

    // Show a single task
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }

    // Show form to edit an existing task
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.edit', compact('task'));
    }

    // Update task in the database
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->completed = !$task->completed; // Toggle the completed status
        $task->save();
        
        return redirect()->route('tasks.index');

    }
    

    // Delete a task
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete(); // This now soft deletes the task

        return redirect()->route('tasks.index');
    }


    public function toggleCompletion(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->completed =  $request->has('completed'); // Toggle the completed status
        $task->save();

        return redirect()->route('tasks.index');
    }

}
