<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\CompanySetting;
use App\Models\TourPackage;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class BlogDetailPage extends Component
{
    public string $slug;

    public Article $article;

    public function mount(string $slug): void
    {
        $this->slug = $slug;
        $this->article = Article::published()->where('slug', $slug)->firstOrFail();

        // Increment view count
        $this->article->incrementViews();
    }

    public function render()
    {
        $company = CompanySetting::getSettings();

        // Related articles from same category or latest
        $relatedArticles = Article::published()
            ->where('id', '!=', $this->article->id)
            ->where('category', $this->article->category)
            ->latest('published_at')
            ->take(3)
            ->get();

        if ($relatedArticles->count() < 3) {
            $moreArticles = Article::published()
                ->where('id', '!=', $this->article->id)
                ->whereNotIn('id', $relatedArticles->pluck('id'))
                ->latest('published_at')
                ->take(3 - $relatedArticles->count())
                ->get();
            $relatedArticles = $relatedArticles->concat($moreArticles);
        }

        // Recommended tour packages to convert reader into booking
        $recommendedPackages = TourPackage::where('is_active', true)
            ->where('is_featured', true)
            ->take(2)
            ->get();

        return view('livewire.blog-detail-page', [
            'article' => $this->article,
            'relatedArticles' => $relatedArticles,
            'recommendedPackages' => $recommendedPackages,
            'company' => $company,
        ])->layoutData([
            'title' => $this->article->title.' - '.($company->company_name ?? 'Bothrex Bali Tour'),
            'metaDescription' => $this->article->excerpt,
            'metaKeywords' => 'panduan '.$this->article->title.', wisata bali, liburan bali, itinerary bali, '.$this->article->category,
            'canonical' => url('/blog/'.$this->article->slug),
        ]);
    }
}
