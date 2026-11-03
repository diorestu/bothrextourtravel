<?php

namespace Tests\Feature;

use App\Livewire\TourPackageDetailPage;
use App\Models\Booking;
use App\Models\CompanySetting;
use App\Models\Destination;
use App\Models\TourPackage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TourPackagePriceAndContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_tour_package_published_price_is_10_percent_higher_than_database_price(): void
    {
        $dest = Destination::create([
            'name' => 'Nusa Penida',
            'slug' => 'nusa-penida',
            'category' => 'Island Tour',
            'location' => 'Klungkung, Bali',
            'image_url' => 'https://example.com/dest.jpg',
            'description' => 'Test description',
            'is_popular' => true,
            'is_active' => true,
        ]);

        $pkg = TourPackage::create([
            'destination_id' => $dest->id,
            'title' => 'Paket Tour Nusa Penida',
            'slug' => 'paket-tour-nusa-penida',
            'category' => 'One Day Tour',
            'duration' => '1 Hari',
            'price' => 500000,
            'original_price' => 700000,
            'image_url' => 'https://example.com/pkg.jpg',
            'description' => 'Paket tour hemat bali',
            'is_featured' => true,
            'is_active' => true,
        ]);

        // Raw database price
        $this->assertEquals(500000, $pkg->price);
        $this->assertEquals(700000, $pkg->original_price);

        // Published price (+10% from database price)
        $this->assertEquals(550000, $pkg->published_price);
        $this->assertEquals(770000, $pkg->published_original_price);
        $this->assertEquals('Rp 550.000', $pkg->formatted_published_price);
        $this->assertEquals('Rp 770.000', $pkg->formatted_published_original_price);
    }

    public function test_company_setting_contact_number_is_only_085156432635(): void
    {
        $settings = CompanySetting::getSettings();
        $this->assertEquals('0851-5643-2635', $settings->phone);
        $this->assertEquals('6285156432635', $settings->whatsapp_number);
        $this->assertNull($settings->whatsapp_number_2);

        Destination::create([
            'name' => 'Ubud Bali',
            'slug' => 'ubud-bali',
            'category' => 'Cultural Tour',
            'location' => 'Gianyar, Bali',
            'image_url' => 'https://example.com/ubud.jpg',
            'description' => 'Ubud culture',
            'is_popular' => true,
            'is_active' => true,
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('0851-5643-2635');
        $response->assertSee('6285156432635');
        $response->assertDontSee('CS 1');
        $response->assertDontSee('CS 2');
        $response->assertDontSee('0813-3837-4254');
        $response->assertDontSee('0812-4637-6329');
    }

    public function test_tour_package_detail_page_calculates_and_submits_with_published_price(): void
    {
        $dest = Destination::create([
            'name' => 'Kintamani',
            'slug' => 'kintamani',
            'category' => 'Mountain Tour',
            'location' => 'Bangli, Bali',
            'image_url' => 'https://example.com/kintamani.jpg',
            'description' => 'Kintamani Batur',
            'is_popular' => true,
            'is_active' => true,
        ]);

        $pkg = TourPackage::create([
            'destination_id' => $dest->id,
            'title' => 'Paket Tour Kintamani',
            'slug' => 'paket-tour-kintamani',
            'category' => 'Full Day Tour',
            'duration' => '1 Hari',
            'price' => 500000,
            'original_price' => 700000,
            'image_url' => 'https://example.com/pkg.jpg',
            'description' => 'Kintamani description',
            'is_featured' => true,
            'is_active' => true,
        ]);

        // 2 guests, 1 day => 2 * 1 * 550000 = 1,100,000 (not 1,000,000)
        Livewire::test(TourPackageDetailPage::class, ['slug' => $pkg->slug])
            ->set('number_of_guests', 2)
            ->set('duration_days', 1)
            ->assertSee('Rp 550.000')
            ->assertSee('Rp 770.000')
            ->set('customer_name', 'Budi Santoso')
            ->set('customer_email', 'budi@example.com')
            ->set('customer_phone', '08123456789')
            ->set('travel_date', date('Y-m-d', strtotime('+3 days')))
            ->call('submitBooking')
            ->assertHasNoErrors()
            ->assertSet('showSuccessModal', true);

        $booking = Booking::first();
        $this->assertNotNull($booking);
        $this->assertEquals(1100000, $booking->total_price);
        $this->assertStringContainsString('6285156432635', $booking->whatsapp_link);
        $this->assertNull($booking->whatsapp_link_2);
    }
}
