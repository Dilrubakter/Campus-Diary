<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DayController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TimeScheduleController;
use App\Http\Controllers\TAInformationsController;

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

     /**
      * TA information routes
      */

      Route::prefix('ta-information')->group(function () {
         Route::get('/', [TAInformationsController::class, 'index'])->name('backend.ta-information');
         Route::post('/', [TAInformationsController::class, 'store'])->name('backend.ta-information');
         Route::get('/create', [TAInformationsController::class, 'create'])->name('backend.ta-information.create');
         Route::get('/edit/{id}', [TAInformationsController::class, 'edit'])->name('backend.ta-information.edit');
         Route::put('/edit/{id}', [TAInformationsController::class, 'update'])->name('backend.ta-information.edit');
         Route::get('/view/{id}', [TAInformationsController::class, 'view'])->name('backend.ta-information.view');
         Route::get('/office-hour/{id}', [TAInformationsController::class, 'officeHour'])->name('backend.ta-information.office-hour');
         Route::post('/office-hour/{id}', [TAInformationsController::class, 'postOfficeHour'])->name('backend.ta-information.office-hour');

      });


      /**\
       * Alumni Network
       */

      Route::prefix('alumni')->group(function(){
        Route::get('/', [AlumniController::class, 'index'])->name('backend.alumin');
        Route::get('/create', [AlumniController::class, 'create'])->name('backend.alumin.create');
        Route::post('/create', [AlumniController::class, 'store'])->name('backend.alumin');
      });


});

require __DIR__.'/auth.php';
