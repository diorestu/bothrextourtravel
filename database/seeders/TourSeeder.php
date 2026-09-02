<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\TourPackage;
use App\Models\AttractionCategory;
use App\Models\Attraction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Attraction Categories
        $categoriesData = [
            [
                'name' => 'Pantai & Pulau',
                'slug' => 'pantai-pulau',
                'icon' => 'fa-umbrella-beach',
                'description' => 'Wisata pantai pasir putih, tebing laut ikonik, dan keindahan pesisir Bali.',
            ],
            [
                'name' => 'Budaya & Pura',
                'slug' => 'budaya-pura',
                'icon' => 'fa-gopuram',
                'description' => 'Pura bersejarah, arsitektur megah, pertunjukan seni tari lokal, dan kebudayaan Bali.',
            ],
            [
                'name' => 'Gunung & Nature',
                'slug' => 'gunung-nature',
                'icon' => 'fa-mountain',
                'description' => 'Dataran tinggi sejuk, pemandangan Gunung Batur, dan keindahan alam pegunungan.',
            ],
            [
                'name' => 'Bahari & Water Sports',
                'slug' => 'bahari-water-sports',
                'icon' => 'fa-water',
                'description' => 'Olahraga air, snorkeling Manta Ray, jet ski, parasailing, dan wahana laut.',
            ],
            [
                'name' => 'Air Terjun & Sawah',
                'slug' => 'air-terjun-sawah',
                'icon' => 'fa-water-fall',
                'description' => 'Wisata terasering sawah hijau Ubud, air terjun alami, dan spot foto swing.',
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[$cat['slug']] = AttractionCategory::firstOrCreate(['slug' => $cat['slug']], $cat);
        }

        // 2. Create Destinations
        $destinations = [
            [
                'name' => 'Nusa Penida',
                'slug' => 'nusa-penida',
                'category' => 'Pantai & Pulau Exotis',
                'location' => 'Klungkung, Bali',
                'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Pulau eksotis di tenggara Bali yang terkenal dengan tebing Kelingking Beach berbentuk T-Rex, Diamond Beach dengan tangga batu ikonik, dan spot snorkeling Manta Ray.',
                'highlights' => ['Kelingking Beach', 'Diamond Beach', 'Broken Beach', 'Angel Billabong', 'Snorkeling Manta Point'],
                'is_popular' => true,
            ],
            [
                'name' => 'Ubud & Gianyar',
                'slug' => 'ubud-gianyar',
                'category' => 'Budaya & Seni',
                'location' => 'Gianyar, Bali',
                'image_url' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Pusat kebudayaan, seni, dan ketenangan jiwa di Bali. Nikmati pemandangan Tegalalang Rice Terrace, Monkey Forest, air terjun Tegallalang, dan tradisi lokal Bali yang kental.',
                'highlights' => ['Tegalalang Rice Terrace', 'Sacred Monkey Forest', 'Alas Harum Swing', 'Tegenungan Waterfall', 'Ubud Art Market'],
                'is_popular' => true,
            ],
            [
                'name' => 'Kintamani & Mount Batur',
                'slug' => 'kintamani-batur',
                'category' => 'Gunung & Danau',
                'location' => 'Bangli, Bali',
                'image_url' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Dataran tinggi bersuhu sejuk dengan pemandangan magis Gunung Batur yang masih aktif dan Danau Batur. Sangat populer untuk Jeep Sunrise Tour dan kafe estetik.',
                'highlights' => ['Gunung Batur Sunrise Jeep', 'Danau Batur', 'Pura Ulun Danu Batur', 'Coffee Plantation & Tasting', 'Kintamani View Cafe'],
                'is_popular' => true,
            ],
            [
                'name' => 'Bedugul & Tanah Lot',
                'slug' => 'bedugul-tanah-lot',
                'category' => 'Pura & Danau',
                'location' => 'Tabanan, Bali',
                'image_url' => 'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Kombinasi ikonik antara Pura Ulun Danu Beratan yang terapung di atas danau dan keindahan matahari terbenam Pura Tanah Lot di atas karang laut.',
                'highlights' => ['Pura Ulun Danu Beratan', 'Pura Tanah Lot Sunset', 'Handara Gate Bali', 'Kebun Raya Bedugul', 'Wanagiri Hidden Hills'],
                'is_popular' => true,
            ],
            [
                'name' => 'Uluwatu & Bali Selatan',
                'slug' => 'uluwatu-bali-selatan',
                'category' => 'Pantai & Sunset',
                'location' => 'Badung, Bali',
                'image_url' => 'https://images.unsplash.com/photo-1577717903315-1691ae25ab3f?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Kawasan pantai berpasir putih spektakuler (Melasti, Pandawa, Padang-Padang), tebing dramatis Uluwatu, pertunjukan Tari Kecak sunset, dan santap malam seafood Jimbaran.',
                'highlights' => ['Pura Luhur Uluwatu', 'Pertunjukan Tari Kecak', 'Pantai Melasti', 'Pantai Padang Padang', 'Dinner Seafood Jimbaran'],
                'is_popular' => true,
            ],
            [
                'name' => 'Tanjung Benoa & Water Sports',
                'slug' => 'tanjung-benoa',
                'category' => 'Bahari & Adventure',
                'location' => 'Nusa Dua, Bali',
                'image_url' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Pusat wisata olahraga air paling populer di Bali. Rasakan sensasi Banana Boat, Parasailing, Jet Ski, hingga kunjungan ke Pulau Penyu (Turtle Island).',
                'highlights' => ['Parasailing Single & Tandem', 'Banana Boat & Jet Ski', 'Sea Walker', 'Pulau Penyu Conservation', 'Waterblow Nusa Dua'],
                'is_popular' => false,
            ],
        ];

        foreach ($destinations as $destData) {
            $dest = Destination::updateOrCreate(['slug' => $destData['slug']], $destData);

            // Seed Attractions for this Destination
            if ($dest->slug === 'nusa-penida') {
                Attraction::updateOrCreate(['slug' => 'kelingking-beach'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['pantai-pulau']->id,
                    'name' => 'Kelingking Beach',
                    'slug' => 'kelingking-beach',
                    'location' => 'Nusa Penida, Klungkung',
                    'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Tebing karang hijau unik yang menyerupai bentuk dinosaurus T-Rex di tepian laut biru Nusa Penida.',
                    'ticket_price_info' => 'Termasuk dalam paket tour',
                ]);
                Attraction::updateOrCreate(['slug' => 'diamond-beach'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['pantai-pulau']->id,
                    'name' => 'Diamond Beach',
                    'slug' => 'diamond-beach',
                    'location' => 'Nusa Penida Timur',
                    'image_url' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Pantai berpasir putih berkilauan dengan tangga batu terukir di dinding tebing karang.',
                    'ticket_price_info' => 'Termasuk dalam paket tour',
                ]);

                // Tour Packages (Flexible Itinerary without times)
                TourPackage::updateOrCreate(['slug' => 'one-day-tour-nusa-penida-barat'], [
                    'destination_id' => $dest->id,
                    'title' => 'One Day Tour Nusa Penida Barat (West Island)',
                    'slug' => 'one-day-tour-nusa-penida-barat',
                    'category' => 'Full Day Tour',
                    'duration' => 'Full Day (Waktu Fleksibel)',
                    'price' => 450000,
                    'original_price' => 650000,
                    'badge' => 'Paling Laris 🏆',
                    'rating' => 4.9,
                    'review_count' => 342,
                    'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
                    'gallery' => [
                        'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
                        'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1200&q=80',
                    ],
                    'description' => 'Nikmati keindahan keajaiban alam Nusa Penida Barat dengan waktu fleksibel! Layanan kendaraan privat, supir ramah, dan penjemputan hotel langsung.',
                    'itinerary' => [
                        ['title' => 'Penjemputan Hotel & Fastboat', 'description' => 'Driver privat menjemput Anda di hotel (Kuta, Seminyak, Ubud, Sanur) menuju Pelabuhan Fastboat.'],
                        ['title' => 'Eksplorasi Kelingking Beach (T-Rex Cliff)', 'description' => 'Kunjungan santai ke spot tebing T-Rex nan megah tanpa terburu-buru jam.'],
                        ['title' => 'Broken Beach & Angel Billabong', 'description' => 'Menyaksikan lubang karang raksasa dan kolam renang alami air laut transparan.'],
                        ['title' => 'Makan Siang Resto & Bersantai di Crystal Bay', 'description' => 'Santap makan siang lezat dan bersantai di tepi pantai Crystal Bay.'],
                        ['title' => 'Pengantaran Kembali ke Hotel', 'description' => 'Perjalanan penyeberangan kembali ke Bali dan pengantaran nyaman ke hotel tempat menginap.'],
                    ],
                    'inclusions' => [
                        'Penjemputan & Pengantaran Hotel (Mobil AC Private)',
                        'Tiket PP Fastboat Sanur - Nusa Penida',
                        'Mobil Privat AC + Driver Lokal Nusa Penida + BBM',
                        'Tiket Masuk Semua Objek Wisata',
                        'Makan Siang di Restoran Lokal',
                        'Air Mineral Selama Tour',
                    ],
                    'exclusions' => [
                        'Pengeluaran Pribadi',
                        'Tip Supir/Guide (Sukarela)',
                        'Retribusi Pemda Nusa Penida (Rp 25.000/orang)',
                    ],
                    'is_featured' => true,
                    'is_active' => true,
                ]);
            }

            if ($dest->slug === 'ubud-gianyar') {
                Attraction::updateOrCreate(['slug' => 'tegalalang-rice-terrace'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['air-terjun-sawah']->id,
                    'name' => 'Tegalalang Rice Terrace & Swing',
                    'slug' => 'tegalalang-rice-terrace',
                    'location' => 'Ubud, Gianyar',
                    'image_url' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Terasering sawah bertingkat yang membentang hijau nan asri dengan wahana ayunan Alas Harum.',
                    'ticket_price_info' => 'Termasuk dalam paket tour',
                ]);

                TourPackage::updateOrCreate(['slug' => 'full-day-ubud-culture-swing-waterfall'], [
                    'destination_id' => $dest->id,
                    'title' => 'Full Day Ubud Culture, Swing & Waterfall Highlights',
                    'slug' => 'full-day-ubud-culture-swing-waterfall',
                    'category' => 'Culture & Nature',
                    'duration' => 'Full Day (Waktu Fleksibel)',
                    'price' => 400000,
                    'original_price' => 550000,
                    'badge' => 'Pilihan Favorit ❤️',
                    'rating' => 4.88,
                    'review_count' => 195,
                    'image_url' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=1200&q=80',
                    'gallery' => [
                        'https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=1200&q=80',
                    ],
                    'description' => 'Jelajahi jantung seni dan kebudayaan Bali di Ubud. Waktu tur fleksibel sesuai keinginan Anda.',
                    'itinerary' => [
                        ['title' => 'Penjemputan di Hotel / Villa', 'description' => 'Driver pribadi siap menjemput di lobi hotel Anda dengan mobil AC yang bersih.'],
                        ['title' => 'Tegalalang Rice Terrace & Ayunan Alas Harum', 'description' => 'Jalan-jalan santai di hamparan sawah hijau bertingkat dan foto di ayunan viral.'],
                        ['title' => 'Sacred Monkey Forest Sanctuary', 'description' => 'Berjalan di bawah rindangnya hutan lindung ditemani kera-kera jinak Ubud.'],
                        ['title' => 'Makan Siang & Tegallalang Waterfall', 'description' => 'Istirahat makan siang khas Bebek Tepi Sawah dan kesegaran air terjun.'],
                        ['title' => 'Pengantaran Kembali ke Hotel', 'description' => 'Pengantaran kembali ke villa / hotel dengan aman dan nyaman.'],
                    ],
                    'inclusions' => [
                        'Penjemputan & Pengantaran Hotel (Mobil AC Private)',
                        'Supir Pribadi Berpengalaman + BBM',
                        'Tiket Masuk Objek Wisata Ubud',
                        'Air Mineral',
                    ],
                    'exclusions' => ['Pengeluaran Pribadi', 'Makan Siang (Optional)'],
                    'is_featured' => true,
                    'is_active' => true,
                ]);
            }

            if ($dest->slug === 'kintamani-batur') {
                TourPackage::updateOrCreate(['slug' => 'package-mt-batur-sunrise-4wd-jeep-kintamani'], [
                    'destination_id' => $dest->id,
                    'title' => 'Package Mt. Batur Sunrise 4WD Jeep Tour & Kintamani Cafe',
                    'slug' => 'package-mt-batur-sunrise-4wd-jeep-kintamani',
                    'category' => 'Jeep & Sunrise Tour',
                    'duration' => 'Half Day / Fleksibel',
                    'price' => 500000,
                    'original_price' => 700000,
                    'badge' => 'Viral TikTok 🔥',
                    'rating' => 4.98,
                    'review_count' => 412,
                    'image_url' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1200&q=80',
                    'gallery' => ['https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1200&q=80'],
                    'description' => 'Rasakan pengalaman spektakuler menaiki Mobil Jeep 4WD Klasik menyaksikan matahari terbit Gunung Batur & lautan pasir hitam (Black Lava).',
                    'itinerary' => [
                        ['title' => 'Penjemputan Dini Hari dari Hotel', 'description' => 'Driver privat menjemput di hotel menuju basecamp Jeep Kintamani.'],
                        ['title' => 'Petualangan 4WD Jeep Sunrise Gunung Batur', 'description' => 'Menikmati keindahan sunrise dan lautan awan dari ketinggian Batur.'],
                        ['title' => 'Eksplorasi Black Lava & Black Sand Batur', 'description' => 'Sesi foto estetis dengan Jeep di hamparan batu & pasir hitam bekas erupsi.'],
                        ['title' => 'Relaxing di Kintamani View Cafe & Pengantaran Hotel', 'description' => 'Sarapan & ngopi cantik berlatar Danau Batur, dilanjutkan pengantaran kembali ke hotel.'],
                    ],
                    'inclusions' => [
                        'Penjemputan & Pengantaran Hotel (Private Car)',
                        'Sewa Mobil Jeep 4WD + Driver Professional Jeep',
                        'Tiket Masuk Kawasan Kintamani',
                        'Dokumentasi Foto di Atas Jeep',
                    ],
                    'exclusions' => ['Pengeluaran Pribadi'],
                    'is_featured' => true,
                    'is_active' => true,
                ]);
            }

            if ($dest->slug === 'bedugul-tanah-lot') {
                TourPackage::updateOrCreate(['slug' => 'bedugul-floating-temple-handara-tanah-lot'], [
                    'destination_id' => $dest->id,
                    'title' => 'Bedugul Floating Temple, Handara Gate & Tanah Lot Sunset Tour',
                    'slug' => 'bedugul-floating-temple-handara-tanah-lot',
                    'category' => 'Sunset & Landmark Tour',
                    'duration' => 'Full Day (Waktu Fleksibel)',
                    'price' => 425000,
                    'original_price' => 600000,
                    'badge' => 'Iconic Bali 📸',
                    'rating' => 4.85,
                    'review_count' => 164,
                    'image_url' => 'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=1200&q=80',
                    'gallery' => ['https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=1200&q=80'],
                    'description' => 'Perjalanan menyejukkan ke pura terapung Danau Beratan, gerbang ikonik Handara Gate, dan penutupan sunset Pura Tanah Lot.',
                    'itinerary' => [
                        ['title' => 'Penjemputan di Hotel / Villa', 'description' => 'Driver privat siap di hotel Anda untuk memulai perjalanan ke Bali Tengah.'],
                        ['title' => 'Pura Ulun Danu Beratan Bedugul', 'description' => 'Mengunjungi pura terapung legendaris yang berada di tepi Danau Beratan.'],
                        ['title' => 'Handara Icon Gate Bali', 'description' => 'Sesi foto di gerbang batu megah berlatar belakang bukit hijau sejuk.'],
                        ['title' => 'Sunset Spektakuler Pura Tanah Lot', 'description' => 'Menikmati detik-detik matahari terbenam dengan pemandangan pura karang laut.'],
                        ['title' => 'Pengantaran Kembali ke Hotel', 'description' => 'Diantar kembali ke hotel menginap dengan aman.'],
                    ],
                    'inclusions' => [
                        'Penjemputan & Pengantaran Hotel (Private Mobil AC)',
                        'Supir Ramah + BBM',
                        'Tiket Masuk Semua Pura & Objek Wisata',
                    ],
                    'exclusions' => ['Pengeluaran Pribadi'],
                    'is_featured' => true,
                    'is_active' => true,
                ]);
            }

            if ($dest->slug === 'uluwatu-bali-selatan') {
                TourPackage::updateOrCreate(['slug' => 'exotic-south-bali-beach-uluwatu-kecak-jimbaran'], [
                    'destination_id' => $dest->id,
                    'title' => 'Exotic South Bali Beach, Uluwatu Kecak Dance & Jimbaran Seafood Dinner',
                    'slug' => 'exotic-south-bali-beach-uluwatu-kecak-jimbaran',
                    'category' => 'Beach & Sunset Tour',
                    'duration' => 'Full Day (Waktu Fleksibel)',
                    'price' => 475000,
                    'original_price' => 650000,
                    'badge' => 'Best Seller 🔥',
                    'rating' => 4.92,
                    'review_count' => 289,
                    'image_url' => 'https://images.unsplash.com/photo-1577717903315-1691ae25ab3f?auto=format&fit=crop&w=1200&q=80',
                    'gallery' => ['https://images.unsplash.com/photo-1577717903315-1691ae25ab3f?auto=format&fit=crop&w=1200&q=80'],
                    'description' => 'Jelajahi deretan pantai cantik pasir putih Melasti/Padang-Padang, menonton Tari Kecak sunset di Pura Uluwatu, dan dinner seafood Jimbaran.',
                    'itinerary' => [
                        ['title' => 'Penjemputan Hotel Privat', 'description' => 'Driver privat menjemput di lobi hotel Anda.'],
                        ['title' => 'Wisata Pantai Pasir Putih (Melasti / Padang-Padang)', 'description' => 'Bersantai & berfoto di pantai berpasir halus yang diapit tebing kapur meliuk.'],
                        ['title' => 'Pertunjukan Tari Kecak Sunset Pura Uluwatu', 'description' => 'Nonton tarian magis Bali di atas tebing samudera berlatar matahari terbenam.'],
                        ['title' => 'Romantic Seafood Dinner Pantai Jimbaran & Pengantaran Hotel', 'description' => 'Makan malam romantis hidangan laut di pinggir pantai Jimbaran lalu diantar kembali ke hotel.'],
                    ],
                    'inclusions' => [
                        'Penjemputan & Pengantaran Hotel (Private Car)',
                        'Driver Lokal + BBM',
                        'Tiket Masuk Pantai & Pura Uluwatu',
                        'Tiket Nonton Tari Kecak Uluwatu',
                    ],
                    'exclusions' => ['Dinner Seafood Jimbaran (Ala carte / Paket pilihan)', 'Pengeluaran Pribadi'],
                    'is_featured' => true,
                    'is_active' => true,
                ]);
            }
        }
    }
}
