<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Destination;
use Illuminate\Support\Str;

#[Layout('layouts.app')]
class DestinationsManagementPage extends Component
{
    public $search = '';

    // Modal State
    public $showModal = false;
    public $editingId = null;

    // Form fields
    public $name = '';
    public $category = 'Budaya & Seni';
    public $location = 'Gianyar, Bali';
    public $image_url = 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=1200&q=80';
    public $description = '';
    public $highlights_text = "Spot Foto\nKuliner Lokal\nKeindahan Alam";
    public $is_popular = true;
    public $is_active = true;

    public function openCreateModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function openEditModal($id)
    {
        $dest = Destination::findOrFail($id);
        $this->editingId = $dest->id;
        $this->name = $dest->name;
        $this->category = $dest->category;
        $this->location = $dest->location;
        $this->image_url = $dest->image_url;
        $this->description = $dest->description;
        $this->highlights_text = implode("\n", $dest->highlights ?? []);
        $this->is_popular = $dest->is_popular;
        $this->is_active = $dest->is_active;

        $this->showModal = true;
    }

    public function saveDestination()
    {
        $this->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:50',
            'location' => 'required|string|max:100',
            'image_url' => 'required|url',
            'description' => 'required|string',
        ], [
            'name.required' => 'Nama destinasi wajib diisi.',
            'location.required' => 'Lokasi destinasi wajib diisi.',
            'image_url.required' => 'URL foto destinasi wajib diisi.',
        ]);

        $highlights = array_values(array_filter(array_map('trim', explode("\n", $this->highlights_text))));

        $data = [
            'name' => $this->name,
            'slug' => Str::slug($this->name) . ($this->editingId ? '' : '-' . Str::random(3)),
            'category' => $this->category,
            'location' => $this->location,
            'image_url' => $this->image_url,
            'description' => $this->description,
            'highlights' => $highlights,
            'is_popular' => $this->is_popular,
            'is_active' => $this->is_active,
        ];

        if ($this->editingId) {
            unset($data['slug']);
            Destination::findOrFail($this->editingId)->update($data);
            session()->flash('message', 'Data destinasi berhasil diperbarui!');
        } else {
            Destination::create($data);
            session()->flash('message', 'Destinasi wisata baru berhasil ditambahkan!');
        }

        $this->showModal = false;
        $this->resetForm();
    }

    public function toggleActive($id)
    {
        $dest = Destination::findOrFail($id);
        $dest->is_active = !$dest->is_active;
        $dest->save();

        $statusText = $dest->is_active ? 'Diaktifkan (Enabled)' : 'Dinonaktifkan (Disabled)';
        session()->flash('message', "Status destinasi '{$dest->name}' diubah menjadi {$statusText}.");
    }

    public function deleteDestination($id)
    {
        $dest = Destination::findOrFail($id);
        $name = $dest->name;
        $dest->delete();

        session()->flash('message', "Destinasi wisata '{$name}' berhasil dihapus.");
    }

    public function resetForm()
    {
        $this->editingId = null;
        $this->name = '';
        $this->category = 'Budaya & Seni';
        $this->location = 'Gianyar, Bali';
        $this->image_url = 'https://images.unsplash.com/photo-1555400038-63f5ba517a47?auto=format&fit=crop&w=1200&q=80';
        $this->description = '';
        $this->highlights_text = "Spot Foto\nKuliner Lokal\nKeindahan Alam";
        $this->is_popular = true;
        $this->is_active = true;
    }

    public function render()
    {
        $query = Destination::withCount('packages');

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('location', 'like', '%' . $this->search . '%');
        }

        $destinations = $query->latest()->get();

        return view('livewire.admin.destinations-management-page', [
            'destinations' => $destinations,
        ]);
    }
}
