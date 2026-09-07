<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TourPackage;
use App\Models\Destination;
use XMLWriter;
use Illuminate\Support\Str;

class SitemapController extends Controller
{
    /**
     * Generate standard, 100% compliant Google XML Sitemap.
     */
    public function sitemap(Request $request)
    {
        // Dynamic domain detection (ensures exact domain matching in Google Search Console)
        $baseUrl = rtrim($request->getSchemeAndHttpHost(), '/');
        if (empty($baseUrl) || str_contains($baseUrl, 'localhost')) {
            $baseUrl = rtrim(config('app.url') ?: url('/'), '/');
        }

        $packages = TourPackage::where('is_active', true)->with('destination')->get();
        $destinations = Destination::where('is_active', true)->get();

        $writer = new XMLWriter();
        $writer->openMemory();
        $writer->startDocument('1.0', 'UTF-8');
        $writer->setIndent(true);
        $writer->setIndentString('  ');

        // Root urlset element
        $writer->startElement('urlset');
        $writer->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $writer->writeAttribute('xmlns:image', 'http://www.google.com/schemas/sitemap-image/1.1');

        // 1. Homepage
        $writer->startElement('url');
        $writer->writeElement('loc', $baseUrl . '/');
        $writer->writeElement('lastmod', date('c'));
        $writer->writeElement('changefreq', 'daily');
        $writer->writeElement('priority', '1.0');

        // Homepage Image
        $writer->startElement('image:image');
        $writer->writeElement('image:loc', $baseUrl . '/images/logo.png');
        $writer->writeElement('image:title', 'Bothrex Bali Tour & Travel');
        $writer->endElement(); // image:image
        $writer->endElement(); // url

        // 2. Tour Packages Catalog Page
        $writer->startElement('url');
        $writer->writeElement('loc', $baseUrl . '/paket');
        $writer->writeElement('lastmod', date('c'));
        $writer->writeElement('changefreq', 'daily');
        $writer->writeElement('priority', '0.9');
        $writer->endElement(); // url

        // 3. Destinations Catalog Page
        $writer->startElement('url');
        $writer->writeElement('loc', $baseUrl . '/destinasi');
        $writer->writeElement('lastmod', date('c'));
        $writer->writeElement('changefreq', 'weekly');
        $writer->writeElement('priority', '0.9');
        $writer->endElement(); // url

        // 4. Tour Package Detail Pages
        foreach ($packages as $pkg) {
            $lastmod = $pkg->updated_at ? $pkg->updated_at->toAtomString() : date('c');

            $writer->startElement('url');
            $writer->writeElement('loc', $baseUrl . '/paket/' . $pkg->slug);
            $writer->writeElement('lastmod', $lastmod);
            $writer->writeElement('changefreq', 'weekly');
            $writer->writeElement('priority', '0.8');

            if (!empty($pkg->image_url)) {
                $writer->startElement('image:image');
                $writer->writeElement('image:loc', $pkg->image_url);
                $writer->writeElement('image:title', $pkg->title);
                $writer->endElement();
            }

            if (!empty($pkg->gallery) && is_array($pkg->gallery)) {
                foreach ($pkg->gallery as $galImg) {
                    if ($galImg !== $pkg->image_url) {
                        $writer->startElement('image:image');
                        $writer->writeElement('image:loc', $galImg);
                        $writer->writeElement('image:title', $pkg->title . ' - Foto Galeri');
                        $writer->endElement();
                    }
                }
            }

            $writer->endElement(); // url
        }

        // 5. Destination Detail Pages
        foreach ($destinations as $dest) {
            $lastmod = $dest->updated_at ? $dest->updated_at->toAtomString() : date('c');

            $writer->startElement('url');
            $writer->writeElement('loc', $baseUrl . '/destinasi/' . $dest->slug);
            $writer->writeElement('lastmod', $lastmod);
            $writer->writeElement('changefreq', 'weekly');
            $writer->writeElement('priority', '0.8');

            if (!empty($dest->image_url)) {
                $writer->startElement('image:image');
                $writer->writeElement('image:loc', $dest->image_url);
                $writer->writeElement('image:title', 'Wisata ' . $dest->name);
                $writer->endElement();
            }

            $writer->endElement(); // url
        }

        $writer->endElement(); // urlset
        $writer->endDocument();

        $xmlContent = $writer->outputMemory();

        // Also save physical static sitemap.xml in public/ for web servers (Nginx/Apache) direct serving
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
        $baseUrl = rtrim($request->getSchemeAndHttpHost(), '/');
        if (empty($baseUrl) || str_contains($baseUrl, 'localhost')) {
            $baseUrl = rtrim(config('app.url') ?: url('/'), '/');
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
