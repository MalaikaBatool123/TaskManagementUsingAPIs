<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    
Route::get('/tasks', [TaskController::class, 'getTasks'])->name('tasks');

});
// Route::middleware('auth:sanctum')->get('tasks', [TaskController::class, 'getTasks']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::get('tasks', [TaskController::class, 'getTasks']);

Route::middleware('auth:sanctum')->group(function () {
});
// Route::get('tasks', [TaskController::class, 'getTasks']);
Route::post('add/tasks', [TaskController::class, 'store']);
Route::get('tasks/{id}', [TaskController::class, 'show']);
Route::get('tasks/{id}/edit', [TaskController::class, 'edit']);
Route::put('tasks/{id}/edit', [TaskController::class, 'update']);
Route::delete('tasks/{id}/delete', [TaskController::class, 'delete']);