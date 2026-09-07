@extends('errors.layout', [
    'code' => '404',
    'title' => 'Halaman Liburan Tidak Ditemukan'
])

@section('code', '404')

@section('icon')
<i class="fa-solid fa-map-location-dot"></i>
@endsection

@section('title', 'Ups, Halaman Liburan Tidak Ditemukan!')

@section('message', 'Sepertinya Anda berada di luar rute wisata kami. Halaman yang Anda cari mungkin telah dipindahkan atau tautan yang dimasukkan salah. Yuk, temukan paket liburan impian Anda kembali!')
