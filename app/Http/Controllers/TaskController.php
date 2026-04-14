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
        $task = Task::create($request->all()); // Naya task save karne ke liye
        return response()->json($task, 201);
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->all()); // Task edit karne ke liye
        return response()->json($task, 200);
    }

    public function destroy(Task $task)
    {
        $task->delete(); // Task delete karne ke liye
        return response()->json(null, 204);
    }
}