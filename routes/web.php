<?php

use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutUsController;



// Homepage menampilkan 5 pengumuman terbaru
Route::get('/', function () {
    $announcements = app(AnnouncementController::class)->homepage();
    $carousels = app(CarouselController::class)->homepage();

    return view('homepage', compact('announcements', 'carousels'));
})->name('homepage');



// Route untuk halaman login & registrasi
Route::get('/auth/registrasi', [AuthController::class, 'tampilRegistrasi'])->name('registrasi.tampil');
Route::post('/auth/registrasi/submit', [AuthController::class, 'submitRegistrasi'])->name('registrasi.submit');
Route::get('/auth/login', [AuthController::class, 'tampilLogin'])->name('login');
Route::post('/auth/login/submit', [AuthController::class, 'submitLogin'])->name('login.submit');

// Logout hanya bisa dilakukan jika user sudah login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Route untuk admin dengan middleware
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard_admin');
    })->name('admin.dashboard');
});


// Admin - Mengelola About Us dan Team Members
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/about-us', [AboutUsController::class, 'index'])->name('admin.about_us_admin');
    Route::get('/admin/about-us/edit', [AboutUsController::class, 'edit'])->name('admin.about_us_edit');
    Route::post('/admin/about-us/update', [AboutUsController::class, 'update'])->name('admin.about_us_update');

    // Routes untuk Team Members
    Route::get('/admin/about-us/team-members/create', [AboutUsController::class, 'createTeamMember'])->name('admin.about_us_team_member_create');
    Route::post('/admin/team-members/store', [AboutUsController::class, 'storeTeamMember'])->name('admin.team_members_store');
    Route::get('/admin/team-members/{id}/edit', [AboutUsController::class, 'editTeamMember'])->name('admin.team_members_edit');
    Route::post('/admin/team-members/{id}/update', [AboutUsController::class, 'updateTeamMember'])->name('admin.team_members_update');
    Route::delete('/admin/team-members/{id}', [AboutUsController::class, 'destroyTeamMember'])->name('admin.team_members_delete');
});


Route::get('/about_us', [AboutUsController::class, 'show'])->name('about_us');


// Route untuk konselor dengan middleware
Route::middleware(['auth', RoleMiddleware::class . ':konselor'])->group(function () {
    Route::get('/konselor/dashboard', function () {
        return view('konselor.dashboardkonselor');
    })->name('konselor.dashboard');

    // Kelompok route untuk pengumuman oleh konselor
    Route::prefix('/konselor/pengumuman')->group(function () {
        Route::get('/', [AnnouncementController::class, 'index'])->name('konselor.pengumuman');
        Route::get('/create', [AnnouncementController::class, 'create'])->name('konselor.create');
        Route::post('/', [AnnouncementController::class, 'store'])->name('konselor.store');
        Route::get('/{announcement}/edit', [AnnouncementController::class, 'edit'])->name('konselor.edit');
        Route::put('/{announcement}', [AnnouncementController::class, 'update'])->name('konselor.update');
        Route::delete('/{announcement}', [AnnouncementController::class, 'destroy'])->name('konselor.destroy');

        // Route untuk detail pengumuman khusus Konselor
        Route::get('/{announcement}', [AnnouncementController::class, 'konselorAnnouncementDetail'])
            ->name('konselor.pengumuman.detail');
    });

    // Kelompok route untuk Carousel
    Route::prefix('/konselor/carousel')->group(function () {
        Route::get('/', [CarouselController::class, 'index'])->name('konselor.carousel');
        Route::get('/create', [CarouselController::class, 'create'])->name('konselor.carousel.create');
        Route::post('/', [CarouselController::class, 'store'])->name('konselor.carousel.store');
        Route::get('/{id}/edit', [CarouselController::class, 'edit'])->name('konselor.carousel.edit');
        Route::put('/{id}', [CarouselController::class, 'update'])->name('konselor.carousel.update');
        Route::delete('/{id}', [CarouselController::class, 'destroy'])->name('konselor.carousel.destroy');
    });

    // Route untuk Konselor melihat dan menghapus feedback
    Route::prefix('/konselor/feedback')->group(function () {
        Route::get('/', [FeedbackController::class, 'index'])->name('konselor.feedback.index');
        Route::delete('/{feedback}', [FeedbackController::class, 'destroy'])->name('konselor.feedback.destroy');
        Route::get('/konselor/feedback', [FeedbackController::class, 'index'])->name('konselor.feedback');
    });
});

// Menampilkan pengumuman detail untuk user umum
Route::get('/announcement/{announcement}', [AnnouncementController::class, 'show'])->name('announcement.show');

// Menampilkan halaman semua pengumuman (View All)
Route::get('/announcements', [AnnouncementController::class, 'viewAll'])->name('announcement.index');
Route::get('/carousel', [CarouselController::class, 'showToUser'])->name('carousel.user');


Route::middleware('auth')->group(function () {
    Route::get('/feedback_user', [FeedbackController::class, 'userFeedback'])->name('feedback.user');
    // Tambahkan ini agar user bisa menghapus feedback mereka sendiri
    Route::delete('/feedback/{feedback}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');
});

// Route untuk User mengirim feedback
Route::middleware('auth')->group(function () {
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile-konselor', [ProfileController::class, 'show'])->name('profile.konselor');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile-konselor', [ProfileController::class, 'showKonselorProfile'])->name('profile.konselor');
    Route::post('/profile-konselor/update', [ProfileController::class, 'updateProfile'])->name('profile.konselor.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile-konsoler', [ProfileController::class, 'show'])->name('profile.konsoler');
    Route::match(['post', 'put'], '/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});
