<?php

use App\Http\Controllers\Api\GaleriController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\InformasiController;
use App\Http\Controllers\Api\KontakController;
use App\Http\Controllers\Api\LayananController;
use App\Http\Controllers\Api\ProfilController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.')->group(function () {
    Route::get('/hero-slides', [HomeController::class, 'heroSlides'])->name('hero-slides');
    Route::get('/profil-photos', [HomeController::class, 'profilPhotos'])->name('profil-photos');
    Route::get('/statistics', [HomeController::class, 'statistics'])->name('statistics');
    Route::get('/page-banners/{page}', [HomeController::class, 'pageBanner'])->name('page-banners.show');

    Route::get('/profil/leadership', [ProfilController::class, 'leadership'])->name('profil.leadership');
    Route::get('/profil/organization-members', [ProfilController::class, 'organizationMembers'])->name('profil.organization-members');
    Route::get('/profil/vision-mission', [ProfilController::class, 'visionMission'])->name('profil.vision-mission');
    Route::get('/profil/core-values', [ProfilController::class, 'coreValues'])->name('profil.core-values');
    Route::get('/profil/timeline', [ProfilController::class, 'timeline'])->name('profil.timeline');

    Route::get('/services', [LayananController::class, 'index'])->name('services.index');
    Route::post('/services/requests', [LayananController::class, 'store'])->name('services.requests.store');
    Route::get('/services/status', [LayananController::class, 'status'])->name('services.status');

    Route::get('/news', [InformasiController::class, 'news'])->name('news.index');
    Route::get('/news/{news}', [InformasiController::class, 'newsShow'])->name('news.show');
    Route::get('/agenda', [InformasiController::class, 'agenda'])->name('agenda.index');
    Route::get('/agenda/{agendum}', [InformasiController::class, 'agendaShow'])->name('agenda.show');

    Route::get('/gallery', [GaleriController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/categories', [GaleriController::class, 'categories'])->name('gallery.categories');

    Route::get('/settings', [KontakController::class, 'settings'])->name('settings');
    Route::post('/contact', [KontakController::class, 'store'])->name('contact.store');
});
