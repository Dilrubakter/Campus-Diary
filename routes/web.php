<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DayController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendTAController;
use App\Http\Controllers\MarketPlaceController;
use App\Http\Controllers\TimeScheduleController;
use App\Http\Controllers\FrontendAlumniController;
use App\Http\Controllers\LabInformationController;
use App\Http\Controllers\TAInformationsController;
use App\Http\Controllers\ClubInformationController;
use App\Http\Controllers\FrontendFacultyController;
use App\Http\Controllers\FacultyInformationController;
use App\Http\Controllers\MarketPlaceCategoryController;

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
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('dashboard')->middleware(['auth', 'admin'])->group(function () {

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
         Route::delete('/delete/{id}', [TAInformationsController::class, 'delete'])->name('backend.ta-information.destroy');
         Route::get('/view/{id}', [TAInformationsController::class, 'view'])->name('backend.ta-information.view');
         Route::get('/office-hour/{id}', [TAInformationsController::class, 'officeHour'])->name('backend.ta-information.office-hour');
         Route::post('/office-hour/{id}', [TAInformationsController::class, 'postOfficeHour'])->name('backend.ta-information.office-hour');

      });


      /**
       * Alumni Network
       */

      Route::prefix('alumni-information')->group(function(){
        Route::get('/', [AlumniController::class, 'index'])->name('backend.alumni-information');
        Route::post('/store', [AlumniController::class, 'store'])->name('backend.alumni-information.store');
        Route::get('/create', [AlumniController::class, 'create'])->name('backend.alumni-information.create');
        Route::get('/edit/{id}', [AlumniController::class, 'edit'])->name('backend.alumni-information.edit');
        Route::put('/update/{id}', [AlumniController::class, 'update'])->name('backend.alumni-information.update');
        Route::delete('/delete/{id}', [AlumniController::class, 'delete'])->name('backend.alumni-information.destroy');
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


      Route::prefix('faculty-information')->group(function(){
        Route::get('/', [FacultyInformationController::class, 'index'])->name('backend.faculty-information');
        Route::get('/create', [FacultyInformationController::class, 'create'])->name('backend.faculty-information.create');
        Route::post('/store', [FacultyInformationController::class, 'store'])->name('backend.faculty-information.store');
        Route::get('/edit/{id}', [FacultyInformationController::class, 'edit'])->name('backend.faculty-information.edit');
        Route::put('/update/{id}', [FacultyInformationController::class, 'update'])->name('backend.faculty-information.update');
        Route::get('/view/{id}', [FacultyInformationController::class, 'view'])->name('backend.faculty-information.view');
        Route::get('/office-hour/{id}', [FacultyInformationController::class, 'officeHour'])->name('backend.faculty-information.office-hour');
        Route::post('/office-hour/{id}', [FacultyInformationController::class, 'postOfficeHour'])->name('backend.faculty-information.office-hour');
      });

      /**
       * Club Information
       */
      
      Route::prefix('club-information')->group(function() {
        Route::get('/', [ClubInformationController::class, 'index'])->name('backend.club-information');
        Route::get('/create', [ClubInformationController::class, 'create'])->name('backend.club-information.create');
        Route::post('/store', [ClubInformationController::class, 'store'])->name('backend.club-information.store');
        Route::get('/edit/{id}', [ClubInformationController::class, 'edit'])->name('backend.club-information.edit');
        Route::put('/update/{id}', [ClubInformationController::class, 'update'])->name('backend.club-information.update');
        Route::get('/view/{id}', [ClubInformationController::class, 'view'])->name('backend.club-information.view');
        Route::get('/add-panel-member/{id}', [ClubInformationController::class, 'addPanelMember'])->name('backend.club-information.add-panel-member');
        Route::post('/store-panel-member/{id}', [ClubInformationController::class, 'storePanelMember'])->name('backend.club-information.store-panel-member');
        Route::delete('/delete/{id}', [ClubInformationController::class, 'delete'])->name('backend.club-information.destroy');

      });

      /**
       * MarketPlace Information
       */

       Route::prefix('marketplace')->group(function () {
          Route::get('/category', [MarketPlaceCategoryController::class, 'index'])->name('backend.marketplace.category');
          Route::get('/category/create', [MarketPlaceCategoryController::class, 'create'])->name('backend.marketplace.category.create');
          Route::post('/category/store', [MarketPlaceCategoryController::class, 'store'])->name('backend.marketplace.category.store');
          Route::get('/category/edit/{id}', [MarketPlaceCategoryController::class, 'edit'])->name('backend.marketplace.category.edit');
          Route::post('/category/update/{id}', [MarketPlaceCategoryController::class, 'update'])->name('backend.marketplace.category.update');
          Route::delete('/delete/{id}', [MarketPlaceCategoryController::class, 'delete'])->name('backend.marketplace.category.destroy');
        // Route
       });

});

Route::post('/data-logout', [HomeController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function() {
  Route::get('/home', [HomeController::class, 'index'])->name('home');

  /**
   * post
   */

   Route::prefix('/posts')->group(function() {
    Route::get('/', [PostController::class, 'index'])->name('posts');
    Route::get('/add-post', [PostController::class, 'create'])->name('addPost');
    Route::post('/store-post', [PostController::class, 'store'])->name('post.store');
   });

   /**
   * marketplace
   */
   Route::prefix('/marketplace')->group(function() {
      Route::get('/', [\App\Http\Controllers\MarketPlaceController::class, 'index'])->name('marketplace');
      Route::get('/add-product', [MarketPlaceController::class, 'create'])->name('marketplace.add-product');
      Route::post('/store-post', [MarketPlaceController::class, 'store'])->name('marketplace.product.store');
   });
   /**
   * profile
   */
  Route::prefix('/profile')->group(function() {
    Route::get('/{id}', [\App\Http\Controllers\FrontendProfileController::class, 'index'])->name('profile');
    Route::get('/add-product', [MarketPlaceController::class, 'create'])->name('marketplace.add-product');
    Route::post('/store-post', [MarketPlaceController::class, 'store'])->name('marketplace.product.store');
 });

 Route::get('/alumni', [FrontendAlumniController::class, 'index'])->name('alumni');
 Route::get('/faculty', [FrontendFacultyController::class, 'index'])->name('faculty');
 Route::get('/faculty/view/{id}', [FrontendFacultyController::class, 'view'])->name('faculty.view');

 Route::get('ta-info', [FrontendTAController::class, 'index'])->name('ta-list');
 Route::get('/ta-info/view/{id}', [FrontendTAController::class, 'view'])->name('ta-info.view');

});



require __DIR__.'/auth.php';
 