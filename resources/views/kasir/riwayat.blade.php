@extends('layouts.kasir.layout')
@section('title', 'Riwayat Transaksi | Kasir')
@section('content')
    <h1>Riwayat Transaksi</h1>

    @livewire('kasir-riwayat-transaksi', ['lazy' => true])
@endsection
