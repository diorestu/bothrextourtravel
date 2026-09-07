@extends('errors.layout', [
    'code' => '500',
    'title' => 'Sedang Ada Kendala Teknis'
])

@section('code', '500')

@section('icon')
<i class="fa-solid fa-screwdriver-wrench"></i>
@endsection

@section('title', 'Sedang Ada Kendala Teknis')

@section('message', 'Sistem kami sedang mengalami sedikit gangguan tak terduga. Tim teknis Bothrex sedang melakukan penanganan. Anda tetap dapat melakukan reservasi dan konsultasi liburan langsung melalui WhatsApp kami!')
