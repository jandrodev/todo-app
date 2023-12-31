<?php

use App\Http\Controllers\{IndexController, TaskController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'indexView'])->name('index');

Route::post('/create-task', [TaskController::class, 'create']);
Route::post('/delete-task', [TaskController::class, 'delete']);
Route::post('/complete-task', [TaskController::class, 'complete']);
