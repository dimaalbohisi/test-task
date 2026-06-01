<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
Route::redirect('/', '/tasks');

Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/tasks/store', [TaskController::class, 'store']);
Route::post('/tasks/delete/{id}', [TaskController::class, 'destroy']);
Route::get('/tasks/edit/{id}', [TaskController::class, 'edit']);
Route::post('/tasks/update', [TaskController::class, 'update']);

Route::get('/users', [UserController::class, 'index']);
Route::post('/users/store', [UserController::class, 'store']);
Route::get('/users/edit/{id}', [UserController::class, 'edit']);
Route::post('/users/update', [UserController::class, 'update']);
Route::post('/users/delete/{id}', [UserController::class, 'delete']);
