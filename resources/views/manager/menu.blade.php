@extends('layouts.manager.layout')
@section('title', 'Menu | Manager')

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
    <script>
        Livewire.on('dataCreated', () => {
            const modalAdd = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
            modalAdd.hide();
        });
        Livewire.on('dataUpdated', () => {
            const editModal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
            editModal.hide();
        });
        const gambarModal = new bootstrap.Modal(document.getElementById('gambarModal'));
        window.addEventListener('show-gambar-modal', () => {
            gambarModal.show();
        });
        window.addEventListener('hide-gambar-modal', () => {
            gambarModal.hide();
        });
    </script>
@endpush

@section('content')
    @livewire('menu-create')
    @livewire('menu-table')
@endsection
