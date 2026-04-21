<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController; // Humne apna controller add kiya

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// New path for Recycle bin
Route::get('/tasks/trashed', [App\Http\Controllers\TaskController::class, 'trashed']);
Route::put('/tasks/{id}/restore', [App\Http\Controllers\TaskController::class, 'restore']);
Route::delete('/tasks/{id}/force', [App\Http\Controllers\TaskController::class, 'forceDelete']);


Route::apiResource('tasks', TaskController::class);