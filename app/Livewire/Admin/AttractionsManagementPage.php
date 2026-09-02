<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Attraction;
use App\Models\AttractionCategory;
use App\Models\Destination;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
class AttractionsManagementPage extends Component
{
    public $activeTab = 'attractions'; // 'attractions' or 'categories'
    public $search = '';

    // Modals
    public $showAttractionModal = false;
    public $showCategoryModal = false;
    public $editingAttractionId = null;
    public $editingCategoryId = null;

    // Attraction Form Fields
    public $destination_id = '';
    public $attraction_category_id = '';
    public $attraction_name = '';
    public $attraction_location = '';
    public $attraction_image_url = 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80';
    public $attraction_description = '';
    public $attraction_ticket_price_info = 'Termasuk dalam paket tour';
    public $attraction_is_active = true;

    // Category Form Fields
    public $category_name = '';
    public $category_icon = 'fa-umbrella-beach';
    public $category_description = '';
    public $category_is_active = true;

    public function mount()
    {
        $firstDest = Destination::first();
        if ($firstDest) {
            $this->destination_id = $firstDest->id;
        }

        $firstCat = AttractionCategory::first();
        if ($firstCat) {
            $this->attraction_category_id = $firstCat->id;
        }
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->search = '';
    }

    // --- ATTRACTIONS CRUD ---
    public function openCreateAttractionModal()
    {
        $this->resetAttractionForm();
        $this->showAttractionModal = true;
    }

    public function openEditAttractionModal($id)
    {
        $attr = Attraction::findOrFail($id);
        $this->editingAttractionId = $attr->id;
        $this->destination_id = $attr->destination_id;
        $this->attraction_category_id = $attr->attraction_category_id;
        $this->attraction_name = $attr->name;
        $this->attraction_location = $attr->location;
        $this->attraction_image_url = $attr->image_url;
        $this->attraction_description = $attr->description;
        $this->attraction_ticket_price_info = $attr->ticket_price_info;
        $this->attraction_is_active = $attr->is_active;

        $this->showAttractionModal = true;
    }

    public function saveAttraction()
    {
        $this->validate([
            'destination_id' => 'required|exists:destinations,id',
            'attraction_name' => 'required|string|max:100',
            'attraction_image_url' => 'required|url',
        ], [
            'destination_id.required' => 'Destinasi wilayah wajib dipilih.',
            'attraction_name.required' => 'Nama tempat wisata wajib diisi.',
            'attraction_image_url.required' => 'URL foto tempat wisata wajib diisi.',
        ]);

        $data = [
            'destination_id' => $this->destination_id,
            'attraction_category_id' => $this->attraction_category_id ?: null,
            'name' => $this->attraction_name,
            'slug' => Str::slug($this->attraction_name) . ($this->editingAttractionId ? '' : '-' . Str::random(3)),
            'location' => $this->attraction_location,
            'image_url' => $this->attraction_image_url,
            'description' => $this->attraction_description,
            'ticket_price_info' => $this->attraction_ticket_price_info,
            'is_active' => $this->attraction_is_active,
        ];

        if ($this->editingAttractionId) {
            unset($data['slug']);
            Attraction::findOrFail($this->editingAttractionId)->update($data);
            session()->flash('message', 'Tempat wisata berhasil diperbarui!');
        } else {
            Attraction::create($data);
            session()->flash('message', 'Tempat wisata baru berhasil ditambahkan!');
        }

        $this->showAttractionModal = false;
        $this->resetAttractionForm();
    }

    public function toggleAttractionActive($id)
    {
        $attr = Attraction::findOrFail($id);
        $attr->is_active = !$attr->is_active;
        $attr->save();

        $statusText = $attr->is_active ? 'Diaktifkan (Enabled)' : 'Dinonaktifkan (Disabled)';
        session()->flash('message', "Status tempat wisata '{$attr->name}' diubah menjadi {$statusText}.");
    }

    public function deleteAttraction($id)
    {
        $attr = Attraction::findOrFail($id);
        $name = $attr->name;
        $attr->delete();

        session()->flash('message', "Tempat wisata '{$name}' telah dihapus.");
    }

    private function resetAttractionForm()
    {
        $this->editingAttractionId = null;
        $this->attraction_name = '';
        $this->attraction_location = '';
        $this->attraction_image_url = 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80';
        $this->attraction_description = '';
        $this->attraction_ticket_price_info = 'Termasuk dalam paket tour';
        $this->attraction_is_active = true;
    }

    // --- CATEGORIES CRUD ---
    public function openCreateCategoryModal()
    {
        $this->resetCategoryForm();
        $this->showCategoryModal = true;
    }

    public function openEditCategoryModal($id)
    {
        $cat = AttractionCategory::findOrFail($id);
        $this->editingCategoryId = $cat->id;
        $this->category_name = $cat->name;
        $this->category_icon = $cat->icon;
        $this->category_description = $cat->description;
        $this->category_is_active = $cat->is_active;

        $this->showCategoryModal = true;
    }

    public function saveCategory()
    {
        $this->validate([
            'category_name' => 'required|string|max:100',
            'category_icon' => 'required|string|max:50',
        ], [
            'category_name.required' => 'Nama kategori tempat wisata wajib diisi.',
            'category_icon.required' => 'Icon kategori wajib diisi.',
        ]);

        $data = [
            'name' => $this->category_name,
            'slug' => Str::slug($this->category_name) . ($this->editingCategoryId ? '' : '-' . Str::random(3)),
            'icon' => $this->category_icon,
            'description' => $this->category_description,
            'is_active' => $this->category_is_active,
        ];

        if ($this->editingCategoryId) {
            unset($data['slug']);
            AttractionCategory::findOrFail($this->editingCategoryId)->update($data);
            session()->flash('message', 'Kategori tempat wisata berhasil diperbarui!');
        } else {
            AttractionCategory::create($data);
            session()->flash('message', 'Kategori tempat wisata baru berhasil ditambahkan!');
        }

        $this->showCategoryModal = false;
        $this->resetCategoryForm();
    }

    public function toggleCategoryActive($id)
    {
        $cat = AttractionCategory::findOrFail($id);
        $cat->is_active = !$cat->is_active;
        $cat->save();

        $statusText = $cat->is_active ? 'Diaktifkan (Enabled)' : 'Dinonaktifkan (Disabled)';
        session()->flash('message', "Status kategori '{$cat->name}' diubah menjadi {$statusText}.");
    }

    public function deleteCategory($id)
    {
        $cat = AttractionCategory::findOrFail($id);
        $name = $cat->name;
        $cat->delete();

        session()->flash('message', "Kategori '{$name}' telah dihapus.");
    }

    private function resetCategoryForm()
    {
        $this->editingCategoryId = null;
        $this->category_name = '';
        $this->category_icon = 'fa-umbrella-beach';
        $this->category_description = '';
        $this->category_is_active = true;
    }

    public function render()
    {
        $destinations = Destination::all();
        $categories = AttractionCategory::withCount('attractions')->get();

        $attractionsQuery = Attraction::with(['destination', 'category']);

        if (!empty($this->search)) {
            $attractionsQuery->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('location', 'like', '%' . $this->search . '%');
            });
        }

        $attractions = $attractionsQuery->latest()->get();

        return view('livewire.admin.attractions-management-page', [
            'attractions' => $attractions,
            'categories' => $categories,
            'destinations' => $destinations,
        ]);
    }
}
