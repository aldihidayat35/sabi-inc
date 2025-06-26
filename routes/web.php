<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\Frontend\WorkController as FrontendWorkController;
use App\Http\Controllers\Auth\StudentLoginController;
use App\Http\Controllers\Auth\TeacherLoginController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController; // Tambahkan jika belum ada
use App\Http\Controllers\Frontend\ProfilController as FrontendProfilController;
use App\Http\Controllers\Frontend\ChallengeController as FrontendChallengeController;
use App\Http\Controllers\Frontend\ChallengeRegistrationController;
use App\Http\Controllers\Frontend\LmsController;
use App\Http\Controllers\Frontend\FavoriteController;
use App\Http\Controllers\DashboardController;

Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('frontend.home');

Route::get('/', function () {
    return redirect()->route('student.login');
});
// Work teacher scoring route
Route::middleware('auth:teacher')->group(function () {
    Route::get('/works/score', [\App\Http\Controllers\WorkController::class, 'scorePage'])->name('works.score.page');
    Route::post('/works/{work}/score', [\App\Http\Controllers\WorkController::class, 'score'])->name('works.score');
});
// Define the dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('applications', ApplicationController::class);
Route::resource('teachers', TeacherController::class);
Route::resource('students', StudentController::class);
Route::resource('categories', CategoryController::class);
Route::resource('works', WorkController::class);
Route::resource('challenges', ChallengeController::class);

// Feedback routes
Route::post('feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('feedback/count/{workId}', [FeedbackController::class, 'count'])->name('feedback.count');

// Topic and Material routes
Route::resource('topics', TopicController::class);
Route::resource('topics.materials', MaterialController::class)->shallow();

// Direct route for materials index
Route::get('materials', [MaterialController::class, 'index'])->name('materials.index');
Route::prefix('frontend/works')->name('frontend.works.')->group(function () {
    Route::get('/', [FrontendWorkController::class, 'index'])->name('index');
    Route::get('/create', [FrontendWorkController::class, 'create'])->name('create'); // Define the create route
    Route::post('/store', [FrontendWorkController::class, 'store'])->name('store');   // Define the store route
    Route::get('/{id}', [FrontendWorkController::class, 'show'])->name('show');
});

// Komentar karya
Route::middleware('auth:student')->group(function () {
    Route::post('/works/{work}/comments', [\App\Http\Controllers\Frontend\WorkCommentController::class, 'store'])->name('frontend.works.comments.store');
});

// AJAX Like/Dislike/Rating
Route::middleware('auth:student')->group(function () {
    Route::post('/works/{work}/rating', [\App\Http\Controllers\Frontend\WorkRatingController::class, 'store'])->name('frontend.works.rating.store');
    Route::get('/works/{work}/rating', [\App\Http\Controllers\Frontend\WorkRatingController::class, 'get'])->name('frontend.works.rating.get');
});

// Favorite routes
Route::middleware('auth:student')->group(function () {
    Route::post('/works/{work}/favorite', [FavoriteController::class, 'toggle'])->name('frontend.works.favorite.toggle');
    Route::get('/favorit-saya', [FavoriteController::class, 'index'])->name('frontend.favorit-saya');
});

// Frontend routes
Route::prefix('frontend')->name('frontend.')->group(function () {
    Route::get('/', [FrontendHomeController::class, 'index'])->name('home'); // Home route
    Route::get('works', [FrontendWorkController::class, 'index'])->name('works.index');
    Route::get('works/category/{category}', [FrontendWorkController::class, 'byCategory'])->name('works.byCategory'); // <-- Tambah ini
    Route::get('works/{id}', [FrontendWorkController::class, 'show'])->name('works.show');
    Route::get('profil/detail', [FrontendProfilController::class, 'detail'])->name('profil.detail'); // Tambah ini
    Route::get('karya-saya', [FrontendProfilController::class, 'karyaSaya'])->name('karya-saya');
    Route::get('tentang-sabi', function () {
        return view('frontend.tentang-sabi');
    })->name('tentang-sabi');
    Route::get('challenges/list', [FrontendChallengeController::class, 'list'])->name('challenges.list');
    Route::get('challenges/{id}', [FrontendChallengeController::class, 'show'])->name('challenges.show');
    Route::post('challenges/{id}/register', [ChallengeRegistrationController::class, 'store'])->name('challenges.register');
    Route::get('lms/topics', [LmsController::class, 'topics'])->name('lms.topics');
    Route::get('lms/topics/{topic}', [LmsController::class, 'materials'])->name('lms.materials');
    Route::get('lms/material/{material}', [LmsController::class, 'showMaterial'])->name('lms.material.show');
    Route::get('/profil', [\App\Http\Controllers\Frontend\ProfilController::class, 'index'])->name('profil');

    Route::get('/profil2', [\App\Http\Controllers\Frontend\StudentProfileController::class, 'myProfile'])->name('profil2');
    Route::put('/profil', [\App\Http\Controllers\Frontend\StudentProfileController::class, 'updateProfile'])->name('profil.update');
    Route::get('penilaian-guru', [FrontendProfilController::class, 'penilaianGuru'])->middleware('auth:student')->name('penilaian-guru');
});

// Route untuk evaluasi oleh admin/guru
Route::post('challenges/registrations/{id}/evaluate', [ChallengeController::class, 'evaluateRegistration'])->name('challenges.registrations.evaluate');

// Route untuk halaman daftar pendaftar challenge
Route::get('challenges/{id}/registrations', [ChallengeController::class, 'registrations'])->name('challenges.registrations');

// Student login & registration routes
Route::prefix('student')->name('student.')->group(function () {
    Route::get('login', [StudentLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [StudentLoginController::class, 'login']);
    Route::post('logout', [StudentLoginController::class, 'logout'])->name('logout');
     // Tambahkan baris berikut:
    Route::get('logout', function () {
        return redirect()->route('student.login');
    });
    // Registration routes
    Route::get('register', [StudentLoginController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [StudentLoginController::class, 'register']);
    // Profil student lain & follow
    Route::get('profile/{student}', [\App\Http\Controllers\Frontend\StudentProfileController::class, 'show'])->name('profile.show');
    Route::post('profile/{student}/follow', [\App\Http\Controllers\Frontend\StudentProfileController::class, 'follow'])->middleware('auth:student')->name('profile.follow');
    Route::post('profile/{student}/unfollow', [\App\Http\Controllers\Frontend\StudentProfileController::class, 'unfollow'])->middleware('auth:student')->name('profile.unfollow');
    Route::get('profile/{student}/followers', [\App\Http\Controllers\Frontend\StudentProfileController::class, 'followers'])->name('profile.followers');
    Route::get('profile/{student}/followings', [\App\Http\Controllers\Frontend\StudentProfileController::class, 'followings'])->name('profile.followings');
});

// Teacher login routes
Route::prefix('teacher')->name('teacher.')->group(function () {
    Route::get('login', [TeacherLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [TeacherLoginController::class, 'login']);
    Route::post('logout', [TeacherLoginController::class, 'logout'])->name('logout');
});


