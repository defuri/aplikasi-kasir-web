@extends('layouts.kasir.layout')
@section('title', 'Log | Kasir')

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush

@section('content')
    <h3 class="fw-bold">Aktivitas</h3>
    @livewire('table-log')
@endsection
