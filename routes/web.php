<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TimeScheduleController;
use App\Http\Controllers\DayController;

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

    /**
     * Admin Settings >> Time Schedule Routes
     */
    Route::prefix('time-schedule')->group(function () {
        Route::get('/', [TimeScheduleController::class, 'index'])->name('backend.timeschedule');
        Route::get('/create', [TimeScheduleController::class, 'create'])->name('backend.timeschedule.create');
        Route::post('/', [TimeScheduleController::class, 'store'])->name('backend.timeschedule');
        Route::delete('/records/{id}', [TimeScheduleController::class, 'delete'])->name('records.delete');
    });

    /**
     * Admin Settings >> Day Routes
     */

     Route::prefix('day')->group(function () {
        Route::get('/', [DayController::class, 'index'])->name('backend.day');
        Route::post('/', [DayController::class, 'store'])->name('backend.day');
        Route::get('/create', [DayController::class, 'create'])->name('backend.day.create');
     });


});

require __DIR__.'/auth.php';
