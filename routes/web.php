<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DayController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TimeScheduleController;
use App\Http\Controllers\LabInformationController;
use App\Http\Controllers\TAInformationsController;
use App\Http\Controllers\FacultyInformationController;

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


      /**
       * Alumni Network
       */

      Route::prefix('alumni')->group(function(){
        Route::get('/', [AlumniController::class, 'index'])->name('backend.alumin');
        Route::get('/create', [AlumniController::class, 'create'])->name('backend.alumin.create');
        Route::post('/create', [AlumniController::class, 'store'])->name('backend.alumin');
      });

      /**
       * Lab Information
       */

      Route::prefix('lab-information')->group(function(){
        Route::get('/', [LabInformationController::class, 'index'])->name('backend.lab-information');
        Route::get('/create', [LabInformationController::class, 'create'])->name('backend.lab-information.create');
        Route::post('/', [LabInformationController::class, 'store'])->name('backend.lab-information');
        Route::get('/edit/{id}', [LabInformationController::class, 'edit'])->name('backend.lab-information.edit');
        Route::put('/edit/{id}', [LabInformationController::class, 'update'])->name('backend.lab-information.edit');
        Route::delete('/delete/{id}', [LabInformationController::class, 'delete'])->name('backend.lab-information.destroy');
        Route::get('/view/{id}', [LabInformationController::class, 'view'])->name('backend.lab-information.view');
        Route::get('/office-hour/{id}', [LabInformationController::class, 'officeHour'])->name('backend.lab-information.office-hour');
        Route::post('/office-hour/{id}', [LabInformationController::class, 'postOfficeHour'])->name('backend.lab-information.office-hour');
      });

      /**
       * Faculty-Information
       */


      // Route::prefix('faculty-information')->group(function(){
      //   Route::get('/', [FacultyInformationController::class, 'index'])->name('backend.faculty-information');
      //   Route::get('/create', [LabInformationController::class, 'create'])->name('backend.lab-information.create');
      //   Route::post('/', [LabInformationController::class, 'store'])->name('backend.lab-information');
      //   Route::get('/edit/{id}', [LabInformationController::class, 'edit'])->name('backend.lab-information.edit');
      //   Route::put('/edit/{id}', [LabInformationController::class, 'update'])->name('backend.lab-information.edit');
      //   Route::get('/view/{id}', [LabInformationController::class, 'view'])->name('backend.lab-information.view');
      //   Route::get('/office-hour/{id}', [LabInformationController::class, 'officeHour'])->name('backend.lab-information.office-hour');
      //   Route::post('/office-hour/{id}', [LabInformationController::class, 'postOfficeHour'])->name('backend.lab-information.office-hour');
      // });


});

require __DIR__.'/auth.php';
 