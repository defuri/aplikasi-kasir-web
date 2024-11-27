@extends('layouts.admin.layout')
@section('title', 'Users | Admin')

@push('styles')
    @livewireStyles
@endpush

@push('scripts')
    @livewireScripts
    <script>
        Livewire.on('usersAdded', () => {
            const modalAdd = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
            modalAdd.hide();
        });

        Livewire.on('usersEdited', () => {
            const modalEdit = bootstrap.Modal.getInstance(document.getElementById('editModal'));
            modalEdit.hide();
        });
    </script>
@endpush

@section('content')
    @livewire('users-create')
    @livewire('users-table')
@endsection
