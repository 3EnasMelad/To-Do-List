<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\TaskController22;

Route::get('/', [TaskController22::class, 'index'])->name('tasks.index');
Route::post('/tasks', [TaskController22::class, 'store'])->name('tasks.store');
Route::put('/tasks/{task}', [TaskController22::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController22::class, 'destroy'])->name('tasks.destroy');
