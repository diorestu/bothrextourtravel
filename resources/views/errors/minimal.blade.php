@extends('errors.layout', [
    'code' => $exception?->getStatusCode() ?? 'Error',
    'title' => 'Terjadi Kesalahan Sistem'
])

@section('code', $exception?->getStatusCode() ?? 'Error')

@section('icon')
<i class="fa-solid fa-triangle-exclamation"></i>
@endsection

@section('title', 'Terjadi Kesalahan')

@section('message', $exception?->getMessage() ?: 'Terjadi kendala saat memproses permintaan Anda. Silakan kembali ke beranda atau hubungi tim customer service kami via WhatsApp.')
