<?php

use App\Http\Controllers\ADLController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;

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


Route::controller(AuthController::class)->group(function(){

    Route::get('homepage','Homepage');
    Route::get('login','login');
    Route::post('/login','loginUser')->name('login.submit');

    Route::post('/logout','logout')->name('logout');

});


Route::controller(ProfileController::class)->group(function(){

});

Route::controller(ADLController::class)->group(function(){

    Route::get('ADL','ADL');

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



Route::middleware(['CheckLogin', 'IsAdmin','auth'])->group(function () {
    Route::get('admin-dashboard', function () {
        return view('admin.dashboard-admin');
    });
});

Route::middleware(['CheckLogin', 'IsStaff','auth'])->group(function () {
    Route::get('staff-dashboard', function () {
        return view('staff.dashboard-staff');
    });
});

Route::middleware(['CheckLogin', 'IsDoctor','auth'])->group(function () {
    Route::get('doctor-dashboard', function () {
        return view('doctor.dashboard-doctor');
    });
});



