<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'title' => 'The Ultimate 5-Day Bali Itinerary for First-Time Travelers',
                'slug' => 'ultimate-5-day-bali-itinerary',
                'category' => 'Itinerary',
                'image_url' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Planning your first vacation to Bali? Here is the best day-by-day 5-day Bali itinerary covering Ubud, Kintamani, Nusa Penida, Uluwatu, and Seminyak with private driver transport.',
                'content' => <<<'HTML'
<h2>Introduction: Why 5 Days is Perfect for Your First Bali Trip</h2>
<p>Bali, known as the Island of the Gods, offers a diverse mix of lush tropical jungles, towering volcanoes, crystal-clear beaches, and deep spiritual heritage. If you have 5 days in Bali, having a planned itinerary with a private driver ensures you see the very best spots without wasting time stuck in traffic or navigating stressful scooter roads.</p>

<h3>Day 1: Arrival, Beach Sunset & Seafood Feast in Jimbaran</h3>
<p>Upon landing at Ngurah Rai International Airport (DPS), your private English-speaking driver greets you at arrivals and transfers you comfortably in an air-conditioned car. Check in to your hotel in South Bali (Kuta, Legian, or Seminyak). In the late afternoon, head straight to Jimbaran Bay to watch the golden sunset while enjoying fresh grilled seafood on the sandy shore.</p>

<h3>Day 2: Cultural Ubud & Scenic Tegallalang Rice Terraces</h3>
<p>Start early toward the cultural heartland of Ubud. Stop at the sacred Monkey Forest sanctuary, followed by the picturesque Tegallalang Rice Terraces. Experience the world-famous jungle swing over emerald valleys, then take an afternoon trek to the scenic Tegenungan Waterfall.</p>

<h3>Day 3: Kintamani Volcano Sunrise, Coffee Plantation & Hot Springs</h3>
<p>Head up to the highlands of Kintamani. Enjoy panoramic views of the active Mount Batur and Lake Batur while sipping authentic Luwak coffee. Opt for an exhilarating 4WD Black Lava Jeep adventure across the volcanic terrain, followed by a relaxing soak in natural volcanic hot springs.</p>

<h3>Day 4: Nusa Penida Island Day Cruise</h3>
<p>Take an express speedboat from Sanur Harbour to Nusa Penida island. Visit iconic West Nusa Penida attractions: the dramatic T-Rex cliff at Kelingking Beach, Broken Beach, and the natural infinity pool of Angel's Billabong. Crystal Bay offers fantastic swimming and snorkeling before heading back to the mainland.</p>

<h3>Day 5: Uluwatu Sea Temple, Kecak Fire Dance & Departure</h3>
<p>Wrap up your memorable vacation along Bali's dramatic southern cliffs. Visit Uluwatu Temple perched 70 meters above the crashing Indian Ocean waves. Watch the mystical Kecak Fire Dance performance against the backdrop of a flaming sunset before your driver transfers you back to the airport.</p>

<div class="my-6 p-6 bg-emerald-50 border border-emerald-200 rounded-2xl">
    <h4 class="text-emerald-900 font-bold text-lg mb-2">Want a Stress-Free Bali Experience?</h4>
    <p class="text-emerald-800 text-sm">Bothrex Bali Tour provides private car charters, all-inclusive packages, and friendly local drivers. Contact our team directly on WhatsApp to customize this itinerary to your schedule!</p>
</div>
HTML,
                'author_name' => 'Wayan Sudarma (Bothrex Team)',
                'reading_time' => '5 min read',
                'views_count' => 1240,
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'Top 10 Hidden Gem Waterfalls in Ubud & Gianyar You Must Visit',
                'slug' => 'top-hidden-gem-waterfalls-ubud-gianyar',
                'category' => 'Hidden Gem',
                'image_url' => 'https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Escape the crowded tourist spots! Discover the most pristine, tranquil waterfalls hidden around Ubud and Gianyar, including Tibumana, Kanto Lampo, and Tukad Cepung.',
                'content' => <<<'HTML'
<h2>Beyond the Crowds: The Magic of Bali's Hidden Waterfalls</h2>
<p>While Tegenungan Waterfall is widely known, central Bali hides dozens of secluded jungle falls that offer breathtaking photo opportunities and serene swimming lagoons without the massive bus tour crowds.</p>

<h3>1. Tibumana Waterfall</h3>
<p>Located in Bangli just 30 minutes from Ubud, Tibumana is famous for its straight, silky curtain of cascading water surrounded by lush jungle ferns and moss-covered rock walls. The path is well-paved, making it family-friendly and easily accessible.</p>

<h3>2. Kanto Lampo Waterfall</h3>
<p>Kanto Lampo is unique because the river water cascades down multi-tiered black rock boulders rather than dropping in a single vertical plunge. Standing on the rocks with water cascading around you produces some of Bali's most viral Instagram photos!</p>

<h3>3. Tukad Cepung Waterfall</h3>
<p>Tukad Cepung is hidden inside a sunlit cave canyon. At mid-morning (between 9:00 AM and 11:30 AM), shafts of sunlight beam directly through the top canyon crevice, creating an ethereal, heavenly atmosphere.</p>

<h3>4. Goa Rang Reng Waterfall</h3>
<p>Located near Gianyar village, this gently sloping cascade runs down a series of stepped rocks with a sacred spring cave nearby. It remains far less crowded than central Ubud locations.</p>

<h3>Essential Tips for Waterfall Hopping in Bali</h3>
<ul>
    <li>Wear sturdy water shoes or hiking sandals with good grip; wet river rocks can be slippery.</li>
    <li>Bring dry bags for cameras and smartphones.</li>
    <li>Start early in the morning (around 8:00 AM) to experience the falls in peace and gentle light.</li>
    <li>Hiring a private car with driver makes hopping between 3-4 waterfalls in a single day effortless.</li>
