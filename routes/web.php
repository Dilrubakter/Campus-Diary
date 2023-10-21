<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeScheduleController;


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('dashboard')->group(function () {
    Route::prefix('time-schedule')->group(function () {
        Route::get('/', [TimeScheduleController::class, 'index'])->name('backend.timeschedule');
        Route::get('/create', [TimeScheduleController::class, 'create'])->name('backend.timeschedule.create');
        Route::post('/', [TimeScheduleController::class, 'store'])->name('backend.timeschedule');
        Route::delete('/records/{id}', [TimeScheduleController::class, 'delete'])->name('records.delete');
    });
});

require __DIR__.'/auth.php';
