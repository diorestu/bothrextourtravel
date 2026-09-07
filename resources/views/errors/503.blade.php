@extends('errors.layout', [
    'code' => '503',
    'title' => 'Website Sedang Dalam Pemeliharaan'
])

@section('code', '503')

@section('icon')
<i class="fa-solid fa-gears"></i>
@endsection

@section('title', 'Website Sedang Dalam Pemeliharaan')

@section('message', 'Kami sedang melakukan peningkatan performa dan pemeliharaan berkala demi menghadirkan pengalaman pemesanan yang lebih cepat dan nyaman. Kami akan segera kembali online. Untuk kebutuhan darurat atau pemesanan langsung, hubungi kami via WhatsApp.')
