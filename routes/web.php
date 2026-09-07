<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\HomePage;
use App\Livewire\TourPackagesPage;
use App\Livewire\TourPackageDetailPage;
use App\Livewire\DestinationsPage;
use App\Livewire\DestinationDetailPage;
use App\Livewire\Admin\LoginPage;
use App\Livewire\Admin\BookingsPage;
use App\Livewire\Admin\PackagesManagementPage;
use App\Livewire\Admin\DestinationsManagementPage;
use App\Livewire\Admin\CompanySettingsPage;

// Public Routes
Route::get('/', HomePage::class)->name('home');
Route::get('/paket', TourPackagesPage::class)->name('packages.index');
Route::get('/paket/{slug}', TourPackageDetailPage::class)->name('packages.show');
Route::get('/destinasi', DestinationsPage::class)->name('destinations.index');
Route::get('/destinasi/{slug}', DestinationDetailPage::class)->name('destinations.show');

use App\Http\Controllers\SitemapController;

// Dynamic SEO XML Sitemap, Text Sitemap & robots.txt
Route::get('/sitemap.xml', [SitemapController::class, 'sitemap'])->name('sitemap');
Route::get('/sitemap.txt', [SitemapController::class, 'sitemapTxt'])->name('sitemap.txt');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

// Admin Guest Route
Route::get('/admin/login', LoginPage::class)->name('admin.login');

use App\Livewire\Admin\AttractionsManagementPage;

// Admin Protected Routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/bookings', BookingsPage::class)->name('admin.bookings');
    Route::get('/packages', PackagesManagementPage::class)->name('admin.packages');
    Route::get('/destinations', DestinationsManagementPage::class)->name('admin.destinations');
    Route::get('/attractions', AttractionsManagementPage::class)->name('admin.attractions');
    Route::get('/company', CompanySettingsPage::class)->name('admin.company');

    Route::post('/logout', function() {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('admin.login');
    })->name('admin.logout');
});
