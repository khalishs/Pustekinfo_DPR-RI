<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\GalleryCategoryController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\Admin\NewsItemController;
use App\Http\Controllers\Admin\AgendaEventController;
use App\Http\Controllers\Admin\GalleryItemController;
use App\Http\Controllers\Admin\LeadershipController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\Admin\TimelineItemController;
use App\Http\Controllers\Admin\OrganizationMemberController;
use App\Http\Controllers\Admin\VisionMissionController;
use App\Http\Controllers\Admin\CoreValueController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\ProfilPhotoController;
use App\Http\Controllers\Admin\PageBannerController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\StelaVideoController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ServiceRequestController;
use App\Http\Controllers\ProfilController;


Route::view('/galeri', 'galeri')->name('galeri');
Route::view('/kontak', 'kontak')->name('kontak');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');
Route::get('/layanan/ajukan', [LayananController::class, 'ajukan'])->name('layanan.ajukan');
Route::post('/layanan/ajukan', [LayananController::class, 'ajukanStore'])->name('layanan.ajukan.store');
Route::get('/layanan/status', [LayananController::class, 'status'])->name('layanan.status');
Route::post('/layanan/status', [LayananController::class, 'statusCheck'])->name('layanan.status.check');
Route::get('/informasi', [InformasiController::class, 'index'])->name('informasi');
Route::get('/berita/{news}', [InformasiController::class, 'show'])->name('berita.show');
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $request->validate([
        'login' => ['required'],
        'password' => ['required'],
    ]);

    if (Auth::attempt([
        'name' => $request->input('login'),
        'password' => $request->input('password'),
    ], $request->boolean('remember'))) {
        $request->session()->regenerate();

        if (Auth::user()->is_admin) {
            return redirect('/admin')->with('status', 'Login berhasil.');
        }

        return redirect()->intended('/')->with('status', 'Login berhasil.');
    }

    return back()->withErrors([
        'login' => 'Data tidak valid.',
    ])->onlyInput('login');
})->name('login.post');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('home');
})->name('logout');

Route::post('/kontak/kirim', [KontakController::class, 'kirim'])
    ->name('kontak.kirim');


    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
    Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('akun', [AccountController::class, 'edit'])->name('account.edit');
    Route::put('akun', [AccountController::class, 'update'])->name('account.update');
    Route::resource('statistics', StatisticController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('news', NewsItemController::class)->except('show');
    Route::patch('news/{news}/toggle-active', [NewsItemController::class, 'toggleActive'])->name('news.toggle-active');
    Route::resource('agenda', AgendaEventController::class)->except('show')->parameters(['agenda' => 'agendum']);
    Route::resource('gallery', GalleryItemController::class)->except('show');
    Route::patch('gallery/{gallery}/toggle-featured', [GalleryItemController::class, 'toggleFeatured'])->name('gallery.toggle-featured');
    Route::get('sambutan', [LeadershipController::class, 'edit'])->name('leadership.edit');
    Route::put('sambutan', [LeadershipController::class, 'update'])->name('leadership.update');
    Route::get('pengaturan', [SiteSettingController::class, 'edit'])->name('settings.edit');
    Route::put('pengaturan', [SiteSettingController::class, 'update'])->name('settings.update');
    Route::resource('gallery-categories', GalleryCategoryController::class)->except('show')->parameters(['gallery-categories' => 'galleryCategory']);

    Route::resource('timeline', TimelineItemController::class)->except('show');

    Route::resource('organization-members', OrganizationMemberController::class)
        ->except('show')
        ->parameters(['organization-members' => 'organizationMember']);

    Route::get('visi-misi', [VisionMissionController::class, 'edit'])->name('vision-mission.edit');
    Route::put('visi-misi', [VisionMissionController::class, 'update'])->name('vision-mission.update');

    Route::resource('core-values', CoreValueController::class)
        ->except('show')
        ->parameters(['core-values' => 'coreValue']);

    Route::resource('hero-slides', HeroSlideController::class)
        ->except('show')
        ->parameters(['hero-slides' => 'heroSlide']);

    Route::resource('profil-photos', ProfilPhotoController::class)
        ->except('show')
        ->parameters(['profil-photos' => 'profilPhoto']);

    Route::resource('services', ServiceController::class)->except('show');

    Route::get('layanan-ajukan-video', [StelaVideoController::class, 'edit'])->name('stela-video.edit');
    Route::put('layanan-ajukan-video', [StelaVideoController::class, 'update'])->name('stela-video.update');

    Route::get('banner/{page}', [PageBannerController::class, 'edit'])->name('page-banners.edit');
    Route::put('banner/{page}', [PageBannerController::class, 'update'])->name('page-banners.update');
    Route::delete('banner/{page}', [PageBannerController::class, 'destroy'])->name('page-banners.destroy');

    Route::resource('messages', ContactMessageController::class)
        ->only(['index', 'show', 'destroy']);

    Route::resource('layanan-pengajuan', ServiceRequestController::class)
        ->only(['index', 'show', 'update', 'destroy'])
        ->parameters(['layanan-pengajuan' => 'layananPengajuan']);
});