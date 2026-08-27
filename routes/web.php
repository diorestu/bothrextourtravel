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

// Dynamic SEO XML Sitemap
Route::get('/sitemap.xml', function() {
    $packages = \App\Models\TourPackage::where('is_active', true)->get();
    $destinations = \App\Models\Destination::where('is_active', true)->get();

    $xml = '<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

    // Home
    $xml .= '<url><loc>' . url('/') . '</loc><changefreq>daily</changefreq><priority>1.0</priority></url>';

    // Packages Index
    $xml .= '<url><loc>' . url('/paket') . '</loc><changefreq>daily</changefreq><priority>0.9</priority></url>';

    // Destinations Index
    $xml .= '<url><loc>' . url('/destinasi') . '</loc><changefreq>weekly</changefreq><priority>0.8</priority></url>';

    // Individual Tour Packages
    foreach ($packages as $pkg) {
        $xml .= '<url><loc>' . url('/paket/' . $pkg->slug) . '</loc><lastmod>' . $pkg->updated_at->toAtomString() . '</lastmod><changefreq>weekly</changefreq><priority>0.8</priority></url>';
    }

    // Individual Destinations
    foreach ($destinations as $dest) {
        $xml .= '<url><loc>' . url('/destinasi/' . $dest->slug) . '</loc><lastmod>' . $dest->updated_at->toAtomString() . '</lastmod><changefreq>weekly</changefreq><priority>0.7</priority></url>';
    }

    $xml .= '</urlset>';

    return response($xml, 200, ['Content-Type' => 'application/xml']);
});

// Dynamic robots.txt
Route::get('/robots.txt', function() {
    $robots = "User-agent: *\n";
    $robots .= "Allow: /\n";
    $robots .= "Disallow: /admin/\n\n";
    $robots .= "Sitemap: " . url('/sitemap.xml') . "\n";

    return response($robots, 200, ['Content-Type' => 'text/plain']);
});

// Admin Guest Route
Route::get('/admin/login', LoginPage::class)->name('admin.login');

// Admin Protected Routes
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/bookings', BookingsPage::class)->name('admin.bookings');
    Route::get('/packages', PackagesManagementPage::class)->name('admin.packages');
    Route::get('/destinations', DestinationsManagementPage::class)->name('admin.destinations');
    Route::get('/company', CompanySettingsPage::class)->name('admin.company');

    Route::post('/logout', function() {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('admin.login');
    })->name('admin.logout');
});
