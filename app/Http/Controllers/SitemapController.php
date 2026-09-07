<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourPackage;
use App\Models\Destination;
use XMLWriter;

class SitemapController extends Controller
{
    /**
     * Generate 100% standard Google-compliant XML Sitemap (Sitemaps 0.9 standard).
     */
    public function sitemap(Request $request)
    {
        // Detect domain dynamically or use official production domain
        $baseUrl = 'https://bothrextourtravel.my.id';
        if ($request->getHost() && !str_contains($request->getHost(), 'localhost') && !str_contains($request->getHost(), '127.0.0.1')) {
            $baseUrl = rtrim($request->getSchemeAndHttpHost(), '/');
        }

        $packages = TourPackage::where('is_active', true)->orderBy('is_featured', 'desc')->get();
        $destinations = Destination::where('is_active', true)->get();
        $today = date('Y-m-d');

        $writer = new XMLWriter();
        $writer->openMemory();
        $writer->startDocument('1.0', 'UTF-8');
        $writer->setIndent(true);
        $writer->setIndentString('  ');

        // Standard Sitemaps 0.9 Root Element (Most compatible with Google Search Console)
        $writer->startElement('urlset');
        $writer->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        // 1. Homepage
        $writer->startElement('url');
        $writer->writeElement('loc', $baseUrl . '/');
        $writer->writeElement('lastmod', $today);
        $writer->writeElement('changefreq', 'daily');
        $writer->writeElement('priority', '1.0');
        $writer->endElement(); // url

        // 2. Packages Catalog Page
        $writer->startElement('url');
        $writer->writeElement('loc', $baseUrl . '/paket');
        $writer->writeElement('lastmod', $today);
        $writer->writeElement('changefreq', 'daily');
        $writer->writeElement('priority', '0.9');
        $writer->endElement(); // url

        // 3. Destinations Catalog Page
        $writer->startElement('url');
        $writer->writeElement('loc', $baseUrl . '/destinasi');
        $writer->writeElement('lastmod', $today);
        $writer->writeElement('changefreq', 'weekly');
        $writer->writeElement('priority', '0.9');
        $writer->endElement(); // url

        // 4. Active Tour Packages
        foreach ($packages as $pkg) {
            $lastmod = $pkg->updated_at ? $pkg->updated_at->format('Y-m-d') : $today;

            $writer->startElement('url');
            $writer->writeElement('loc', $baseUrl . '/paket/' . $pkg->slug);
            $writer->writeElement('lastmod', $lastmod);
            $writer->writeElement('changefreq', 'weekly');
            $writer->writeElement('priority', '0.8');
            $writer->endElement(); // url
        }

        // 5. Active Destinations
        foreach ($destinations as $dest) {
            $lastmod = $dest->updated_at ? $dest->updated_at->format('Y-m-d') : $today;

            $writer->startElement('url');
            $writer->writeElement('loc', $baseUrl . '/destinasi/' . $dest->slug);
            $writer->writeElement('lastmod', $lastmod);
            $writer->writeElement('changefreq', 'weekly');
            $writer->writeElement('priority', '0.8');
            $writer->endElement(); // url
        }

        $writer->endElement(); // urlset
        $writer->endDocument();

        $xmlContent = $writer->outputMemory();

        // Write physical file to public/sitemap.xml for webservers (Nginx / Apache)
        @file_put_contents(public_path('sitemap.xml'), $xmlContent);

        return response($xmlContent, 200, [
            'Content-Type' => 'text/xml; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    /**
     * Generate standard robots.txt.
     */
    public function robots(Request $request)
    {
        $baseUrl = 'https://bothrextourtravel.my.id';
        if ($request->getHost() && !str_contains($request->getHost(), 'localhost') && !str_contains($request->getHost(), '127.0.0.1')) {
            $baseUrl = rtrim($request->getSchemeAndHttpHost(), '/');
        }

        $robots = "User-agent: *\n";
        $robots .= "Allow: /\n";
        $robots .= "Disallow: /admin/\n";
        $robots .= "Disallow: /livewire/\n\n";
        $robots .= "Sitemap: " . $baseUrl . "/sitemap.xml\n";

        @file_put_contents(public_path('robots.txt'), $robots);

        return response($robots, 200, [
            'Content-Type' => 'text/plain; charset=utf-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }
}
