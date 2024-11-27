@extends('layouts.kasir.layout')
@section('title', 'Meja | Kasir')

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush

@section('content')
    <h3 class="fw-bold">Data meja</h3>

    @livewire('kasir-meja')
@endsection
