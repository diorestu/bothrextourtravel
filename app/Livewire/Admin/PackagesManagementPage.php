<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\TourPackage;
use App\Models\Destination;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
class PackagesManagementPage extends Component
{
    public $search = '';

    // Modal state
    public $showModal = false;
    public $editingId = null;

    // Form fields
    public $destination_id;
    public $title = '';
    public $category = 'Full Day Tour';
    public $duration = '1 Hari (08:00 - 18:00)';
    public $price = 500000;
    public $original_price = 700000;
    public $badge = '';
    public $image_url = 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80';
    public $description = '';
    public $inclusions_text = "Mobil Privat AC + Supir + BBM\nTiket Masuk Tempat Wisata\nMakan Siang Resto Lokal\nAir Mineral";
    public $exclusions_text = "Pengeluaran Pribadi\nTip Supir (Sukarela)";
    public $is_featured = false;
    public $is_active = true;

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEditModal($id)
    {
        $pkg = TourPackage::findOrFail($id);
        $this->editingId = $pkg->id;
        $this->destination_id = $pkg->destination_id;
        $this->title = $pkg->title;
        $this->category = $pkg->category;
        $this->duration = $pkg->duration;
        $this->price = $pkg->price;
        $this->original_price = $pkg->original_price;
        $this->badge = $pkg->badge;
        $this->image_url = $pkg->image_url;
        $this->description = $pkg->description;
        $this->inclusions_text = implode("\n", $pkg->inclusions ?? []);
        $this->exclusions_text = implode("\n", $pkg->exclusions ?? []);
        $this->is_featured = $pkg->is_featured;
        $this->is_active = $pkg->is_active;

        $this->showModal = true;
    }

    public function savePackage()
    {
        $this->validate([
            'title' => 'required|string|max:150',
            'destination_id' => 'required|exists:destinations,id',
            'category' => 'required|string|max:50',
            'duration' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'image_url' => 'required|url',
            'description' => 'required|string',
        ], [
            'title.required' => 'Judul paket wisata wajib diisi.',
            'destination_id.required' => 'Destinasi wajib dipilih.',
            'price.required' => 'Harga wajib diisi.',
            'image_url.required' => 'URL gambar banner wajib diisi.',
        ]);

        $inclusions = array_values(array_filter(array_map('trim', explode("\n", $this->inclusions_text))));
        $exclusions = array_values(array_filter(array_map('trim', explode("\n", $this->exclusions_text))));

        $data = [
            'destination_id' => $this->destination_id,
            'title' => $this->title,
            'slug' => Str::slug($this->title) . ($this->editingId ? '' : '-' . Str::random(3)),
            'category' => $this->category,
            'duration' => $this->duration,
            'price' => $this->price,
            'original_price' => $this->original_price ?: null,
            'badge' => $this->badge ?: null,
            'image_url' => $this->image_url,
            'description' => $this->description,
            'inclusions' => $inclusions,
            'exclusions' => $exclusions,
            'is_featured' => $this->is_featured,
            'is_active' => $this->is_active,
        ];

        if ($this->editingId) {
            unset($data['slug']); // keep existing slug
            TourPackage::findOrFail($this->editingId)->update($data);
            session()->flash('message', 'Paket wisata berhasil diperbarui!');
        } else {
            TourPackage::create($data);
            session()->flash('message', 'Paket wisata baru berhasil ditambahkan!');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function toggleActive($id)
    {
        $pkg = TourPackage::findOrFail($id);
        $pkg->is_active = !$pkg->is_active;
        $pkg->save();

        $statusText = $pkg->is_active ? 'Diaktifkan (Enabled)' : 'Dinonaktifkan (Disabled)';
        session()->flash('message', "Status paket '{$pkg->title}' diubah menjadi {$statusText}.");
    }

    public function deletePackage($id)
    {
        $pkg = TourPackage::findOrFail($id);
        $title = $pkg->title;
        $pkg->delete();

        session()->flash('message', "Paket wisata '{$title}' berhasil dihapus.");
    }

    public function resetForm()
    {
        $this->editingId = null;
        $this->destination_id = Destination::first()->id ?? null;
        $this->title = '';
        $this->category = 'Full Day Tour';
        $this->duration = '1 Hari (08:00 - 18:00)';
        $this->price = 500000;
        $this->original_price = 700000;
        $this->badge = '';
        $this->image_url = 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80';
        $this->description = '';
        $this->inclusions_text = "Mobil Privat AC + Supir + BBM\nTiket Masuk Tempat Wisata\nMakan Siang Resto Lokal\nAir Mineral";
        $this->exclusions_text = "Pengeluaran Pribadi\nTip Supir (Sukarela)";
        $this->is_featured = false;
        $this->is_active = true;
    }

    public function render()
    {
        $destinations = Destination::all();

        $query = TourPackage::with('destination');

        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
        }

        $packages = $query->latest()->get();

        return view('livewire.admin.packages-management-page', [
            'packages' => $packages,
            'destinations' => $destinations,
        ]);
    }
}
