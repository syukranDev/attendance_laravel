<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClockController;
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
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    // Option 1 below
    // Route::get('/department', [DepartmentController::class, 'index'])->name('department.index');
    // Route::get('/department', [DepartmentController::class, 'create'])->name('department.create');
    // Route::post('/department', [DepartmentController::class, 'store'])->name('department.store');
    // Route::get('/department', [DepartmentController::class, 'index'])->name('department.index');
    // Route::get('/department', [DepartmentController::class, 'index'])->name('department.index');
    // Option 2 below: do below line instead of writing one-by-one as above
    Route::resource('/department', DepartmentController::class);
    Route::resource('/user', UserController::class);

    Route::get('/clock', [ClockController::class, 'get'])->name('clock.get');
    Route::post('/clock', [ClockController::class, 'post'])->name('clock.post');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
