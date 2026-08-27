<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\CompanySetting;

#[Layout('layouts.app')]
class CompanySettingsPage extends Component
{
    public $company_name;
    public $tagline;
    public $phone;
    public $whatsapp_number;
    public $email;
    public $address;
    public $operating_hours;
    public $about_text;
    public $instagram_url;
    public $facebook_url;
    public $tiktok_url;
    public $youtube_url;
    public $bank_info;

    public function mount()
    {
        $settings = CompanySetting::getSettings();
        $this->company_name = $settings->company_name;
        $this->tagline = $settings->tagline;
        $this->phone = $settings->phone;
        $this->whatsapp_number = $settings->whatsapp_number;
        $this->email = $settings->email;
        $this->address = $settings->address;
        $this->operating_hours = $settings->operating_hours;
        $this->about_text = $settings->about_text;
        $this->instagram_url = $settings->instagram_url;
        $this->facebook_url = $settings->facebook_url;
        $this->tiktok_url = $settings->tiktok_url;
        $this->youtube_url = $settings->youtube_url;
        $this->bank_info = $settings->bank_info;
    }

    public function saveSettings()
    {
        $this->validate([
            'company_name' => 'required|string|max:100',
            'phone' => 'required|string|max:50',
            'whatsapp_number' => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'address' => 'required|string|max:255',
        ], [
            'company_name.required' => 'Nama perusahaan wajib diisi.',
            'phone.required' => 'Nomor telepon CS wajib diisi.',
            'whatsapp_number.required' => 'Nomor WhatsApp CS wajib diisi.',
            'email.required' => 'Email perusahaan wajib diisi.',
            'address.required' => 'Alamat kantor wajib diisi.',
        ]);

        $settings = CompanySetting::getSettings();
        $settings->update([
            'company_name' => $this->company_name,
            'tagline' => $this->tagline,
            'phone' => $this->phone,
            'whatsapp_number' => $this->whatsapp_number,
            'email' => $this->email,
            'address' => $this->address,
            'operating_hours' => $this->operating_hours,
            'about_text' => $this->about_text,
            'instagram_url' => $this->instagram_url,
            'facebook_url' => $this->facebook_url,
            'tiktok_url' => $this->tiktok_url,
            'youtube_url' => $this->youtube_url,
            'bank_info' => $this->bank_info,
        ]);

        session()->flash('message', 'Data profil & kontak perusahaan berhasil disimpan!');
    }

    public function render()
    {
        return view('livewire.admin.company-settings-page');
    }
}
