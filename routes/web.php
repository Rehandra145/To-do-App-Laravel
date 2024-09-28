<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

//task
Route::post('/create', [TaskController::class, 'store'])->name('Create');
Route::delete('/delete/{task}', [TaskController::class, 'delete'])->name('Delete');
Route::patch('/update/{task}', [TaskController::class, 'update'])->name('Update');
Route::get('/complete', [TaskController::class, 'show'])->name('Show');
Route::delete('/complete/DeleteAll', [TaskController::class, 'deleteAll'])->name('Clear');


Auth::routes();

//index
Route::get('/home', [TaskController::class, 'index'])->name('Index');
Route::get('/', [TaskController::class, 'index'])->name('Index');

//profile
Route::get('/profile', [ProfileController::class, 'index'])->name('indexProfile');
Route::post('/profileUp', [ProfileController::class, 'store'])->name('StoreProfile');
Route::get('/profileUp', [ProfileController::class, 'create'])->name('CreateProfile');