<?php

use App\Http\Controllers\ADLController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ElderlyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CGController;
use App\Http\Controllers\CIController;
use App\Http\Controllers\DoctorController;
use App\Models\BarthelAdl;
use App\Models\CareGiver;
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
    $sliders = App\Models\Slider::all();
    $news = App\Models\News::all();
    $visitorCount = 12344865; // ตัวอย่างข้อมูล
    $adlAssessmentCount = BarthelAdl::count();
    $cgAssessmentCount = CareGiver::count();

    $adlGroupCounts = [
        'กลุ่มติดสังคม' => BarthelAdl::where('Group_ADL', 'กลุ่มติดสังคม')->count(),
        'กลุ่มติดบ้าน' => BarthelAdl::where('Group_ADL', 'กลุ่มติดบ้าน')->count(),
        'กลุ่มติดเตียง' => BarthelAdl::where('Group_ADL', 'กลุ่มติดเตียง')->count(),
    ];

    return view('welcome', compact('sliders', 'news', 'visitorCount', 'adlAssessmentCount', 'cgAssessmentCount', 'adlGroupCounts'));
})->name('welcome');

Route::get('/news/{id}', function ($id) {
    $newsItem = App\Models\News::findOrFail($id);
    return view('layout.newshow', compact('newsItem'));
})->name('news.show');


Route::get('add-personnel-types', [PersonnelController::class, 'addPersonnelTypes']);
Route::get('add-user', [UserController::class, 'addUser']);


Route::controller(AuthController::class)->group(function () {

    Route::get('homepage', 'Homepage');
    Route::get('login', 'login');
    Route::post('/login', 'loginUser')->name('login.submit');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('dashboard-Doctor', 'Dashboard_Dcotor');

    // แสดงฟอร์มขอรีเซ็ทรหัสผ่าน
    Route::get('password/request', 'showPasswordRequestForm')->name('password.request');
    // ส่งรหัสยืนยันไปทางอีเมล
    Route::post('password/verify', 'sendVerificationCode')->name('password.verify');
    // แสดงฟอร์มกรอกรหัสยืนยันและรีเซ็ทรหัสผ่าน
    Route::post('password/verify-code', 'verifyCode')->name('password.verify-code');
    // บันทึกกรหัสผ่านใหม่
    Route::post('password/reset', 'resetPassword')->name('password.reset');
});



Route::controller(ElderlyController::class)->group(function () {

    Route::get('add-elderly', 'Addelderly');
    Route::post('/store-elderly', 'Storeelderly')->name('store-elderly');
    Route::get('edit-elderly/{id}', 'Editelderly')->name('edit-elderly');
    Route::put('/update-elderly/{id}', 'Updateelderly')->name('update-elderly');
    Route::delete('/delete-elderly/{id}', 'Deleteelderly')->name('delete-elderly');

    Route::get('elderly-report', 'showReport')->name('elderly-report');
    Route::get('/search-location/{id}', 'searchLocation')->name('search-location');
});


Route::get('/contact', function () {
    return view('layout.contact');})->name('contact');
Route::get('/about', function () {
    return view('layout.about');})->name('about');
Route::get('/about/history', function () {
    return view('layout.history');})->name('history');
Route::get('/about/vision', function () {
    return view('layout.vision');})->name('vision');

Route::get('/about/personnel', [PersonnelController::class, 'showPersonnel']);



Route::get('error', function () {
    return view('error.error');
});


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////Middleware
Route::middleware(['auth'])->group(function () {
    Route::get('profile-user', [ProfileController::class, 'showProfile'])->name('profile-user');
    Route::get('edit-profile', [ProfileController::class, 'editProfile'])->name('edit-profile');
    Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('update-profile');
});



Route::middleware(['CheckLogin', 'IsAdmin'])->group(function () {

    Route::get('admin-dashboard', [AdminController::class, 'showAdmin'])->name('admin.dashboard');
    Route::get('register-user', [AdminController::class, 'registerUser'])->name('user.register');
    Route::post('register-submit', [AdminController::class, 'submitUser'])->name('register.submit');
    Route::delete('user-delete/{id}', [AdminController::class, 'deleteUser'])->name('user.delete');
    Route::get('/admin/report-user-pdf', [AdminController::class, 'ReportUser'])->name('admin.report-user');

    // In your web.php or routes file
    Route::get('/admin/report-user-pdf-content', function () {
    // Return only the report content without sidebar/layout
    return view('admin.report-admin');
    });


    Route::get('layout-admin', [AdminController::class, 'ShowlayoutAdmin'])->name('admin.layout-admin');


    // News routes
    Route::post('news/store', [AdminController::class, 'storeNews'])->name('admin.news.store');
    Route::get('news/{id}/edit', [AdminController::class, 'editNews']);
    Route::put('news/{id}', [AdminController::class, 'updateNews'])->name('admin.news.update'); // Add this line
    Route::delete('news/{id}', [AdminController::class, 'destroyNews'])->name('admin.news.destroy');

    // Slider routes
    Route::post('sliders/store', [AdminController::class, 'storeSlider'])->name('admin.sliders.store');
    Route::put('sliders/{id}', [AdminController::class, 'updateSlider'])->name('admin.sliders.update');
    Route::delete('sliders/{id}', [AdminController::class, 'destroySlider'])->name('admin.sliders.destroy');
});

