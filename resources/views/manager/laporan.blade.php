@extends('layouts.manager.layout')
@section('title', 'Laporan | Manager')

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
@endpush

@section('content')
    @livewire('manager-laporan')
@endsection
