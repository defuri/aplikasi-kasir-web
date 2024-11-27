@extends('layouts.manager.layout')
@section('title', 'Log | Manager')

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
