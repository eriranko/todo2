<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompletionController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [TodoController::class, 'index']);
Route::get('/todos/create', [TodoController::class, 'create']);
Route::post('/todos', [TodoController::class, 'store']);
Route::get('/todos/select/', [TodoController::class, 'select']);
Route::patch('/todos/update', [TodoController::class, 'update']);
Route::delete('/todos/delete', [TodoController::class, 'destroy']);
Route::get('todos/search', [TodoController::class, 'search']);


Route::get('/completions', [CompletionController::class, 'index']);
Route::post('/completions', [CompletionController::class, 'complete']);


Route::get('/categories', [CategoryController::class, 'index']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::patch('/categories/update', [CategoryController::class, 'update']);
Route::delete('/categories/delete', [CategoryController::class, 'destroy']);