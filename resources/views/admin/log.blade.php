@extends('layouts.admin.layout')
@section('title', 'Log | Admin')
@section('content')
<h3 class="fw-bold">Log Aktivitas</h3>
    @livewire('table-log')
@endsection
