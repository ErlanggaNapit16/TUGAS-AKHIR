<?php

use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CreateKonselorController;
use App\Http\Controllers\PembelajaranController;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\TaskCemasController;
use App\Http\Controllers\TaskDepresiController;
use App\Models\Pembelajaran;
use App\Models\TeamMember;
use App\Models\Feedback;
use App\Models\Announcement;
use App\Models\Carousel;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\AnalisisController;
use App\Models\User;
use App\Http\Controllers\DashboardKonselorController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\TaskBeratController;


Route::get('/', function () {
    $announcements = Announcement::latest()->get();
    $carousels = Carousel::latest()->get();
    $pembelajaran = Pembelajaran::latest()->get();
    $teamMembers = TeamMember::latest()->get();
    $feedbacks = Feedback::latest()->take(3)->get();
    $users = User::all(); // Tambahin ini

    return view('homepage', compact(
        'announcements',
        'carousels',
        'pembelajaran',
        'teamMembers',
        'feedbacks',
        'users' // Tambahin ini
    ));
})->name('homepage');

Route::middleware(['auth'])->group(function () {
    Route::get('/jadwal', function () {
        return view('jadwal_user');
    })->name('jadwal.user');
});

// Route untuk halaman login & registrasi
Route::get('/auth/registrasi', [AuthController::class, 'tampilRegistrasi'])->name('registrasi.tampil');
Route::post('/auth/registrasi/submit', [AuthController::class, 'submitRegistrasi'])->name('registrasi.submit');
Route::get('/auth/login', [AuthController::class, 'tampilLogin'])->name('login');
Route::post('/auth/login/submit', [AuthController::class, 'submitLogin'])->name('login.submit');

// Logout hanya bisa dilakukan jika user sudah login
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', RoleMiddleware::class . ':customer'])->group(function () {
    Route::get('/analisis', [AnalisisController::class, 'showForm'])->name('analisis.form');
    Route::post('/analisis/predict', [AnalisisController::class, 'predict'])->name('analisis.predict');
});

Route::middleware(['auth', RoleMiddleware::class . ':customer'])->group(function () {
    // Mengubah route histori agar menggunakan controller RiwayatController
    Route::get('/histori', [RiwayatController::class, 'index'])->name('histori');

    Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
    Route::get('/task/{taskId}', [RiwayatController::class, 'taskDetail'])->name('task.detail');
});

// Tambahkan middleware 'auth' untuk memastikan hanya user yang login yang bisa mengakses
Route::middleware('auth')->group(function () {
    Route::get('/user-depresi', [TaskDepresiController::class, 'indexUser'])->name('user_depresi');


    // Route untuk menampilkan halaman user cemas (GET)
    Route::get('/user_cemas', [TaskCemasController::class, 'indexUser'])->name('user_cemas');

    // Route untuk mereset progres task cemas (POST)
    Route::post('/cemas-user-reset', [TaskCemasController::class, 'resetCemasTasks'])->name('task_cemas.reset');

    Route::get('/task_berat', function () {
        return view('task_berat');
    })->name('user.task_berat');
});

// Pastikan rute ini ada dan mengarah ke controller yang sesuai atau view yang tepat
Route::middleware('auth')->group(function () {
    Route::get('/depresi-konselor', [TaskDepresiController::class, 'indexKonselorDepresi'])->name('konselor.depresi');
    Route::get('/cemas-konselor', [TaskCemasController::class, 'indexKonselorCemas'])->name('konselor.cemas');

    Route::get('/task-berat-konselor', [TaskBeratController::class, 'indexKonselorBerat'])->name('konselor.task_berat');
});

