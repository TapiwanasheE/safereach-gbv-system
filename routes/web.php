<?php

use App\Http\Controllers\CaseController;
use App\Http\Controllers\CounselorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LawController;
use App\Http\Controllers\MedicalController;
use App\Http\Controllers\SuperUserController;
use App\Http\Controllers\VictimController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::post('logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('home', [HomeController::class, 'index'])->name('home');


Route::middleware(['web', 'auth', 'role:Super User'])->group(function () {
    Route::get('/super-user/dashboard', [SuperUserController::class, 'dashboard'])->name('sa-dashboard');
    Route::get('/super-user/users', [SuperUserController::class, 'index'])->name('sa-users');
    Route::post('/super-user/users', [SuperUserController::class, 'store'])->name('sa-user-store');
    Route::put('/super-user/users/{id}', [SuperUserController::class, 'update'])->name('sa-user-update');
    Route::delete('/super-user/users/{id}', [SuperUserController::class, 'destroy'])->name('sa-user-destroy');
    Route::get('/sa-cases', [CaseController::class, 'index'])->name('sa-cases-index');
    Route::get('/sa-cases/{id}', [CaseController::class, 'showsa'])->name('sa-cases-show');
    Route::get('/super-user/reports', [SuperUserController::class, 'reports'])->name('sa-reports');
    Route::get('/super-user/roles', [SuperUserController::class, 'roles'])->name('sa-roles');
    Route::get('/super-user/settings', [SuperUserController::class, 'settings'])->name('sa-settings');
    Route::get('/super-user/audit-logs', [SuperUserController::class, 'auditLogs'])->name('sa-audit-logs');
});

Route::middleware(['web', 'auth', 'role:Victim'])->group(function () {
    Route::get('/victim/dashboard', [VictimController::class, 'dashboard'])->name('vic-dashboard');
    Route::get('/report-case', [CaseController::class, 'create'])->name('vic-create-case');
    Route::post('/report-case', [CaseController::class, 'store'])->name('vic-case-store');
    Route::get('/victim/my-cases', [VictimController::class, 'myCases'])->name('vic-my-cases');
    Route::get('/victim/cases/{id}', [VictimController::class, 'showCase'])->name('vic-case-detail');
    Route::get('/victim/resources', function() { return view('victim.resources'); })->name('vic-resources');
});

Route::middleware(['web', 'auth', 'role:Super User,Law Enforcement'])->group(function () {
    Route::get('/cases/{id}', [CaseController::class, 'show'])->name('cases.show');
    Route::post('/cases/{id}/assign', [CaseController::class, 'assign'])->name('cases.assign');
    Route::post('/law-cases/{id}/assign', [CaseController::class, 'assign'])->name('law-cases-assign');
});

Route::middleware(['web', 'auth', 'role:Medical'])->group(function () {
    Route::get('/medical/dashboard', [MedicalController::class, 'dashboard'])->name('med-dashboard');
    Route::get('/medical/cases', [MedicalController::class, 'index'])->name('med-cases');
    Route::get('/medical/cases/{id}', [MedicalController::class, 'show'])->name('med-case-show');
    Route::post('/medical/cases/{id}/review', [MedicalController::class, 'review'])->name('medical-case-review');
    Route::get('/medical/pending-cases', [MedicalController::class, 'pendingCases'])->name('med-pending-cases');
    Route::get('/medical/solved-cases', [MedicalController::class, 'solvedCases'])->name('med-solved-cases');
    Route::get('/medical/reports', [MedicalController::class, 'reports'])->name('med-reports');
    Route::get('/medical/settings', [MedicalController::class, 'settings'])->name('med-settings');
    Route::put('/medical/update-profile', [MedicalController::class, 'updateProfile'])->name('med-update-profile');
    Route::put('/medical/change-password', [MedicalController::class, 'changePassword'])->name('med-change-password');

    // Medical stage progression
    Route::post('/cases/{id}/medical-push-to-counseling', [CaseController::class, 'pushToCounseling'])->name('medical.push-to-counseling');
    Route::post('/cases/{id}/medical-close', [CaseController::class, 'closeCase'])->name('medical.close-case');
});

Route::middleware(['web', 'auth', 'role:Counselor'])->group(function () {
    Route::get('/counselor/dashboard', [CounselorController::class, 'dashboard'])->name('counsel-dashboard');
    Route::get('/counseling/cases', [CounselorController::class, 'index'])->name('counsel-cases');
    Route::get('/counseling/cases/{id}', [CounselorController::class, 'show'])->name('counsel-case-show');
    Route::post('/counseling/cases/{id}/notes', [CounselorController::class, 'submitNotes'])->name('counsel-submit-notes');
    Route::get('/counseling/pending-cases', [CounselorController::class, 'pendingCases'])->name('counsel-pending-cases');
    Route::get('/counseling/solved-cases', [CounselorController::class, 'solvedCases'])->name('counsel-solved-cases');
    Route::get('/counseling/reports', [CounselorController::class, 'reports'])->name('counsel-reports');
    Route::get('/counseling/settings', [CounselorController::class, 'settings'])->name('counsel-settings');
    Route::put('/counseling/update-profile', [CounselorController::class, 'updateProfile'])->name('counsel-update-profile');
    Route::put('/counseling/change-password', [CounselorController::class, 'changePassword'])->name('counsel-change-password');

    // Counseling stage progression
    Route::post('/cases/{id}/counseling-close', [CaseController::class, 'closeCase'])->name('counseling.close-case');
});

Route::middleware(['web', 'auth', 'role:Law Enforcement'])->group(function () {
    Route::get('law-enforcement/dashboard', [LawController::class, 'dashboard'])->name('law-dashboard');
    Route::get('/lawcases', [CaseController::class, 'indexlaw'])->name('law-cases.index');
    Route::get('/law-cases/{id}', [CaseController::class, 'showlaw'])->name('law-cases-show');
    Route::get('/law-enforcement/pending-cases', [LawController::class, 'pendingCases'])->name('law-pending-cases');
    Route::get('/law-enforcement/solved-cases', [LawController::class, 'solvedCases'])->name('law-solved-cases');
    Route::get('/law-enforcement/reports', [LawController::class, 'reports'])->name('law-reports');
    Route::get('/law-enforcement/settings', [LawController::class, 'settings'])->name('law-settings');
    Route::put('/law-enforcement/update-profile', [LawController::class, 'updateProfile'])->name('law-update-profile');
    Route::put('/law-enforcement/change-password', [LawController::class, 'changePassword'])->name('law-change-password');

    // Stage progression from Law Enforcement
    Route::post('/cases/{id}/push-to-medical', [CaseController::class, 'pushToMedical'])->name('cases.push-to-medical');
    Route::post('/cases/{id}/push-to-counseling', [CaseController::class, 'pushToCounseling'])->name('cases.push-to-counseling');
    Route::post('/cases/{id}/close', [CaseController::class, 'closeCase'])->name('cases.close');
});

