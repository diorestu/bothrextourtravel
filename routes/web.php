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

// Dynamic SEO XML Sitemap (with Google Image Sitemap Extension)
Route::get('/sitemap.xml', function() {
    $packages = \App\Models\TourPackage::where('is_active', true)->with('destination')->get();
    $destinations = \App\Models\Destination::where('is_active', true)->get();
    $baseUrl = config('app.url', url('/'));

    $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' . "\n";
    $xml .= '        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"' . "\n";
    $xml .= '        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' . "\n";
    $xml .= '        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd">' . "\n";

    // 1. Homepage
    $xml .= "  <url>\n";
    $xml .= "    <loc>" . htmlspecialchars($baseUrl, ENT_XML1, 'UTF-8') . "/</loc>\n";
    $xml .= "    <lastmod>" . date('Y-m-d\TH:i:sP') . "</lastmod>\n";
    $xml .= "    <changefreq>daily</changefreq>\n";
    $xml .= "    <priority>1.0</priority>\n";
    $xml .= "    <image:image>\n";
    $xml .= "      <image:loc>https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&amp;fit=crop&amp;w=1200&amp;q=80</image:loc>\n";
    $xml .= "      <image:title>Bothrex Bali Tour &amp; Travel - Paket Liburan Bali</image:title>\n";
    $xml .= "    </image:image>\n";
    $xml .= "  </url>\n";

    // 2. Packages Catalog Page
    $xml .= "  <url>\n";
    $xml .= "    <loc>" . htmlspecialchars($baseUrl, ENT_XML1, 'UTF-8') . "/paket</loc>\n";
    $xml .= "    <lastmod>" . date('Y-m-d\TH:i:sP') . "</lastmod>\n";
    $xml .= "    <changefreq>daily</changefreq>\n";
    $xml .= "    <priority>0.9</priority>\n";
    $xml .= "  </url>\n";

    // 3. Destinations Catalog Page
    $xml .= "  <url>\n";
    $xml .= "    <loc>" . htmlspecialchars($baseUrl, ENT_XML1, 'UTF-8') . "/destinasi</loc>\n";
    $xml .= "    <lastmod>" . date('Y-m-d\TH:i:sP') . "</lastmod>\n";
    $xml .= "    <changefreq>weekly</changefreq>\n";
    $xml .= "    <priority>0.9</priority>\n";
    $xml .= "  </url>\n";

    // 4. Individual Tour Packages
    foreach ($packages as $pkg) {
        $lastmod = $pkg->updated_at ? $pkg->updated_at->toAtomString() : date('Y-m-d\TH:i:sP');
        $xml .= "  <url>\n";
        $xml .= "    <loc>" . htmlspecialchars($baseUrl . '/paket/' . $pkg->slug, ENT_XML1, 'UTF-8') . "</loc>\n";
        $xml .= "    <lastmod>" . $lastmod . "</lastmod>\n";
        $xml .= "    <changefreq>weekly</changefreq>\n";
        $xml .= "    <priority>0.8</priority>\n";
        if (!empty($pkg->image_url)) {
            $xml .= "    <image:image>\n";
            $xml .= "      <image:loc>" . htmlspecialchars($pkg->image_url, ENT_XML1, 'UTF-8') . "</image:loc>\n";
            $xml .= "      <image:title>" . htmlspecialchars($pkg->title, ENT_XML1, 'UTF-8') . "</image:title>\n";
            $xml .= "      <image:caption>" . htmlspecialchars(Str::limit(strip_tags($pkg->description), 160), ENT_XML1, 'UTF-8') . "</image:caption>\n";
            $xml .= "    </image:image>\n";
        }
        $xml .= "  </url>\n";
    }

    // 5. Individual Destinations
    foreach ($destinations as $dest) {
        $lastmod = $dest->updated_at ? $dest->updated_at->toAtomString() : date('Y-m-d\TH:i:sP');
        $xml .= "  <url>\n";
        $xml .= "    <loc>" . htmlspecialchars($baseUrl . '/destinasi/' . $dest->slug, ENT_XML1, 'UTF-8') . "</loc>\n";
        $xml .= "    <lastmod>" . $lastmod . "</lastmod>\n";
        $xml .= "    <changefreq>weekly</changefreq>\n";
        $xml .= "    <priority>0.8</priority>\n";
        if (!empty($dest->image_url)) {
            $xml .= "    <image:image>\n";
            $xml .= "      <image:loc>" . htmlspecialchars($dest->image_url, ENT_XML1, 'UTF-8') . "</image:loc>\n";
            $xml .= "      <image:title>Wisata " . htmlspecialchars($dest->name, ENT_XML1, 'UTF-8') . "</image:title>\n";
            $xml .= "      <image:caption>" . htmlspecialchars(Str::limit(strip_tags($dest->description), 160), ENT_XML1, 'UTF-8') . "</image:caption>\n";
            $xml .= "    </image:image>\n";
        }
        $xml .= "  </url>\n";
    }

    $xml .= '</urlset>';

    return response($xml, 200, [
        'Content-Type' => 'application/xml; charset=utf-8',
        'X-Robots-Tag' => 'noindex',
    ]);
});

// Dynamic robots.txt
Route::get('/robots.txt', function() {
    $baseUrl = config('app.url', url('/'));
    $robots = "User-agent: *\n";
    $robots .= "Allow: /\n";
    $robots .= "Disallow: /admin/\n";
    $robots .= "Disallow: /livewire/\n\n";
    $robots .= "Sitemap: " . $baseUrl . "/sitemap.xml\n";

    return response($robots, 200, ['Content-Type' => 'text/plain; charset=utf-8']);
});

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