</ul>
HTML,
                'author_name' => 'Made Arta (Senior Bali Guide)',
                'reading_time' => '4 min read',
                'views_count' => 890,
                'is_featured' => true,
                'is_published' => true,
                'published_at' => now()->subDays(6),
            ],
            [
                'title' => 'Nusa Penida One Day Trip: Complete Guide, Best Spots & Budget Tips',
                'slug' => 'nusa-penida-one-day-trip-complete-guide',
                'category' => 'Travel Guide',
                'image_url' => 'https://images.unsplash.com/photo-1544644181-1484b3fdfc62?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Everything you need to know about taking a day trip from Bali to Nusa Penida: speedboat tickets, West vs East coast routes, snorkeling with Manta Rays, and budget estimates.',
                'content' => <<<'HTML'
<h2>Why Nusa Penida is an Absolute Must-Visit</h2>
<p>Located just a 45-minute speedboat ride southeast of Bali mainland, Nusa Penida offers dramatic 200-meter sheer limestone cliffs, turquoise lagoons, and untouched coastal wilderness that feels like a prehistoric lost world.</p>

<h3>How to Get to Nusa Penida from Bali</h3>
<p>Speedboats depart daily from the modern Sanur Harbour terminal starting at 7:30 AM. Boats return from Nusa Penida between 4:00 PM and 4:30 PM. Booking your speedboat ticket together with an island private car package saves you the headache of negotiating on the dock.</p>

<h3>West Coast vs East Coast: Which Should You Pick?</h3>
<h4>Option A: West Nusa Penida (Most Popular)</h4>
<ul>
    <li><strong>Kelingking Beach:</strong> The famous T-Rex shaped cliff overlook offering world-class vistas.</li>
    <li><strong>Broken Beach (Pasih Uug):</strong> A massive circular cliff arch where turquoise waves swirl inside.</li>
    <li><strong>Angel's Billabong:</strong> A natural emerald infinity pool overlooking the open sea.</li>
    <li><strong>Crystal Bay:</strong> Palm-fringed bay ideal for unwinding, fresh coconuts, and swimming.</li>
</ul>

<h4>Option B: East Nusa Penida (Instagram Favorite)</h4>
<ul>
    <li><strong>Diamond Beach:</strong> Pristine white sand framed by giant diamond-shaped karst formations and stairway carved into the cliff.</li>
    <li><strong>Atuh Beach:</strong> Scenic bay with arching ocean rocks and cozy sun loungers.</li>
    <li><strong>Rumah Pohon Molenteng:</strong> The famous Thousand Islands Treehouse view.</li>
</ul>

<h3>Budget & Cost Breakdown</h3>
<p>An all-inclusive private day tour package typically starts around $45 – $65 USD (Rp 750,000 – Rp 1,100,000) per person, covering roundtrip speedboat tickets, private air-conditioned island transport, driver-guide, entrance fees, and mineral water.</p>
HTML,
                'author_name' => 'Bothrex Bali Tour Team',
                'reading_time' => '6 min read',
                'views_count' => 1560,
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(4),
            ],
            [
                'title' => 'Why You Should Hire a Private Car Driver in Bali Instead of Renting a Scooter',
                'slug' => 'why-hire-private-driver-bali-vs-scooter',
                'category' => 'Tips & Trik',
                'image_url' => 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=1200&q=80',
                'excerpt' => 'Is riding a motorbike in Bali worth the risk? Compare costs, comfort, safety, and convenience between self-drive scooters and having a private local driver guide your holiday.',
                'content' => <<<'HTML'
<h2>The Bali Transport Dilemma: Scooter or Private Car?</h2>
<p>Many travelers initially consider renting a scooter to explore Bali, lured by the low daily rental price. However, navigating Bali's narrow, congested roadways and tropical downpours can quickly turn a dream vacation into a stressful ordeal.</p>

<h3>1. Air-Conditioned Comfort in Tropical Heat</h3>
<p>Bali temperatures often reach 32°C (90°F) with high humidity, punctuated by sudden afternoon tropical rainstorms. Traveling in an air-conditioned car lets you rest between sights, recharge your phone, and arrive at every destination fresh and clean.</p>

<h3>2. Safety & Peace of Mind</h3>
<p>Traffic in popular areas like Canggu, Seminyak, and Kuta is notorious for unexpected maneuvers, stray dogs, and unmarked potholes. Scooter accidents are unfortunately the number one medical issue for tourists in Bali. A licensed, experienced local driver guarantees safety for you and your family.</p>

<h3>3. Local Knowledge & Hidden Spots</h3>
<p>A professional Bothrex driver acts as your personal local guide. They know the best times to visit temples before tour buses arrive, the cleanest local restaurants (warung) serving authentic Balinese cuisine, and scenic shortcuts that Google Maps misses.</p>

<h3>4. Surprisingly Affordable for Groups & Couples</h3>
<p>A full 10-hour private car charter with fuel, comfortable 7-seater MPV (Toyota Avanza/Innova), and English-speaking driver starts from only $35 to $45 USD (around Rp 550,000 - Rp 700,000). For a couple or group of friends, the cost per person is barely more than two scooters with fuel and parking.</p>
HTML,
                'author_name' => 'Gede Wirawan (Operations Manager)',
                'reading_time' => '4 min read',
                'views_count' => 2100,
                'is_featured' => false,
                'is_published' => true,
                'published_at' => now()->subDays(2),
            ],
        ];

        foreach ($articles as $art) {
            Article::updateOrCreate(['slug' => $art['slug']], $art);
        }
    }
}
