<?php

use App\Livewire\Admin\ArticlesManagementPage;
use App\Livewire\Admin\AttractionsManagementPage;
use App\Livewire\Admin\BookingsPage;
use App\Livewire\Admin\CompanySettingsPage;
use App\Livewire\Admin\DestinationsManagementPage;
use App\Livewire\Admin\LoginPage;
use App\Livewire\Admin\PackagesManagementPage;
use App\Livewire\BlogDetailPage;
use App\Livewire\BlogPage;
use App\Livewire\DestinationDetailPage;
use App\Livewire\DestinationsPage;
use App\Livewire\HomePage;
use App\Livewire\TourPackageDetailPage;
use App\Livewire\TourPackagesPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', HomePage::class)->name('home');
Route::get('/paket', TourPackagesPage::class)->name('packages.index');
Route::get('/paket/{slug}', TourPackageDetailPage::class)->name('packages.show');
Route::get('/destinasi', DestinationsPage::class)->name('destinations.index');
Route::get('/destinasi/{slug}', DestinationDetailPage::class)->name('destinations.show');
Route::get('/blog', BlogPage::class)->name('blog.index');
Route::get('/blog/{slug}', BlogDetailPage::class)->name('blog.show');
Route::redirect('/artikel', '/blog');

use App\Http\Controllers\SitemapController;

// Dynamic SEO XML Sitemap, Text Sitemap & robots.txt
Route::get('/sitemap.xml', [SitemapController::class, 'sitemap'])->name('sitemap');
Route::get('/sitemap.txt', [SitemapController::class, 'sitemapTxt'])->name('sitemap.txt');
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');

// Admin Guest Route
Route::get('/admin/login', LoginPage::class)->name('admin.login');
Route::get('/login', fn () => redirect()->route('admin.login'))->name('login');

// Admin Protected Routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/bookings', BookingsPage::class)->name('admin.bookings');
    Route::get('/packages', PackagesManagementPage::class)->name('admin.packages');
    Route::get('/destinations', DestinationsManagementPage::class)->name('admin.destinations');
    Route::get('/attractions', AttractionsManagementPage::class)->name('admin.attractions');
    Route::get('/articles', ArticlesManagementPage::class)->name('admin.articles');
    Route::get('/company', CompanySettingsPage::class)->name('admin.company');

    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('admin.login');
    })->name('admin.logout');
});
