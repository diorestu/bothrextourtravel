<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\TourPackage;
use App\Models\Booking;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        // Create Destinations
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
            $dest = Destination::create($destData);

            if ($dest->slug === 'nusa-penida') {
                TourPackage::create([
                    'destination_id' => $dest->id,
                    'title' => 'One Day Tour Nusa Penida Barat (West Island)',
                    'slug' => 'one-day-tour-nusa-penida-barat',
                    'category' => 'Full Day Tour',
                    'duration' => '1 Hari (06:30 - 17:30)',
                    'price' => 450000,
                    'original_price' => 650000,
                    'badge' => 'Paling Laris 🏆',
                    'rating' => 4.9,
                    'review_count' => 342,
                    'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
                    'gallery' => [
                        'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
                        'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1200&q=80',
                        'https://images.unsplash.com/photo-1577717903315-1691ae25ab3f?auto=format&fit=crop&w=1200&q=80',
                    ],
                    'description' => 'Nikmati keindahan keajaiban alam Nusa Penida Barat dalam satu hari! Mengunjungi spot foto kelas dunia seperti Kelingking Beach (T-Rex Cliff), Broken Beach, Angel Billabong, dan Crystal Bay.',
                    'itinerary' => [
                        ['time' => '06:30', 'title' => 'Penjemputan Hotel', 'description' => 'Driver profesional menjemput Anda di hotel area Kuta, Seminyak, Legian, Canggu, atau Sanur.'],
                        ['time' => '07:30', 'title' => 'Check-in Fastboat di Pelabuhan Sanur', 'description' => 'Proses registrasi tiket fastboat menuju Pelabuhan Nusa Penida.'],
                        ['time' => '08:00', 'title' => 'Keberangkatan Fastboat', 'description' => 'Perjalanan penyeberangan laut sekitar 45 menit menggunakan kapal cepat modern.'],
                        ['time' => '09:00', 'title' => 'Tiba di Nusa Penida & Kelingking Beach', 'description' => 'Eksplorasi spot ikonik Kelingking Beach dengan pemandangan tebing T-Rex nan megah.'],
                        ['time' => '11:30', 'title' => 'Broken Beach & Angel Billabong', 'description' => 'Menyaksikan lubang karang raksasa laut dan kolam renang alami transparan.'],
                        ['time' => '13:00', 'title' => 'Makan Siang Resto Lokal', 'description' => 'Istirahat dan nikmati menu makan siang khas Bali / Nusantara.'],
                        ['time' => '14:30', 'title' => 'Relaxing di Crystal Bay Beach', 'description' => 'Bersantai di pantai berpasir halus dan air laut jernih membiru.'],
                        ['time' => '16:30', 'title' => 'Kembali ke Pelabuhan & Sanur', 'description' => 'Menuju pelabuhan fastboat untuk perjalanan kembali ke Pulau Bali dan diantar ke hotel.'],
                    ],
                    'inclusions' => [
                        'Tiket PP Fastboat Sanur - Nusa Penida',
                        'Mobil Privat AC + Driver Lokal Nusa Penida + BBM',
                        'Tiket Masuk Semua Objek Wisata',
                        'Makan Siang di Restoran Lokal',
                        'Air Mineral Selama Tour',
                        'Bantuan Pengambilan Foto/Dokumentasi',
                    ],
                    'exclusions' => [
                        'Pengeluaran Pribadi',
                        'Tip Supir/Guide (Sukarela)',
                        'Retribusi Pemda Nusa Penida (Rp 25.000/orang)',
                    ],
                    'is_featured' => true,
                ]);

                TourPackage::create([
                    'destination_id' => $dest->id,
                    'title' => 'Paket Combo Nusa Penida West + Snorkeling Manta Ray',
                    'slug' => 'nusa-penida-west-snorkeling-manta',
                    'category' => 'Adventure Tour',
                    'duration' => '1 Hari (06:30 - 17:30)',
                    'price' => 650000,
                    'original_price' => 850000,
                    'badge' => 'Recommended ⭐',
                    'rating' => 4.95,
                    'review_count' => 218,
                    'image_url' => 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=1200&q=80',
                    'gallery' => [
                        'https://images.unsplash.com/photo-1544551763-46a013bb70d5?auto=format&fit=crop&w=1200&q=80',
                        'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
                    ],
                    'description' => 'Gabungan sempurna petualangan bawah laut snorkeling berenang bersama Ikan Manta Ray raksasa di Manta Bay dan darat Nusa Penida (Kelingking & Broken Beach).',
                    'itinerary' => [
                        ['time' => '06:30', 'title' => 'Jemput Hotel & Fastboat', 'description' => 'Penjemputan hotel menuju pelabuhan Sanur.'],
                        ['time' => '09:00', 'title' => 'Snorkeling Boat Trip (4 Spots)', 'description' => 'Snorkeling di Manta Bay, Gamt Bay, Wall Bay, dan Crystal Bay lengkap perahu & guide.'],
                        ['time' => '12:30', 'title' => 'Makan Siang Resto', 'description' => 'Santap makan siang enak.'],
                        ['time' => '14:00', 'title' => 'Land Tour Kelingking & Broken Beach', 'description' => 'Mengunjungi tebing Kelingking dan Angel Billabong.'],
                        ['time' => '17:00', 'title' => 'Kembali ke Bali', 'description' => 'Kembali dengan fastboat sore ke Sanur.'],
                    ],
                    'inclusions' => [
                        'Tiket PP Fastboat Sanur - Nusa Penida',
                        'Boat Snorkeling + Peralatan Snorkeling Lengkap',
                        'Guide Snorkeling + Foto Underwater (GoPro)',
                        'Mobil Privat AC di Nusa Penida + BBM',
                        'Tiket Masuk & Makan Siang',
                    ],
                    'exclusions' => [
                        'Tip Supir/Guide',
                        'Pengeluaran Pribadi',
                    ],
                    'is_featured' => true,
                ]);
            }

            if ($dest->slug === 'ubud-gianyar') {
                TourPackage::create([
                    'destination_id' => $dest->id,
                    'title' => 'Full Day Ubud Culture, Swing & Waterfall Highlights',
                    'slug' => 'full-day-ubud-culture-swing-waterfall',
                    'category' => 'Full Day Tour',
                    'duration' => '1 Hari (08:30 - 18:00)',
                    'price' => 500000,
                    'original_price' => 700000,
                    'badge' => 'Best Value 💫',
                    'rating' => 4.85,
                    'review_count' => 195,
                    'image_url' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=1200&q=80',
                    'gallery' => [
                        'https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=1200&q=80',
                    ],
                    'description' => 'Rasakan magis keindahan alam dan budaya Ubud Bali: menyaksikan Tegalalang Rice Terrace, petualangan swing Alas Harum, berinteraksi dengan monyet di Sacred Monkey Forest, dan menyegarkan diri di Air Terjun Tegenungan.',
                    'itinerary' => [
                        ['time' => '08:30', 'title' => 'Penjemputan Hotel', 'description' => 'Jemput hotel di area Kuta/Seminyak/Sanur/Ubud.'],
                        ['time' => '09:30', 'title' => 'Sacred Monkey Forest Sanctuary', 'description' => 'Jalan-jalan di hutan Lindung tempat hidup ratusan kera abu-abu Bali.'],
                        ['time' => '11:30', 'title' => 'Tegalalang Rice Terrace & Alas Harum Swing', 'description' => 'Foto estetik di terasering sawah dan mencoba ayunan ekstrem Bali Swing.'],
                        ['time' => '13:30', 'title' => 'Makan Siang View Sawah Ubud', 'description' => 'Nikmati Nasi Campur Bali / Crispy Duck dengan latar sawah.'],
                        ['time' => '15:30', 'title' => 'Tegenungan Waterfall', 'description' => 'Air terjun megah di tengah tebing hijau nan indah.'],
                        ['time' => '17:30', 'title' => 'Kembali ke Hotel', 'description' => 'Perjalanan kembali menuju hotel tempat Anda menginap.'],
                    ],
                    'inclusions' => [
                        'Mobil Privat AC + Supir Ramah + BBM',
                        'Tiket Masuk Semua Destinasi Ubud',
                        'Makan Siang di Ubud',
                        'Air Mineral',
                    ],
                    'exclusions' => [
                        'Ayunan (Swing) Opsional Tambahan',
                        'Pengeluaran Pribadi',
                    ],
                    'is_featured' => true,
                ]);
            }

            if ($dest->slug === 'kintamani-batur') {
                TourPackage::create([
                    'destination_id' => $dest->id,
                    'title' => 'Package Mt. Batur Sunrise 4WD Jeep Tour & Kintamani Cafe',
                    'slug' => 'mount-batur-sunrise-jeep-kintamani-cafe',
                    'category' => 'Adventure Tour',
                    'duration' => '1 Hari (03:00 - 14:00)',
                    'price' => 600000,
                    'original_price' => 850000,
                    'badge' => 'Super Hits 🔥',
                    'rating' => 4.98,
                    'review_count' => 412,
                    'image_url' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1200&q=80',
                    'gallery' => [
                        'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1200&q=80',
                    ],
                    'description' => 'Saksikan keindahan sunrise Gunung Batur dari ketinggian tanpa perlu lelah mendaki! Menggunakan mobil 4WD Jeep klasik menuju Black Lava & Black Sand Batur.',
                    'itinerary' => [
                        ['time' => '03:00', 'title' => 'Penjemputan Subuh', 'description' => 'Driver menjemput di hotel menuju Kintamani.'],
                        ['time' => '05:00', 'title' => 'Start 4WD Jeep Mt. Batur Sunrise', 'description' => 'Naik Jeep 4WD menanjak ke titik sunrise point Gunung Batur.'],
                        ['time' => '06:00', 'title' => 'Sunrise & Sarapan di Atas Jeep', 'description' => 'Menikmati matahari terbit berlatar Danau & Gunung Abang dengan sarapan hangat.'],
                        ['time' => '08:00', 'title' => 'Eksplor Black Lava & Black Sand Batur', 'description' => 'Foto keren dengan latar pasir dan batu lahar hitam vulkanik.'],
                        ['time' => '10:30', 'title' => 'Kintamani Coffee Tasting & Cafe View', 'description' => 'Nongkrong di kafe Kintamani dengan pemandangan danau.'],
                        ['time' => '13:00', 'title' => 'Pengantaran Kembali', 'description' => 'Kembali ke hotel dengan kenangan tak terlupakan.'],
                    ],
                    'inclusions' => [
                        'Antar Jemput Hotel Mobil AC Privat',
                        'Sewa 4WD Jeep Klasik + Driver Jeep Lokal',
                        'Sarapan Pagi & Kopi/Teh Hangat',
                        'Tiket Masuk Kintamani & Retribusi Gunung Batur',
                    ],
                    'exclusions' => [
                        'Pengeluaran Pesanan Kafe Tambahan',
                        'Tip Driver Jeep',
                    ],
                    'is_featured' => true,
                ]);
            }

            if ($dest->slug === 'uluwatu-bali-selatan') {
                TourPackage::create([
                    'destination_id' => $dest->id,
                    'title' => 'Exotic South Bali Beach, Uluwatu Kecak Dance & Jimbaran Seafood Dinner',
                    'slug' => 'south-bali-uluwatu-kecak-jimbaran-seafood',
                    'category' => 'Sunset Tour',
                    'duration' => '1 Hari (10:00 - 21:00)',
                    'price' => 550000,
                    'original_price' => 750000,
                    'badge' => 'Romantic Sunset 🌅',
                    'rating' => 4.92,
                    'review_count' => 289,
                    'image_url' => 'https://images.unsplash.com/photo-1577717903315-1691ae25ab3f?auto=format&fit=crop&w=1200&q=80',
                    'gallery' => [
                        'https://images.unsplash.com/photo-1577717903315-1691ae25ab3f?auto=format&fit=crop&w=1200&q=80',
                    ],
                    'description' => 'Paket komplit Bali Selatan! Bersantai di Melasti & Padang-Padang Beach, menyaksikan magis Tari Kecak di Pura Uluwatu saat sunset, dilanjutkan makan malam seafood lezat di tepi Pantai Jimbaran.',
                    'itinerary' => [
                        ['time' => '10:00', 'title' => 'Penjemputan Hotel', 'description' => 'Driver menjemput Anda menuju Bali Selatan.'],
                        ['time' => '11:30', 'title' => 'Pantai Pandawa & Tebing Karang Melasti', 'description' => 'Nikmati pasir putih dan tebing kapur ikonik Melasti Beach.'],
                        ['time' => '14:30', 'title' => 'Pantai Padang Padang', 'description' => 'Pantai cantik tempat lokasi syuting film Eat Pray Love.'],
                        ['time' => '16:30', 'title' => 'Pura Luhur Uluwatu', 'description' => 'Pura tebing samudra dengan pemandangan samudra Hindia.'],
                        ['time' => '18:00', 'title' => 'Pertunjukan Tari Kecak Uluwatu', 'description' => 'Menonton tarian kolosal Bali Kecak & Fire Dance berlatar sunset.'],
                        ['time' => '19:30', 'title' => 'Dinner Seafood Candlelight di Jimbaran Bay', 'description' => 'Makan malam romantis menu ikan bakar, udang, cumi di pinggir pantai Jimbaran.'],
                        ['time' => '21:00', 'title' => 'Kembali ke Hotel', 'description' => 'Pengantaran kembali ke hotel.'],
                    ],
                    'inclusions' => [
                        'Mobil Privat AC + Supir + BBM',
                        'Tiket Masuk Pantai Melasti & Padang Padang',
                        'Tiket Masuk Pura Uluwatu',
                        'Tiket Pertunjukan Tari Kecak Uluwatu',
                        'Paket Set Menu Dinner Seafood Jimbaran Bay',
                    ],
                    'exclusions' => [
                        'Minuman Alkohol / Pesanan Seafood Tambahan',
                        'Pengeluaran Pribadi',
                    ],
                    'is_featured' => true,
                ]);
            }

            if ($dest->slug === 'bedugul-tanah-lot') {
                TourPackage::create([
                    'destination_id' => $dest->id,
                    'title' => 'Bedugul Floating Temple, Handara Gate & Tanah Lot Sunset Tour',
                    'slug' => 'bedugul-handara-gate-tanah-lot-sunset',
                    'category' => 'Full Day Tour',
                    'duration' => '1 Hari (08:30 - 19:30)',
                    'price' => 480000,
                    'original_price' => 680000,
                    'badge' => 'Classic Bali 📸',
                    'rating' => 4.88,
                    'review_count' => 174,
                    'image_url' => 'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=1200&q=80',
                    'gallery' => [
                        'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=1200&q=80',
                    ],
                    'description' => 'Jelajahi keindahan sejuk dataran tinggi Bedugul, foto ikonik di Handara Golf Gate, pura terapung Ulun Danu Beratan, dan sunset romantis di Pura Tanah Lot.',
                    'itinerary' => [
                        ['time' => '08:30', 'title' => 'Penjemputan Hotel', 'description' => 'Menuju wilayah Tabanan dan Bedugul.'],
                        ['time' => '10:30', 'title' => 'Pura Ulun Danu Beratan Lake', 'description' => 'Pura terapung ikonik uang lembaran Rp 50.000.'],
                        ['time' => '12:00', 'title' => 'Handara Iconic Bali Gate', 'description' => 'Foto spot gerbang ukiran Bali berlatar perbukitan hijau.'],
                        ['time' => '13:00', 'title' => 'Makan Siang Buffet Bedugul', 'description' => 'Santap siang lezat sepuasnya.'],
                        ['time' => '15:30', 'title' => 'Wanagiri Hidden Hills View Point', 'description' => 'Spot foto sarung burung dan ayunan danau Buyan.'],
                        ['time' => '17:30', 'title' => 'Pura Tanah Lot Sunset', 'description' => 'Menikmati indahnya matahari terbenam Pura Tanah Lot di karang laut.'],
                        ['time' => '19:30', 'title' => 'Kembali ke Hotel', 'description' => 'Pengantaran kembali ke hotel.'],
                    ],
                    'inclusions' => [
                        'Mobil AC Privat + Supir + BBM',
                        'Tiket Masuk Pura Ulun Danu & Tanah Lot',
                        'Makan Siang Resto',
                        'Air Mineral',
                    ],
                    'exclusions' => [
                        'Tiket Foto Tambahan di Handara Gate / Wanagiri',
                        'Pengeluaran Pribadi',
                    ],
                    'is_featured' => false,
                ]);
            }
        }

        // Seed a sample booking
        $firstPackage = TourPackage::first();
        if ($firstPackage) {
            Booking::create([
                'booking_code' => 'BALI-' . date('Ym') . '-001',
                'tour_package_id' => $firstPackage->id,
                'customer_name' => 'Budi Santoso',
                'customer_email' => 'budi.santoso@example.com',
                'customer_phone' => '081234567890',
                'travel_date' => now()->addDays(5)->format('Y-m-d'),
                'number_of_guests' => 2,
                'total_price' => $firstPackage->price * 2,
                'pickup_location' => 'Hotel Grand Inna Kuta Beach, Room 302',
                'special_notes' => 'Tolong sediakan car seat untuk balita 2 tahun jika ada. Terima kasih!',
                'status' => 'pending',
            ]);
        }
    }
}
