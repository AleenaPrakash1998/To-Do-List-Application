<?php

use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskShareController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('tasks', TaskController::class);
    Route::get('tasks/{task}/share', [TaskShareController::class, 'showShareForm'])->name('tasks.showShareForm');
    Route::post('tasks/{task}/share', [TaskShareController::class, 'shareTask'])->name('tasks.shareTask');
});


require __DIR__ . '/auth.php';
