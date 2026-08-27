<?php

use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', function () {
    return view('components.⚡home-page');
})->name('home');

Route::get('/paket', function () {
    return view('components.⚡tour-packages-page');
})->name('packages.index');

Route::get('/paket/{slug}', function ($slug) {
    return view('components.⚡tour-package-detail-page', ['slug' => $slug]);
})->name('packages.show');

Route::get('/destinasi', function () {
    return view('components.⚡destinations-page');
})->name('destinations.index');

Route::get('/destinasi/{slug}', function ($slug) {
    return view('components.⚡destination-detail-page', ['slug' => $slug]);
})->name('destinations.show');

// Admin Dashboard Routes
Route::get('/admin/bookings', function () {
    return view('components.admin.⚡bookings-page');
})->name('admin.bookings');
