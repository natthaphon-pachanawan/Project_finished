<?php

use App\Http\Controllers\ADLController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ElderlyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CGController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SumCGcontroller;

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

Route::get('add-personnel-types', [PersonnelController::class, 'addPersonnelTypes']);
Route::get('add-user', [UserController::class, 'addUser']);


Route::controller(AuthController::class)->group(function () {

    Route::get('homepage', 'Homepage');
    Route::get('login', 'login');
    Route::post('/login', 'loginUser')->name('login.submit');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('dashboard-Doctor','Dashboard_Dcotor');
});


Route::controller(ProfileController::class)->group(function () {
});

Route::controller(ADLController::class)->group(function () {
    Route::get('SumADL','SumADL');
});

Route::controller(ElderlyController::class)->group(function () {

    Route::get('add-elderly', 'Addelderly');
    Route::post('/store-elderly', 'Storeelderly')->name('store-elderly');
    Route::get('edit-elderly/{id}', 'Editelderly')->name('edit-elderly');
    Route::put('/update-elderly/{id}', 'Updateelderly')->name('update-elderly');
    Route::delete('/delete-elderly/{id}', 'Deleteelderly')->name('delete-elderly');

    Route::get('/generate-pdf', 'generatePDF')->name('generate-pdf');
});

Route::controller(CGController::class)->group(function () {

    Route::get('get-group-adl/{elderlyId}', 'getGroupADL');
    Route::get('get-elderly-details/{elderlyId}', 'getElderlyDetails');

    Route::get('activities/create', 'createActivity')->name('activities.create');
    Route::post('/activities/store', 'storeActivity')->name('activities.store');
});




Route::get('error', function () {
    return view('error.error');
});


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////Middleware
Route::middleware(['auth'])->group(function () {
    Route::get('profile-user', [ProfileController::class, 'showProfile'])->name('profile-user');
    Route::get('edit-profile', [ProfileController::class, 'editProfile'])->name('edit-profile');
    Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('update-profile');
});



Route::middleware(['CheckLogin', 'IsAdmin', 'auth'])->group(function () {
    Route::get('admin-dashboard', function () {
        return view('admin.dashboard-admin');
    });
});

Route::middleware(['CheckLogin', 'IsStaff', 'auth'])->group(function () {

    Route::get('staff-dashboard', [ElderlyController::class, 'Showelderly'])->name('staff-dashboard');
    Route::get('adl-show', [ADLController::class, 'index'])->name('adl.index');
    Route::get('adl-edit/{id}', [ADLController::class, 'edit'])->name('adl.edit');
    Route::put('adl-update/{id}', [ADLController::class, 'update'])->name('adl.update');
    Route::delete('adl-destroy/{id}', [ADLController::class, 'destroy'])->name('adl.destroy');
    Route::get('adl-elderly', [ADLController::class, 'create'])->name('adl.create');
    Route::post('/adl/submit', [ADLController::class,  'submitADL'])->name('adl.submit');

    Route::get('cg-show', [CGController::class, 'index'])->name('cg.index');
    Route::get('cg-edit/{id}', [CGController::class, 'edit'])->name('cg.edit');
    Route::put('cg-update/{id}', [CGController::class, 'update'])->name('cg.update');
    Route::delete('cg-destroy/{id}', [CGController::class, 'destroy'])->name('cg.destroy');
    Route::get('cg-create', [CGController::class, 'create'])->name('cg.create');
    Route::post('cg-store', [CGController::class, 'store'])->name('cg.store');

    Route::get('acg-show', [CGController::class, 'showACG'])->name('acg.index');
    Route::get('acg-edit/{id}', [CGController::class, 'editActivity'])->name('acg.edit');
    Route::put('acg-update/{id}', [CGController::class, 'updateActivity'])->name('acg.update');
    Route::delete('acg-destroy/{id}', [CGController::class, 'destroyActivity'])->name('acg.destroy');

    Route::get('search-location/{id}', [ElderlyController::class, 'searchLocation'])->name('search-location');


});


Route::middleware(['CheckLogin', 'IsDoctor', 'auth'])->group(function () {
    Route::get('doctor-dashboard', function () {
        return view('doctor.dashboard-doctor');
    });
});
 Route::controller(SumCGcontroller::class)->group(function(){
    Route::get('Sum_CG','Showelderly');
 });
 Route::controller(ReportController::class)->group(function(){
    Route::get('Showreport','Dashboard_Report');
});