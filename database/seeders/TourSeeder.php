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
                'name' => 'Budaya & Pura',
                'slug' => 'budaya-pura',
                'icon' => 'fa-gopuram',
                'description' => 'Pura bersejarah, arsitektur megah, desa adat tradisi, dan warisan kebudayaan Bali.',
            ],
            [
                'name' => 'Pantai & Sunset',
                'slug' => 'pantai-sunset',
                'icon' => 'fa-umbrella-beach',
                'description' => 'Pantai pasir putih, tebing karang eksotis, dan panorama matahari terbenam spektakuler.',
            ],
            [
                'name' => 'Gunung & Alam Sejuk',
                'slug' => 'gunung-alam-sejuk',
                'icon' => 'fa-mountain',
                'description' => 'Dataran tinggi sejuk, panorama kaldera Gunung Batur, danau alami, serta agrowisata.',
            ],
            [
                'name' => 'Bahari & Watersport',
                'slug' => 'bahari-watersport',
                'icon' => 'fa-water',
                'description' => 'Aktivitas olahraga air seru: snorkeling, diving, sea walker, parasailing, dan jet ski.',
            ],
            [
                'name' => 'Alam, Air Terjun & Sawah',
                'slug' => 'alam-air-terjun-sawah',
                'icon' => 'fa-tree',
                'description' => 'Pesona persawahan terasering hijau, air terjun alami, dan keindahan alam pedesaan Ubud.',
            ],
            [
                'name' => 'Oleh-Oleh & Belanja',
                'slug' => 'oleh-oleh-belanja',
                'icon' => 'fa-bag-shopping',
                'description' => 'Pusat perbelanjaan souvenir, kerajinan tangan, baju barong, dan kuliner khas Bali.',
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[$cat['slug']] = AttractionCategory::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        // 2. Destinations
        $destinations = [
            [
                'name' => 'Ubud & Gianyar',
                'slug' => 'ubud-gianyar',
                'category' => 'Seni, Budaya & Alam',
                'location' => 'Kabupaten Gianyar, Bali',
                'image_url' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Pusat seni, budaya, dan ketenangan alam pulau Bali. Dikelilingi persawahan terasering hijau nan asri, galeri batik & perak legendaris, hutan kera suci, air terjun alami, serta aneka aktivitas petualangan seru seperti ATV dan Ayung River Rafting.',
                'highlights' => [
                    'Galeri Seni Batik & Perak Celuk-Tohpati',
                    'Coffee Plantation & Luwak Tasting',
                    'Lunch Bebek Joni Restaurant',
                    'Tegalalang Rice Terrace & Swing',
                    'Sacred Monkey Forest Sanctuary',
                    'Tegenungan Waterfall',
                    'Aktivitas: ATV Ride, Rafting & Buggy Car'
                ],
                'is_popular' => true,
            ],
            [
                'name' => 'Kintamani & Batur',
                'slug' => 'kintamani-batur',
                'category' => 'Gunung, Danau & Budaya',
                'location' => 'Kabupaten Bangli, Bali',
                'image_url' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Kawasan dataran tinggi berhawa sejuk dengan pemandangan magis kaldera Gunung Batur dan Danau Batur. Menawarkan pengalaman petualangan Jeep 4WD Black Lava, agrowisata petik buah stroberi segar, kesucian Pura Tirta Empul, serta keasrian Desa Adat Penglipuran.',
                'highlights' => [
                    'Panorama Gunung & Danau Batur',
                    'Lunch Buffet di Batur Sari Restaurant',
                    'Kebun Stroberi Petik Sendiri',
                    'Pura Tirta Empul Tampaksiring',
                    'Desa Adat Penglipuran',
                    'Aktivitas: Sunrise Jeep 4WD Black Lava'
                ],
                'is_popular' => true,
            ],
            [
                'name' => 'Bedugul & Tabanan',
                'slug' => 'bedugul-tabanan',
                'category' => 'Pura, Danau & Taman Bunga',
                'location' => 'Kabupaten Tabanan, Bali',
                'image_url' => 'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Wisata pegunungan menyejukkan di Bali Tengah yang menyuguhkan keagungan Pura Ulun Danu yang terapung di Danau Beratan, keindahan taman bunga warna-warni The Blooms Garden, dan spot foto gerbang megah Handara Gate.',
                'highlights' => [
                    'Pura Ulun Danu Beratan',
                    'The Blooms Garden Bali',
                    'Handara Iconic Gate',
                    'Lunch Buffet Mentari Resto',
                    'Danau Beratan Bedugul'
                ],
                'is_popular' => true,
            ],
            [
                'name' => 'Uluwatu & Bali Selatan',
                'slug' => 'uluwatu-bali-selatan',
                'category' => 'Pantai, Sunset & Tari Kecak',
                'location' => 'Kabupaten Badung, Bali',
                'image_url' => 'https://images.unsplash.com/photo-1577717903315-1691ae25ab3f?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Eksplorasi pesisir selatan Bali yang legendaris: keseruan watersport di Tanjung Benoa, keindahan tebing kapur Pantai Pandawa & Melasti, pertunjukan magis Tari Kecak di tebing Pura Uluwatu saat matahari terbenam, makan malam seafood di Pantai Jimbaran, serta belanja oleh-oleh khas Bali.',
                'highlights' => [
                    'Tanjung Benoa Watersport (Snorkeling, Diving, Parasailing, Jetski)',
                    'Pantai Pandawa & Tebing Kapur',
                    'Pantai Melasti Ungasan',
                    'Pura Luhur Uluwatu',
                    'Pertunjukan Tari Kecak & Api Sunset',
                    'Dinner Seafood Pantai Jimbaran',
                    'Pusat Oleh-Oleh: Krisna, Agung Bali & The Keranjang'
                ],
                'is_popular' => true,
            ],
            [
                'name' => 'Nusa Penida',
                'slug' => 'nusa-penida',
                'category' => 'Pulau & Pantai Eksotis',
                'location' => 'Kabupaten Klungkung, Bali',
                'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Pulau surga di seberang selat Badung dengan formasi tebing karang ikonik Kelingking Beach T-Rex, Broken Beach, Angel Billabong, dan keindahan Crystal Bay.',
                'highlights' => [
                    'Kelingking Beach (T-Rex Cliff)',
                    'Broken Beach (Pasih Uug)',
                    'Angel Billabong Natural Pool',
                    'Crystal Bay Beach',
                    'Penyeberangan Fastboat PP'
                ],
                'is_popular' => false,
            ],
        ];

        foreach ($destinations as $destData) {
            $dest = Destination::updateOrCreate(['slug' => $destData['slug']], $destData);

            // ==========================================
            // 1. TOUR PACKAGE: UBUD TOUR
            // ==========================================
            if ($dest->slug === 'ubud-gianyar') {
                Attraction::updateOrCreate(['slug' => 'galeri-seni-batik-perak'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['budaya-pura']->id,
                    'name' => 'Galeri Seni Batik & Kerajinan Perak Celuk',
                    'slug' => 'galeri-seni-batik-perak',
                    'location' => 'Batubulan & Celuk, Gianyar',
                    'image_url' => 'https://images.unsplash.com/photo-1604014237800-1c9102c219da?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Melihat langsung proses pembuatan kain batik tenun tradisional dan kerajinan ukiran perak serta emas berkualitas tinggi khas seniman Bali.',
                    'ticket_price_info' => 'Termasuk dalam paket tour',
                ]);

                Attraction::updateOrCreate(['slug' => 'coffee-plantation-luwak-ubud'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['alam-air-terjun-sawah']->id,
                    'name' => 'Coffee Plantation & Uji Cita Rasa Kopi Luwak',
                    'slug' => 'coffee-plantation-luwak-ubud',
                    'location' => 'Ubud, Gianyar',
                    'image_url' => 'https://images.unsplash.com/photo-1501339847302-ac426a4a7cbb?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Menjelajahi kebun kopi alami, mempelajari proses pembuatan kopi tradisional Bali, dan mencicipi aneka racikan kopi serta teh herbal khas pulau Dewata.',
                    'ticket_price_info' => 'Termasuk dalam paket tour (Free Tester)',
                ]);

                Attraction::updateOrCreate(['slug' => 'tegalalang-rice-terrace'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['alam-air-terjun-sawah']->id,
                    'name' => 'Tegalalang Rice Terrace & Ubud Swing',
                    'slug' => 'tegalalang-rice-terrace',
                    'location' => 'Tegalalang, Ubud',
                    'image_url' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Bentangan persawahan terasering hijau bertingkat yang asri berpadu dengan spot ayunan ekstrem dan sarang burung estetik.',
                    'ticket_price_info' => 'Termasuk tiket masuk objek wisata',
                ]);

                Attraction::updateOrCreate(['slug' => 'sacred-monkey-forest'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['alam-air-terjun-sawah']->id,
                    'name' => 'Sacred Monkey Forest Sanctuary',
                    'slug' => 'sacred-monkey-forest',
                    'location' => 'Padangtegal, Ubud',
                    'image_url' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Hutan lindung alami yang dihuni ratusan monyet ekor panjang yang ramah, dilengkapi pura kuno dan pepohonan beringin raksasa.',
                    'ticket_price_info' => 'Termasuk tiket masuk kawasan',
                ]);

                Attraction::updateOrCreate(['slug' => 'tegenungan-waterfall'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['alam-air-terjun-sawah']->id,
                    'name' => 'Tegenungan Waterfall',
                    'slug' => 'tegenungan-waterfall',
                    'location' => 'Kemenuh, Sukawati, Gianyar',
                    'image_url' => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Air terjun alami berarus jernih dengan lembah hijau yang asri, udara segar, dan spot foto jembatan kayu yang mempesona.',
                    'ticket_price_info' => 'Termasuk tiket masuk objek',
                ]);

                TourPackage::updateOrCreate(['slug' => 'paket-tour-ubud-cultural-nature'], [
                    'destination_id' => $dest->id,
                    'title' => 'Paket Ubud Cultural, Nature & Adventure Tour',
                    'slug' => 'paket-tour-ubud-cultural-nature',
                    'category' => 'Ubud Tour (Full Day)',
                    'duration' => 'Full Day (Jadwal Fleksibel)',
                    'price' => 450000,
                    'original_price' => 600000,
                    'badge' => 'Paling Favorit 🌿',
                    'rating' => 4.93,
                    'review_count' => 245,
                    'image_url' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=1200&q=80',
                    'gallery' => [
                        'https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=1200&q=80',
                        'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=1200&q=80',
                        'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=1200&q=80',
                    ],
                    'description' => 'Jelajahi pesona Ubud secara eksklusif bersama Bothrex Driver. Mulai dari keanggunan galeri batik & kerajinan perak Celuk, mencicipi kopi luwak di perkebunan asri, makan siang lezat di Restoran Bebek Joni berlatar sawah, menyusuri Tegalalang Rice Terrace & Monkey Forest, hingga kesegaran Air Terjun Tegenungan. Tersedia juga opsi wahana ATV Ride, Rafting, Swing, dan Buggy Car!',
                    'itinerary' => [
                        ['title' => 'Penjemputan di Hotel / Villa', 'description' => 'Driver ramah Bothrex siap menjemput Anda langsung di lobi hotel menggunakan mobil privat ber-AC yang bersih dan nyaman.'],
                        ['title' => 'Galeri Seni Tradisional (Batik & Silver Gallery)', 'description' => 'Melihat karya seni tenun batik khas Bali di Tohpati serta kerajinan ukir perak dan emas bermutu tinggi di Celuk Village.'],
                        ['title' => 'Coffee Plantation & Tester Kopi Luwak', 'description' => 'Menikmati suasana kebun kopi tropis dan mencicipi aneka seduhan kopi rempah serta teh herbal khas Pulau Dewata.'],
                        ['title' => 'Makan Siang Spesial di Bebek Joni Restaurant', 'description' => 'Santap siang hidangan bebek gurih khas Bali dengan panorama persawahan hijau membentang luas yang menyejukkan mata.'],
                        ['title' => 'Tegalalang Rice Terrace & Sacred Monkey Forest', 'description' => 'Berjalan santai di pematang sawah bertingkat Tegalalang dilanjutkan berinteraksi dengan kawanan kera jinak di hutan lindung Ubud.'],
                        ['title' => 'Eksplorasi Keindahan Tegenungan Waterfall', 'description' => 'Menikmati gemuruh air terjun alami dan berfoto di berbagai spot instagramable di sekitar lembah Tegenungan.'],
                        ['title' => 'Dinner (Opsional / Fleksibel) & Pengantaran Hotel', 'description' => 'Pilihan makan malam santai di restoran favorit rekomendasi driver, lalu diantar kembali ke hotel tempat Anda beristirahat.'],
                    ],
                    'inclusions' => [
                        'Transportasi Privat Full Day (Mobil AC Bersih + BBM)',
                        'Driver Berpengalaman, Ramah & Siap Membantu Dokumentasi Foto',
                        'Tiket Masuk Semua Objek Wisata Sesuai Rute',
                        'Kunjungan Galeri Batik & Kerajinan Perak Celuk',
                        'Tester Kopi & Teh Tradisional di Coffee Plantation',
                        'Air Mineral Dingin Selama Perjalanan',
                        'Penjemputan & Pengantaran Kembali ke Hotel/Villa',
                    ],
                    'exclusions' => [
                        'Makan Siang Bebek Joni & Makan Malam (Sesuai Pesanan Menu Anda)',
                        'Biaya Aktivitas Pilihan (ATV Ride, Ayung Rafting, Jungle Swing, Buggy Car)',
                        'Pengeluaran Pribadi & Tip Sukarela Driver',
                    ],
                    'is_featured' => true,
                    'is_active' => true,
                ]);
            }

            // ==========================================
            // 2. TOUR PACKAGE: KINTAMANI TOUR
            // ==========================================
            if ($dest->slug === 'kintamani-batur') {
                Attraction::updateOrCreate(['slug' => 'kaldera-gunung-danau-batur'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['gunung-alam-sejuk']->id,
                    'name' => 'Panorama Gunung & Danau Batur Kintamani',
                    'slug' => 'kaldera-gunung-danau-batur',
                    'location' => 'Penelokan, Kintamani',
                    'image_url' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Pemandangan kaldera gunung berapi aktif dan danau berbentuk bulan sabit di ketinggian 1.500 mdpl yang sejuk dan berkabut tipis.',
                    'ticket_price_info' => 'Termasuk retribusi kawasan Kintamani',
                ]);

                Attraction::updateOrCreate(['slug' => 'kebun-stroberi-kintamani'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['gunung-alam-sejuk']->id,
                    'name' => 'Agrowisata Kebun Stroberi (Petik Sendiri)',
                    'slug' => 'kebun-stroberi-kintamani',
                    'location' => 'Kintamani, Bangli',
                    'image_url' => 'https://images.unsplash.com/photo-1464965911861-746a04b4bca6?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Sensasi memetik buah stroberi manis segar langsung dari pohonnya di perkebunan dataran tinggi berhawa sejuk.',
                    'ticket_price_info' => 'Biaya petik sesuai berat timbangan buah',
                ]);

                Attraction::updateOrCreate(['slug' => 'pura-tirta-empul'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['budaya-pura']->id,
                    'name' => 'Pura Tirta Empul Tampaksiring',
                    'slug' => 'pura-tirta-empul',
                    'location' => 'Tampaksiring, Gianyar',
                    'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Pura bersejarah kuno yang memiliki kolam mata air suci alami, terkenal di seluruh dunia untuk ritual penyucian diri (melukat).',
                    'ticket_price_info' => 'Termasuk tiket masuk kawasan pura',
                ]);

                Attraction::updateOrCreate(['slug' => 'desa-adat-penglipuran'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['budaya-pura']->id,
                    'name' => 'Desa Adat Tradisional Penglipuran',
                    'slug' => 'desa-adat-penglipuran',
                    'location' => 'Bangli, Bali',
                    'image_url' => 'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Desa adat yang dinobatkan sebagai salah satu desa terbersih di dunia, dengan tata ruang arsitektur bambu khas Bali yang asri dan bebas polusi kendaraan bermotor.',
                    'ticket_price_info' => 'Termasuk tiket masuk desa wisata',
                ]);

                TourPackage::updateOrCreate(['slug' => 'paket-tour-kintamani-batur-penglipuran'], [
                    'destination_id' => $dest->id,
                    'title' => 'Paket Kintamani Volcano, Penglipuran & Tirta Empul Tour',
                    'slug' => 'paket-tour-kintamani-batur-penglipuran',
                    'category' => 'Kintamani Tour (Full Day)',
                    'duration' => 'Full Day (Jadwal Fleksibel)',
                    'price' => 475000,
                    'original_price' => 650000,
                    'badge' => 'Pemandangan Terbaik 🌋',
                    'rating' => 4.96,
                    'review_count' => 318,
                    'image_url' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1200&q=80',
                    'gallery' => [
                        'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1200&q=80',
                        'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=1200&q=80',
                        'https://images.unsplash.com/photo-1464965911861-746a04b4bca6?auto=format&fit=crop&w=1200&q=80',
                    ],
                    'description' => 'Saksikan panorama megah Gunung & Danau Batur sambil menikmati makan siang buffet di Batur Sari Resto. Lanjutkan wisata petik stroberi segar di kebun lokal, rasakan kesucian mata air Pura Tirta Empul Tampaksiring, dan jelajahi keasrian Desa Adat Penglipuran. Tersedia opsi petualangan seru Sunrise Jeep 4WD ke lautan pasir hitam Black Lava!',
                    'itinerary' => [
                        ['title' => 'Penjemputan Nyaman di Hotel', 'description' => 'Driver privat menjemput Anda di hotel menuju kawasan sejuk dataran tinggi Kintamani.'],
                        ['title' => 'Pemandangan Kaldera Batur & Lunch Batur Sari Resto', 'description' => 'Menikmati udara sejuk pegunungan dan hidangan makan siang buffet prasmanan di Restoran Batur Sari berhadapan langsung dengan panorama Gunung Batur.'],
                        ['title' => 'Agrowisata Kebun Stroberi', 'description' => 'Singgah di perkebunan stroberi dataran tinggi untuk pengalaman menyenangkan memetik buah segar sendiri.'],
                        ['title' => 'Pura Tirta Empul Tampaksiring', 'description' => 'Mengunjungi kompleks pura bersejarah dengan kolam pancuran mata air alami yang sakral.'],
                        ['title' => 'Desa Wisata Adat Penglipuran', 'description' => 'Menyusuri jalanan batu desa terbersih di dunia dengan deretan angkul-angkul rumah adat Bali yang tertata rapi.'],
                        ['title' => 'Dinner (Opsional) & Perjalanan Kembali ke Hotel', 'description' => 'Makan malam santai sesuai selera sebelum driver mengantarkan Anda kembali dengan nyaman ke hotel.'],
                    ],
                    'inclusions' => [
                        'Kendaraan Privat AC Bersih + Driver Ramah + BBM',
                        'Tiket Masuk Kawasan Kintamani & Desa Penglipuran',
                        'Tiket Masuk Objek Wisata Pura Tirta Empul',
                        'Air Mineral Selama Perjalanan',
                        'Layanan Antar-Jemput Hotel Privat',
                    ],
                    'exclusions' => [
                        'Makan Siang di Restoran Batur Sari & Makan Malam (Sesuai Pilihan)',
                        'Biaya Tambahan Sunrise Jeep 4WD Black Lava (Opsional)',
                        'Pengeluaran Belanja Pribadi & Buah Stroberi Timbangan',
                    ],
                    'is_featured' => true,
                    'is_active' => true,
                ]);
            }

            // ==========================================
            // 3. TOUR PACKAGE: BEDUGUL TOUR
            // ==========================================
            if ($dest->slug === 'bedugul-tabanan') {
                Attraction::updateOrCreate(['slug' => 'pura-ulun-danu-beratan'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['budaya-pura']->id,
                    'name' => 'Pura Ulun Danu Beratan Bedugul',
                    'slug' => 'pura-ulun-danu-beratan',
                    'location' => 'Candikuning, Baturiti, Tabanan',
                    'image_url' => 'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Pura air paling ikonik di Bali yang tampak mengapung di permukaan Danau Beratan dengan latar pegunungan berselimut kabut.',
                    'ticket_price_info' => 'Termasuk dalam paket tour',
                ]);

                Attraction::updateOrCreate(['slug' => 'the-blooms-garden'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['gunung-alam-sejuk']->id,
                    'name' => 'The Blooms Garden Bali',
                    'slug' => 'the-blooms-garden',
                    'location' => 'Baturiti, Tabanan',
                    'image_url' => 'https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Taman bunga seluas 5 hektar dengan kincir angin bergaya Belanda, patung merak raksasa, dan spot foto lanskap perbukitan yang indah.',
                    'ticket_price_info' => 'Termasuk tiket masuk taman',
                ]);

                Attraction::updateOrCreate(['slug' => 'handara-gate-bali'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['budaya-pura']->id,
                    'name' => 'Handara Iconic Gate Bali',
                    'slug' => 'handara-gate-bali',
                    'location' => 'Pancasari, Sukasada',
                    'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Gerbang Candi Bentar tradisional Bali yang megah dan terkenal di media sosial dengan latar perbukitan hijau berkabut.',
                    'ticket_price_info' => 'Termasuk tiket spot foto',
                ]);

                TourPackage::updateOrCreate(['slug' => 'paket-tour-bedugul-ulun-danu-blooms-garden'], [
                    'destination_id' => $dest->id,
                    'title' => 'Paket Bedugul Ulun Danu, The Blooms Garden & Handara Gate Tour',
                    'slug' => 'paket-tour-bedugul-ulun-danu-blooms-garden',
                    'category' => 'Bedugul Tour (Full Day)',
                    'duration' => 'Full Day (Jadwal Fleksibel)',
                    'price' => 450000,
                    'original_price' => 600000,
                    'badge' => 'Hawa Sejuk & Asri 🌸',
                    'rating' => 4.89,
                    'review_count' => 176,
                    'image_url' => 'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=1200&q=80',
                    'gallery' => [
                        'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=1200&q=80',
                        'https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?auto=format&fit=crop&w=1200&q=80',
                    ],
                    'description' => 'Nikmati liburan santai berhawa sejuk ke dataran tinggi Bedugul. Berfoto di Pura Ulun Danu Beratan yang terapung megah, menyusuri hamparan bunga The Blooms Garden, berpose di gerbang ikonik Handara Gate, serta menikmati makan siang buffet di Mentari Resto tepi Danau Beratan.',
                    'itinerary' => [
                        ['title' => 'Penjemputan di Hotel / Villa Anda', 'description' => 'Driver privat Bothrex menjemput di lobi hotel untuk memulai perjalanan ke kawasan sejuk Bedugul.'],
                        ['title' => 'Pura Ulun Danu Beratan Bedugul', 'description' => 'Mengeksplorasi keindahan pura air terapung bersejarah di pinggir danau dengan pemandangan pegunungan yang menyejukkan.'],
                        ['title' => 'Makan Siang Buffet di Mentari Resto', 'description' => 'Santap siang aneka hidangan nusantara lezat di Mentari Resto sambil menikmati suasana sejuk Danau Beratan.'],
                        ['title' => 'The Blooms Garden Bali', 'description' => 'Berjalan santai di taman bunga spektakuler berarsitektur kincir angin dan spot foto estetik.'],
                        ['title' => 'Handara Iconic Gate', 'description' => 'Sesi foto ikonik di gerbang megah Bali yang terkenal di mancanegara.'],
                        ['title' => 'Dinner (Opsional) & Pengantaran Kembali ke Hotel', 'description' => 'Pilihan makan malam sebelum driver mengantarkan Anda kembali beristirahat di hotel.'],
                    ],
                    'inclusions' => [
                        'Mobil Privat AC Bersih + Driver Ramah + BBM',
                        'Tiket Masuk Pura Ulun Danu Beratan',
                        'Tiket Masuk The Blooms Garden',
                        'Tiket Spot Foto Handara Iconic Gate',
                        'Air Mineral Dingin',
                        'Layanan Antar-Jemput Hotel Privat',
                    ],
                    'exclusions' => [
                        'Makan Siang di Mentari Resto & Makan Malam (Sesuai Menu Pilihan)',
                        'Pengeluaran Pribadi & Sewa Kostum / Wahana Tambahan',
                    ],
                    'is_featured' => true,
                    'is_active' => true,
                ]);
            }

            // ==========================================
            // 4. TOUR PACKAGE: ULUWATU TOUR & SHOPPING
            // ==========================================
            if ($dest->slug === 'uluwatu-bali-selatan') {
                Attraction::updateOrCreate(['slug' => 'tanjung-benoa-watersport'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['bahari-watersport']->id,
                    'name' => 'Tanjung Benoa Watersport Center',
                    'slug' => 'tanjung-benoa-watersport',
                    'location' => 'Tanjung Benoa, Nusa Dua',
                    'image_url' => 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Surga wisata olahraga air terlengkap: Snorkeling, Scuba Diving, Sea Walker (berjalan di dasar laut), Parasailing Adventure, Jet Ski, Banana Boat, dan Pulau Penyu.',
                    'ticket_price_info' => 'Harga wahana bervariasi dengan promo spesial Bothrex',
                ]);

                Attraction::updateOrCreate(['slug' => 'pantai-pandawa-melasti'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['pantai-sunset']->id,
                    'name' => 'Pantai Pandawa & Pantai Melasti Ungasan',
                    'slug' => 'pantai-pandawa-melasti',
                    'location' => 'Kutuh & Ungasan, Bali Selatan',
                    'image_url' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Dua pantai pasir putih tercantik di Bali Selatan yang diapit oleh tebing kapur meliuk megah dan air laut biru toska berombak tenang.',
                    'ticket_price_info' => 'Termasuk tiket masuk kawasan pantai',
                ]);

                Attraction::updateOrCreate(['slug' => 'pura-uluwatu-kecak-dance'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['budaya-pura']->id,
                    'name' => 'Pura Luhur Uluwatu & Pertunjukan Tari Kecak',
                    'slug' => 'pura-uluwatu-kecak-dance',
                    'location' => 'Pecatu, Kuta Selatan',
                    'image_url' => 'https://images.unsplash.com/photo-1577717903315-1691ae25ab3f?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Pura megah di ujung tebing karang setinggi 70 meter menghadap Samudra Hindia dengan panggung pertunjukan Tari Kecak berlatar senja keemasan.',
                    'ticket_price_info' => 'Termasuk tiket pura & tiket tari kecak',
                ]);

                Attraction::updateOrCreate(['slug' => 'jimbaran-seafood-dinner'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['pantai-sunset']->id,
                    'name' => 'Sunset Seafood Dining Pantai Jimbaran',
                    'slug' => 'jimbaran-seafood-dinner',
                    'location' => 'Pantai Jimbaran, Badung',
                    'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Makan malam romantis di atas pasir pantai dengan hidangan ikan bakar, udang, cumi bumbu khas Jimbaran ditemani alunan deburan ombak.',
                    'ticket_price_info' => 'Sesuai pesanan menu ala carte / paket',
                ]);

                Attraction::updateOrCreate(['slug' => 'pusat-oleh-oleh-bali'], [
                    'destination_id' => $dest->id,
                    'attraction_category_id' => $categories['oleh-oleh-belanja']->id,
                    'name' => 'Pusat Belanja Oleh-Oleh Khas Bali (Krisna / Agung Bali / The Keranjang)',
                    'slug' => 'pusat-oleh-oleh-bali',
                    'location' => 'Tuban & Kuta, Bali',
                    'image_url' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=1200&q=80',
                    'description' => 'Pusat belanja souvenir terlengkap dan terbesar: pie susu, pia Bali, kacang disco, kain pantai, baju barong, aromatherapy, dan kerajinan tangan lokal dengan harga pasti.',
                    'ticket_price_info' => 'Bebas biaya masuk (Free Entry)',
                ]);

                TourPackage::updateOrCreate(['slug' => 'paket-tour-uluwatu-kecak-watersport-jimbaran'], [
                    'destination_id' => $dest->id,
                    'title' => 'Paket Uluwatu Sunset, Tari Kecak, Watersport & Dinner Jimbaran',
                    'slug' => 'paket-tour-uluwatu-kecak-watersport-jimbaran',
                    'category' => 'Uluwatu Tour (Full Day)',
                    'duration' => 'Full Day (Jadwal Fleksibel)',
                    'price' => 490000,
                    'original_price' => 690000,
                    'badge' => 'Best Seller 🔥',
                    'rating' => 4.97,
                    'review_count' => 482,
                    'image_url' => 'https://images.unsplash.com/photo-1577717903315-1691ae25ab3f?auto=format&fit=crop&w=1200&q=80',
                    'gallery' => [
                        'https://images.unsplash.com/photo-1577717903315-1691ae25ab3f?auto=format&fit=crop&w=1200&q=80',
                        'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80',
                        'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&w=1200&q=80',
                    ],
                    'description' => 'Paket liburan paling lengkap di pesisir selatan Bali! Rasakan sensasi wahana watersport di Tanjung Benoa (Snorkeling, Diving, Parasailing, Jetski, Sea Walker), bersantai di Pantai Pandawa & Pantai Melasti, menyaksikan kemegahan Pura Uluwatu & magisnya Tari Kecak saat sunset, menikmati romantic seafood dinner di Pantai Jimbaran, serta berbelanja di pusat oleh-oleh terkenal (Krisna, Agung Bali, atau The Keranjang).',
                    'itinerary' => [
                        ['title' => 'Penjemputan Hotel Privat', 'description' => 'Driver ramah Bothrex menjemput Anda tepat waktu di hotel/villa dengan kendaraan privat yang nyaman.'],
                        ['title' => 'Wahana Watersport Tanjung Benoa', 'description' => 'Keseruan olahraga air di pantai pasir putih (Snorkeling, Diving, Sea Walker, Parasailing Adventure, Jetski, Banana Boat, Pulau Penyu).'],
                        ['title' => 'Wisata Pantai Pandawa & Pantai Melasti', 'description' => 'Menikmati keindahan pantai berpasir putih lembut dengan tebing kapur eksotis dan air laut bening kristal.'],
                        ['title' => 'Pura Luhur Uluwatu & Tari Kecak Sunset', 'description' => 'Menyaksikan tarian kolosal Kecak berlatar panorama matahari terbenam spektakuler di atas tebing samudra.'],
                        ['title' => 'Romantic Seafood Dinner di Pantai Jimbaran', 'description' => 'Santap malam hidangan laut bakar khas Jimbaran di tepi pantai dengan lilin temaram dan deburan ombak.'],
                        ['title' => 'Shopping Oleh-Oleh Khas Bali & Pengantaran Hotel', 'description' => 'Singgah berbelanja oleh-oleh di Krisna, Agung Bali, atau The Keranjang sebelum diantar kembali ke hotel.'],
                    ],
                    'inclusions' => [
                        'Kendaraan Privat AC Bersih + BBM Sepanjang Hari',
                        'Driver Lokal Ramah & Berpengalaman Sebagai Pemandu & Fotografer',
                        'Tiket Masuk Kawasan Pantai Pandawa & Melasti',
                        'Tiket Masuk Pura Luhur Uluwatu',
                        'Tiket Pertunjukan Tari Kecak Uluwatu',
                        'Air Mineral Selama Perjalanan',
                        'Antar-Jemput Hotel Privat',
                    ],
                    'exclusions' => [
                        'Tiket Permainan Watersport Tanjung Benoa (Tersedia Tarif Promo Spesial Bothrex)',
                        'Makan Malam Seafood di Jimbaran (Sesuai Menu Pilihan Anda)',
                        'Belanja Oleh-Oleh Pribadi & Tip Sukarela Driver',
                    ],
                    'is_featured' => true,
                    'is_active' => true,
                ]);
            }
        }
    }
}
