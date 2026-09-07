@extends('errors.layout', [
    'code' => '419',
    'title' => 'Sesi Halaman Kedaluwarsa'
])

@section('code', '419')

@section('icon')
<i class="fa-solid fa-clock-rotate-left"></i>
@endsection

@section('title', 'Sesi Halaman Telah Berakhir')

@section('message', 'Sesi formulir booking Anda telah berakhir karena tidak ada aktivitas dalam beberapa waktu. Silakan muat ulang (refresh) halaman ini untuk melanjutkan proses pemesanan dengan aman.')