Route::middleware(['CheckLogin', 'IsStaff'])->group(function () {

    Route::get('get-elderly-details/{elderlyId}', [CGController::class, 'getElderlyDetails']);

    Route::get('staff-dashboard', [ElderlyController::class, 'Showelderly'])->name('staff-dashboard');
    Route::get('adl-show', [ADLController::class, 'index'])->name('adl.index');
    Route::get('adl-edit/{id}', [ADLController::class, 'edit'])->name('adl.edit');
    Route::put('adl-update/{id}', [ADLController::class, 'update'])->name('adl.update');
    Route::delete('adl-destroy/{id}', [ADLController::class, 'destroy'])->name('adl.destroy');
    Route::get('adl-elderly', [ADLController::class, 'create'])->name('adl.create');
    Route::post('/adl/submit', [ADLController::class,  'submitADL'])->name('adl.submit');
    Route::get('/report-all-adl', [ADLController::class, 'ReportADLAll'])->name('report.all.adl');
    Route::get('/report-adl/{id}', [ADLController::class, 'ReportADL'])->name('report.adl');

    Route::get('cg-show', [CGController::class, 'index'])->name('cg.index');
    Route::get('cg-edit/{id}', [CGController::class, 'edit'])->name('cg.edit');
    Route::put('cg-update/{id}', [CGController::class, 'update'])->name('cg.update');
    Route::delete('cg-destroy/{id}', [CGController::class, 'destroy'])->name('cg.destroy');
    Route::get('cg-create', [CGController::class, 'create'])->name('cg.create');
    Route::post('cg-store', [CGController::class, 'store'])->name('cg.store');
    Route::get('report-all-cg', [CGController::class, 'ReportCGAll'])->name('report.all.cg');
    Route::get('report-cg/{id}', [CGController::class, 'ReportCG'])->name('report.cg');


    Route::get('acg-create', [CGController::class, 'createActivity'])->name('activities.create');
    Route::post('/acg-store', [CGController::class, 'storeActivity'])->name('activities.store');
    Route::get('acg-show', [CGController::class, 'showACG'])->name('acg.index');
    Route::get('acg-edit/{id}', [CGController::class, 'editActivity'])->name('acg.edit');
    Route::put('/acg-update/{id}', [CGController::class, 'updateActivity'])->name('acg.update');
    Route::delete('/acg-destroy/{id}', [CGController::class, 'destroyActivity'])->name('acg.destroy');
    Route::get('report-all-acg', [CGController::class, 'ReportACGAll'])->name('report.all.acg');
    Route::get('report-acg/{id}', [CGController::class, 'ReportACG'])->name('report.acg');

    Route::get('staff-ci', [CIController::class, 'ShowStaffCI'])->name('staff.ci.index');
    Route::put('staff-ci/{id}/confirm', [CIController::class, 'confirmCI'])->name('ci.confirm');
    Route::put('ci/{id}/unconfirm', [CIController::class, 'unconfirmCI'])->name('ci.unconfirm');
    Route::get('report-ci-confirm', [CIController::class, 'ReportCIConfirm'])->name('report.ci.confirm');

    Route::get('search-location/{id}', [ElderlyController::class, 'searchLocation'])->name('search-location');
});


Route::middleware(['CheckLogin', 'IsDoctor'])->group(function () {


    Route::controller(DoctorController::class)->group(function () {
        Route::get('doctor-dashboard', 'ShowDataElderly')->name('doctor.dashboard');
        Route::get('ci-show', 'ShowCI')->name('ci.index');
        Route::get('ci-create', 'CreateCI')->name('ci.create');
        Route::post('/ci-store', 'storeCI')->name('ci.store');
        Route::delete('/ci/{id}', 'DestroyCI')->name('ci.destroy');
        Route::get('ci/{id}/edit', 'editCI')->name('ci.edit');
        Route::put('/ci/{id}', 'updateCI')->name('ci.update');
        Route::get('/care-instructions/report', 'ReportCI')->name('report.ci');
    });
});
