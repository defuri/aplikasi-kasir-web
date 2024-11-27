@extends('layouts.manager.layout')
@section('title', 'Meja | Manager')

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
            const modalEdit = bootstrap.Modal.getInstance(document.getElementById('editModal'));
            modalEdit.hide();
        });
    </script>
@endpush

@section('content')
    @livewire('meja-create')
    @livewire('meja-table')
@endsection