Route::prefix('konselor/task-cemas')->name('konselor.task_cemas.')->middleware('auth')->group(function () {
    Route::get('/', [TaskCemasController::class, 'indexKonselorCemas'])->name('index'); // ✅ DITAMBAHKAN
    Route::get('/create', [TaskCemasController::class, 'create'])->name('create');
    Route::post('/store', [TaskCemasController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [TaskCemasController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [TaskCemasController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [TaskCemasController::class, 'destroy'])->name('delete');
});
Route::post('/progress/{taskId}/complete', [ProgressController::class, 'markAsCompleted'])->name('progress.complete');
Route::get('/user-cemas', [TaskCemasController::class, 'indexUser'])->name('user_cemas');
Route::post('/progress/cemas/{taskId}/complete', [TaskDepresiController::class, 'markAsCompleted'])
    ->middleware('auth')
    ->name('progress.cemas.complete');


Route::prefix('konselor/task-depresi')->name('konselor.task_depresi.')->middleware('auth')->group(function () {
    Route::get('/', [TaskDepresiController::class, 'indexKonselorDepresi'])->name('index');
    Route::get('/create', [TaskDepresiController::class, 'create'])->name('create');
    Route::post('/store', [TaskDepresiController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [TaskDepresiController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [TaskDepresiController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [TaskDepresiController::class, 'destroy'])->name('delete');
});

Route::post('/progress/depresi/{taskId}/complete', [TaskDepresiController::class, 'markAsCompleted'])
    ->middleware('auth')
    ->name('progress.depresi.complete');

Route::get('/user-depresi', [TaskDepresiController::class, 'indexUser'])->name('user_depresi');
Route::post('/task-depresi/reset', [TaskDepresiController::class, 'resetDepresiTasks'])->name('task_depresi.reset');


Route::prefix('konselor/task-berat')->name('konselor.task_berat.')->middleware('auth')->group(function () {
    Route::get('/', [TaskBeratController::class, 'indexKonselorBerat'])->name('index'); // Menampilkan daftar task berat untuk konselor
    Route::get('/create', [TaskBeratController::class, 'create'])->name('create'); // Form untuk membuat task berat baru
    Route::post('/store', [TaskBeratController::class, 'store'])->name('store'); // Menyimpan task berat baru
    Route::get('/edit/{id}', [TaskBeratController::class, 'edit'])->name('edit'); // Form untuk mengedit task berat
    Route::put('/update/{id}', [TaskBeratController::class, 'update'])->name('update'); // Mengupdate task berat
    Route::delete('/delete/{id}', [TaskBeratController::class, 'destroy'])->name('delete'); // Menghapus task berat
});
// Route untuk user mengakses task berat
Route::get('/user-berat', [TaskBeratController::class, 'indexUser'])->name('user_berat'); // Menampilkan task berat untuk user

Route::post('/progress/berat/{taskId}/complete', [TaskBeratController::class, 'markAsCompleted'])
    ->middleware('auth')
    ->name('progress.berat.complete');

// Reset task berat
Route::post('/task-berat/reset', [TaskBeratController::class, 'resetBeratTasks'])->name('task_berat.reset'); // Mengatur ulang task berat



Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Menampilkan daftar konselor
    Route::get('/admin/konselor', [CreateKonselorController::class, 'index'])->name('admin.create_konselor_admin');

    // Form tambah konselor
    Route::get('/admin/konselor/create', [CreateKonselorController::class, 'create'])->name('admin.create_konselor');

    // Simpan konselor baru
    Route::post('/admin/konselor/store', [CreateKonselorController::class, 'store'])->name('admin.store_konselor_admin');
    Route::delete('/admin/konselor/{id}', [CreateKonselorController::class, 'destroy'])->name('admin.delete_konselor');
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
    Route::get('/konselor/dashboard', [DashboardKonselorController::class, 'index'])->name('konselor.dashboard');

    Route::get('/konselor/schedule', function () {
        return view('Konselor.jadwal_konselor');
    })->name('jadwal.konselor');

    Route::get('/konselor/data-lengkap/{id}', [DashboardKonselorController::class, 'dataLengkap'])->name('konselor.data_lengkap');
    Route::get('/download/pdf/{userId}', [DashboardKonselorController::class, 'downloadPdf'])->name('download.pdf');
    // Menampilkan halaman semua analisis
    Route::get('/semua-analisis', [DashboardKonselorController::class, 'semuaAnalisis'])->name('konselor.semuaAnalisis');

    // Route untuk download PDF
    Route::get('/download-semua-analisis-pdf', [DashboardKonselorController::class, 'downloadSemuaAnalisisPdf'])->name('konselor.downloadSemuaAnalisisPdf');

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
    // Route untuk Konselor Membuat,Mengedit, dan Menghapus Pembelajaran
    Route::middleware(['auth', RoleMiddleware::class . ':konselor'])->group(function () {
        Route::get('/konselor/pembelajaran', [PembelajaranController::class, 'indexKonselor'])->name('konselor.pembelajaran');
        Route::get('/konselor/pembelajaran', [PembelajaranController::class, 'indexGabungan'])->name('konselor.pembelajaran');
        Route::get('/konselor/pembelajaran/create', [PembelajaranController::class, 'create'])->name('konselor.pembelajaran.create');
        Route::post('/konselor/pembelajaran/store', [PembelajaranController::class, 'store'])->name('konselor.pembelajaran.store');
        Route::get('/konselor/pembelajaran/{id}/edit', [PembelajaranController::class, 'edit'])->name('konselor.pembelajaran.edit');
        Route::put('/konselor/pembelajaran/{id}', [PembelajaranController::class, 'update'])->name('konselor.pembelajaran.update');
        Route::delete('/konselor/pembelajaran/{id}', [PembelajaranController::class, 'destroy'])->name('konselor.pembelajaran.destroy');
    });
    Route::post('/konselor/pembelajaran/upload-chunk', [PembelajaranController::class, 'uploadChunk'])->name('konselor.pembelajaran.chunk');

    // Route untuk Konselor Membuat,Mengedit, dan Menghapus Study
    Route::prefix('konselor')->middleware('auth')->group(function () {
        Route::get('/study', [StudyController::class, 'indexKonselor'])->name('konselor.study.index');
        Route::get('/pembelajaran_konselor', [StudyController::class, 'indexKonselorGabung'])->name('konselor.pembelajaran_konselor');
        Route::get('/study/create', [StudyController::class, 'create'])->name('konselor.study_create');
        Route::post('/study', [StudyController::class, 'store'])->name('konselor.study.store');
        Route::get('/study/{id}/edit', [StudyController::class, 'edit'])->name('konselor.study.edit');
        Route::put('/study/{id}', [StudyController::class, 'update'])->name('konselor.study.update');
        Route::delete('/study/{id}', [StudyController::class, 'destroy'])->name('konselor.study.destroy');
    });
});
Route::middleware(['auth'])->group(function () {
    Route::get('/jadwal/user', [ScheduleController::class, 'indexUser'])->name('jadwal.user');
    Route::get('/jadwal/konselor', [ScheduleController::class, 'indexKonselor'])->name('jadwal.konselor');
    Route::post('/jadwal/store', [ScheduleController::class, 'store'])->name('jadwal.store');
    Route::post('/jadwal/{id}/approve', [ScheduleController::class, 'approve'])->name('jadwal.approve');
    Route::post('/jadwal/{id}/reschedule', [ScheduleController::class, 'reschedule'])->name('jadwal.reschedule');
    Route::get('/jadwal/reschedule/{id}', [ScheduleController::class, 'showRescheduleForm'])->name('jadwal.rescheduleForm');
    Route::post('/jadwal/reschedule/options/{id}', [ScheduleController::class, 'sendRescheduleOptions'])->name('jadwal.sendRescheduleOptions');
    Route::get('/jadwal/select-reschedule-options/{id}', [ScheduleController::class, 'showRescheduleOptions'])->name('jadwal.selectRescheduleOptions');
    Route::post('/jadwal/choose-option/{id}', [ScheduleController::class, 'chooseRescheduleOption'])->name('jadwal.chooseOption');
    Route::post('/jadwal/{id}/reject', [ScheduleController::class, 'reject'])->name('jadwal.reject');
});



Route::middleware('auth')->group(function () {
    Route::get('/pembelajaran', [PembelajaranController::class, 'indexUser'])->name('pembelajaran_user');
    Route::get('/pembelajaran/{id}', [PembelajaranController::class, 'show'])->name('pembelajaran_detail');
    Route::get('/konselor/pembelajaran/{id}/detail', [PembelajaranController::class, 'showKonselor'])->name('konselor.pembelajaran.detail');
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
