<?php

namespace App\Livewire\Admin;

use App\Models\Article;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class ArticlesManagementPage extends Component
{
    use WithPagination;

    public $search = '';

    public $categoryFilter = 'all';

    // Modal State
    public $showModal = false;

    public $editingId = null;

    // Form fields
    public $title = '';

    public $category = 'Travel Guide';

    public $image_url = 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80';

    public $excerpt = '';

    public $content = '';

    public $author_name = 'Bothrex Bali Tour Team';

    public $reading_time = '5 min read';

    public $is_featured = false;

    public $is_published = true;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategoryFilter(): void
    {
        $this->resetPage();
    }

    public function openCreateModal(): void
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEditModal($id): void
    {
        $article = Article::findOrFail($id);
        $this->editingId = $article->id;
        $this->title = $article->title;
        $this->category = $article->category;
        $this->image_url = $article->image_url;
        $this->excerpt = $article->excerpt;
        $this->content = $article->content;
        $this->author_name = $article->author_name;
        $this->reading_time = $article->reading_time;
        $this->is_featured = (bool) $article->is_featured;
        $this->is_published = (bool) $article->is_published;

        $this->showModal = true;
    }

    public function saveArticle(): void
    {
        $this->validate([
            'title' => 'required|string|max:200',
            'category' => 'required|string|max:50',
            'image_url' => 'required|url',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'author_name' => 'required|string|max:100',
        ], [
            'title.required' => 'Judul artikel wajib diisi.',
            'category.required' => 'Kategori artikel wajib diisi.',
            'image_url.required' => 'URL foto artikel wajib diisi.',
            'image_url.url' => 'Format URL foto tidak valid.',
            'excerpt.required' => 'Ringkasan singkat (excerpt) wajib diisi untuk preview & SEO.',
            'content.required' => 'Isi artikel wajib diisi.',
            'author_name.required' => 'Nama penulis wajib diisi.',
        ]);

        $readingTime = Article::calculateReadingTime($this->content);

        $data = [
            'title' => $this->title,
            'category' => $this->category,
            'image_url' => $this->image_url,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'author_name' => $this->author_name,
            'reading_time' => $readingTime,
            'is_featured' => (bool) $this->is_featured,
            'is_published' => (bool) $this->is_published,
        ];

        if ($this->editingId) {
            Article::findOrFail($this->editingId)->update($data);
            session()->flash('message', 'Artikel berhasil diperbarui!');
        } else {
            $data['slug'] = Str::slug($this->title).'-'.Str::random(4);
            $data['published_at'] = now();
            Article::create($data);
            session()->flash('message', 'Artikel panduan baru berhasil dipublikasikan!');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function togglePublished($id): void
    {
        $article = Article::findOrFail($id);
        $article->is_published = ! $article->is_published;
        if ($article->is_published && ! $article->published_at) {
            $article->published_at = now();
        }
        $article->save();

        $status = $article->is_published ? 'Dipublikasikan (Published)' : 'Draft (Unpublished)';
        session()->flash('message', "Status artikel '{$article->title}' diubah menjadi {$status}.");
    }

    public function toggleFeatured($id): void
    {
        $article = Article::findOrFail($id);
        $article->is_featured = ! $article->is_featured;
        $article->save();

        $status = $article->is_featured ? 'Ditandai Featured' : 'Dihapus dari Featured';
        session()->flash('message', "Status unggulan '{$article->title}' diubah: {$status}.");
    }

    public function deleteArticle($id): void
    {
        $article = Article::findOrFail($id);
        $title = $article->title;
        $article->delete();

        session()->flash('message', "Artikel '{$title}' berhasil dihapus.");
    }

    public function resetForm(): void
    {
        $this->editingId = null;
        $this->title = '';
        $this->category = 'Travel Guide';
        $this->image_url = 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80';
        $this->excerpt = '';
        $this->content = '';
        $this->author_name = 'Bothrex Bali Tour Team';
        $this->reading_time = '5 min read';
        $this->is_featured = false;
        $this->is_published = true;
    }

    public function render()
    {
        $query = Article::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('excerpt', 'like', '%'.$this->search.'%')
                    ->orWhere('category', 'like', '%'.$this->search.'%');
            });
        }

        if ($this->categoryFilter !== 'all') {
            $query->where('category', $this->categoryFilter);
        }

        $articles = $query->orderBy('id', 'desc')->paginate(10);

        return view('livewire.admin.articles-management-page', [
            'articles' => $articles,
        ])->layoutData([
            'title' => 'Kelola Artikel & Blog SEO - Panel Admin Bothrex',
        ]);
    }
}
