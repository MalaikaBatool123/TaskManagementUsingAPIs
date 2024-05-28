<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/tasks', [TaskController::class, 'read'])->name('tasks');
    
    Route::get('/tasks/{task}', [TaskController::class, 'show']); 
    Route::post('/updateTask', [TaskController::class, 'update']);
    Route::post('/add-task', [TaskController::class, 'store'])->name('add-task');   

});



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::get('/admin/tasks', 'App\Http\Controllers\Admin\TaskController@index')->name('voyager.tasks');

});
