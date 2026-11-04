<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\CompanySetting;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class BlogPage extends Component
{
    use WithPagination;

    #[Url]
    public string $search = '';

    #[Url]
    public string $category = 'all';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategory(): void
    {
        $this->resetPage();
    }

    public function selectCategory(string $category): void
    {
        $this->category = $category;
        $this->resetPage();
    }

    public function render()
    {
        $company = CompanySetting::getSettings();

        $query = Article::published();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('excerpt', 'like', '%'.$this->search.'%')
                    ->orWhere('content', 'like', '%'.$this->search.'%');
            });
        }

        if ($this->category !== 'all') {
            $query->where('category', $this->category);
        }

        $articles = $query->orderBy('is_featured', 'desc')
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $categories = [
            'all' => 'Semua Panduan',
            'Travel Guide' => 'Travel Guide',
            'Itinerary' => 'Itinerary',
            'Tips & Trik' => 'Tips & Trik',
            'Hidden Gem' => 'Hidden Gem',
        ];

        $featuredArticle = Article::published()->featured()->latest('published_at')->first();

        return view('livewire.blog-page', [
            'articles' => $articles,
            'categories' => $categories,
            'featuredArticle' => $featuredArticle,
            'company' => $company,
        ])->layoutData([
            'title' => 'Panduan Wisata & Blog Liburan Bali - '.($company->company_name ?? 'Bothrex Bali Tour'),
            'metaDescription' => 'Kumpulan panduan wisata Bali terlengkap, rekomendasi itinerary, tips liburan hemat, dan tempat wisata tersembunyi di Bali dari tim lokal berpengalaman.',
            'metaKeywords' => 'blog wisata bali, panduan liburan bali, itinerary bali 5 hari, tips sewa supir bali, nusa penida day trip guide, hidden gem bali, bothrex tour blog',
            'canonical' => url('/blog'),
        ]);
    }
}
