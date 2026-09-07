@extends('errors.layout', [
    'code' => '403',
    'title' => 'Akses Halaman Dibatasi'
])

@section('code', '403')

@section('icon')
<i class="fa-solid fa-shield-halved"></i>
@endsection

@section('title', 'Akses Halaman Dibatasi')

@section('message', 'Maaf, Anda tidak memiliki izin khusus untuk mengakses halaman ini. Jika Anda administrator Bothrex Tour, silakan masuk melalui halaman login admin.')
