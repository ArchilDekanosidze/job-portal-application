<?php

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\JoblistingController;
use App\Http\Controllers\PostJobController;
use App\Http\Controllers\SubscriptionCOntroller;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAuth;
use App\Http\Middleware\isEmployer;
use App\Http\Middleware\IsPremiumUser;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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


Route::get('/',[JoblistingController::class,'index'])->name('listing.index');
Route::get('/company/{id}',[JoblistingController::class,'company'])->name('company');

Route::get('/jobs/{listing:slug}',[JoblistingController::class,'show'])->name('job.show');

Route::post('/resume/upload',[FileUploadController::class, 'store'])->middleware('auth');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/login');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/register/seeker', [UserController::class, 'createSeeker'])->name('create.seeker')
->middleware(CheckAuth::class);
Route::post('/register/seeker', [UserController::class, 'storeSeeker'])->name('store.seeker');
Route::get('/register/employer', [UserController::class, 'createEmployer'])->name('create.employer')
->middleware(CheckAuth::class);
Route::post('/register/employer', [UserController::class, 'storeEmployer'])->name('store.employer');

Route::get('/login', [UserController::class, 'login'])->name('login');
//->middleware(CheckAuth::class);
Route::post('/login', [UserController::class, 'postLogin'])->name('login.post');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile')->middleware('auth');
Route::post('user/profile', [UserController::class, 'update'])->name('user.update.profile')->middleware('auth');
Route::get('user/profile/seeker', [UserController::class, 'seekerProfile'])->name('seeker.profile')
->middleware(['auth','verified']);

Route::get('user/job/applied', [UserController::class, 'jobApplied'])->name('job.applied')
->middleware(['auth','verified']);

Route::post('user/password', [UserController::class, 'changePassword'])->name('user.password')->middleware('auth');
Route::post('upload/resume', [UserController::class, 'uploadResume'])->name('upload.resume')->middleware('auth');


Route::get('register/resend-verification', [DashboardController::class,'resendVerification'])
->name('register.resend-verification');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['verified'])
    ->name('dashboard');
Route::get('/verify', [DashboardController::class, 'verify'])->name('verification.notice');
Route::get('/resend/verification/email',[DashboardController::class, 'resend'])->name('resend.email');

Route::get('subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
Route::get('pay/weekly', [SubscriptionController::class, 'initiatePayment'])->name('pay.weekly');
Route::get('pay/monthly', [SubscriptionController::class, 'initiatePayment'])->name('pay.monthly');
Route::get('pay/yearly', [SubscriptionController::class, 'initiatePayment'])->name('pay.yearly');
Route::get('payment/success', [SubscriptionController::class, 'paymentSuccess'])->name('payment.success');
Route::get('payment/cancel', [SubscriptionController::class, 'cancel'])->name('payment.cancel');

Route::get('job/create', [PostJobController::class, 'create'])->name('job.create');
Route::post('job/store', [PostJobController::class, 'store'])->name('job.store');
Route::get('job/{listing}/edit', [PostJobController::class, 'edit'])->name('job.edit');
Route::put('job/{id}/edit', [PostJobController::class, 'update'])->name('job.update');
Route::get('job', [PostJobController::class, 'index'])->name('job.index');
Route::delete('job/{id}/delete', [PostJobController::class, 'destroy'])->name('job.delete');

Route::get('applicants' ,[ApplicantController::class, 'index'])->name('applicants.index');
Route::get('applicants/{listing:slug}' ,[ApplicantController::class, 'show'])->name('applicants.show');
Route::post('shortlist/{listingId}/{userId}', [ApplicantController::class, 'shortlist'])
->name('applicants.shortlist');
Route::post('/applicantion/{listingId}/submit', [ApplicantController::class,'apply'])->name('applicantion.submit');
