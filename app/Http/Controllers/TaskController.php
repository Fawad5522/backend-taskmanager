<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all(); // Saare tasks dikhane ke liye
    }

    public function store(Request $request)
{
    // Validation Rules when stroring a new task

    //  STRICT SECURITY GUARD

    $validatedData = $request->validate([
        'title' => ['required', 'string', 'max:255', 'regex:/[a-zA-Z]/'], 
        'description' => 'nullable|string',
    ], [
        // Custom error message for title validation
        'title.regex' => 'At least one alphabet is required in the title.'
    ]);

    // When validation is successful, create a new task with the validated data

    $task = Task::create([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'status' => 'pending'
    ]);

    return response()->json($task, 201); 
}

    public function update(Request $request, Task $task)
    {
        $task->update($request->all()); 
        return response()->json($task, 200);
    }

    public function destroy(Task $task)
    {
        $task->delete(); // Task delete karne ke liye
        return response()->json(null, 204);
    }

    // 1. Recycle bin ka data laane ke liye
    public function trashed() {
        return Task::onlyTrashed()->get();
    }

    // 2. Data wapas recover karne ke liye
    public function restore($id) {
        $task = Task::withTrashed()->findOrFail($id);
        $task->restore();
        return response()->json(['message' => 'Task Recovered']);
    }

    // 3. Hamesha ke liye delete (Permanent Delete) karne ke liye
    public function forceDelete($id) {
        $task = Task::withTrashed()->findOrFail($id);
        $task->forceDelete();
        return response()->json(['message' => 'Permanently Deleted']);
    }
}