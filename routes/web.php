<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\HomePage;
use App\Livewire\TourPackagesPage;
use App\Livewire\TourPackageDetailPage;
use App\Livewire\DestinationsPage;
use App\Livewire\DestinationDetailPage;
use App\Livewire\Admin\BookingsPage;

// Public Routes
Route::get('/', HomePage::class)->name('home');
Route::get('/paket', TourPackagesPage::class)->name('packages.index');
Route::get('/paket/{slug}', TourPackageDetailPage::class)->name('packages.show');
Route::get('/destinasi', DestinationsPage::class)->name('destinations.index');
Route::get('/destinasi/{slug}', DestinationDetailPage::class)->name('destinations.show');

// Admin Dashboard Routes
Route::get('/admin/bookings', BookingsPage::class)->name('admin.bookings');
