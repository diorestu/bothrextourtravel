<?php

namespace Tests\Feature;

use App\Livewire\Admin\ArticlesManagementPage;
use App\Models\Article;
use App\Models\CompanySetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class BlogAndAnalyticsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        CompanySetting::create([
            'company_name' => 'Bothrex Bali Tour',
            'phone' => '0851-5643-2635',
            'whatsapp_number' => '6285156432635',
            'email' => 'info@bothrexbalitour.com',
        ]);
    }

    public function test_blog_index_page_loads_and_displays_articles(): void
    {
        $article = Article::factory()->create([
            'title' => 'Panduan Lengkap Wisata Ubud',
            'slug' => 'panduan-lengkap-wisata-ubud',
            'category' => 'Travel Guide',
            'is_published' => true,
        ]);

        $response = $this->get('/blog');
        $response->assertStatus(200);
        $response->assertSee('Panduan Wisata');
        $response->assertSee('Inspirasi Liburan Bali');
        $response->assertSee('Panduan Lengkap Wisata Ubud');
        $response->assertSee('Travel Guide');
    }

    public function test_artikel_url_redirects_to_blog(): void
    {
        $response = $this->get('/artikel');
        $response->assertRedirect('/blog');
    }

    public function test_blog_detail_page_loads_and_increments_views(): void
    {
        $article = Article::factory()->create([
            'title' => 'Top 10 Hidden Gem Bali',
            'slug' => 'top-10-hidden-gem-bali',
            'category' => 'Hidden Gem',
            'views_count' => 10,
            'is_published' => true,
        ]);

        $response = $this->get('/blog/'.$article->slug);
        $response->assertStatus(200);
        $response->assertSee('Top 10 Hidden Gem Bali');
        $response->assertSee('Hidden Gem');
        $response->assertSee('Chat WhatsApp');
        $response->assertSee('schema.org');
        $response->assertSee('BlogPosting');

        $this->assertEquals(11, $article->fresh()->views_count);
    }

    public function test_ga4_tracking_script_and_helper_are_rendered(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('gtag(\'config\', \'GT-T9WG2WHM\')', false);
        $response->assertSee('window.trackWhatsAppLead', false);
        $response->assertSee('generate_lead');
        $response->assertSee('contact_whatsapp');
    }

    public function test_sitemap_xml_includes_blog_and_articles(): void
    {
        $article = Article::factory()->create([
            'slug' => 'itinerary-5-hari-bali',
            'is_published' => true,
        ]);

        $response = $this->get('/sitemap.xml');
        $response->assertStatus(200);
        $response->assertSee('/blog');
        $response->assertSee('/blog/itinerary-5-hari-bali');
    }

    public function test_admin_articles_page_requires_auth_and_manages_articles(): void
    {
        // Unauthenticated redirect to login
        $this->get('/admin/articles')->assertRedirect(route('admin.login'));

        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/admin/articles');
        $response->assertStatus(200);
        $response->assertSee('Kelola Artikel &amp; Blog SEO', false);

        // Test Livewire component create
        Livewire::test(ArticlesManagementPage::class)
            ->set('title', 'Artikel Baru Bali 2026')
            ->set('category', 'Travel Guide')
            ->set('image_url', 'https://images.unsplash.com/photo-1537996194471-e657df975ab4')
            ->set('excerpt', 'Ini adalah ringkasan panduan wisata bali yang menarik.')
            ->set('content', '<p>Ini adalah isi lengkap artikel panduan.</p>')
            ->set('author_name', 'Bothrex Team')
            ->call('saveArticle')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('articles', [
            'title' => 'Artikel Baru Bali 2026',
            'category' => 'Travel Guide',
        ]);
    }
}
