@extends('layouts.manager.layout')
@section('title', 'Transaksi | Manager')

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush

@section('content')
    @livewire('manager-riwayat-transaksi', ['lazy' => true])
@endsection
