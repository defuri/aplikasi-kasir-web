@extends('layouts.admin.layout')
@section('title', 'Dashboard | Admin')
@section('content')

    <div class="container-fluid bg-light p-4">
        <div class="card bg-primary text-white mb-4 shadow">
            <div class="card-body">
                <h4 class="card-title mb-1">Selamat datang, {{ Auth::user()->username }}!</h4>
                <p class="card-text">Disini apa yang terjadi di restoran hari ini.</p>
            </div>
        </div>
        <div class="row g-4 mb-4">
            <div class="col-xl-4 col-md-6">
                <div class="card border-0 shadow-lg h-100 bg-gradient-success">
                    <div class="card-body text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1 text-white-50">Total User</h6>
                                <h2 class="mb-0 text-white">{{ $defTotalUser }}</h2>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-users">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card border-0 shadow-lg h-100 bg-gradient-info">
                    <div class="card-body text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1 text-white-50">Aktivitas Hari Ini</h6>
                                <h2 class="mb-0 text-white">{{ $defTotalAktivitas }}</h2>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-chart-area">
                                <path d="M3 3v16a2 2 0 0 0 2 2h16" />
                                <path
                                    d="M7 11.207a.5.5 0 0 1 .146-.353l2-2a.5.5 0 0 1 .708 0l3.292 3.292a.5.5 0 0 0 .708 0l4.292-4.292a.5.5 0 0 1 .854.353V16a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card border-0 shadow-lg h-100 bg-gradient-warning">
                    <div class="card-body text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1 text-white-50">User Baru Hari Ini</h6>
                                <h2 class="mb-0 text-white">{{ $defTotalUserBaru }}</h2>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-user-plus">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <line x1="19" x2="19" y1="8" y2="14" />
                                <line x1="22" x2="16" y1="11" y2="11" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-lg mb-4">
            <div class="card-header bg-gradient-secondary text-white py-3">
                <h5 class="mb-0 text-white">User Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Hak</th>
                                <th>No HP</th>
                                <th>Alamat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($defAkunTerbaru as $defItem)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $defItem->username }}</td>
                                    <td>{{ $defItem->nama_user }}</td>
                                    <td>
                                        @if ($defItem->hak === 'admin')
                                            <span class="badge text-bg-success">{{ $defItem->hak }}</span>
                                        @elseif ($defItem->hak === 'manager')
                                            <span class="badge text-bg-danger">{{ $defItem->hak }}</span>
                                        @else
                                            <span class="badge text-bg-warning">{{ $defItem->hak }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $defItem->telepon }}</td>
                                    <td>{{ $defItem->alamat }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-lg">
            <div class="card-header bg-gradient-secondary text-white py-3">
                <h5 class="mb-0 text-white">Log Aktivitas Terbaru</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Log Name</th>
                                <th>Description</th>
                                <th>Username</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody wire:poll>
                            @foreach ($defAktivitasTerbaru as $defItem)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $defItem->log_name }}</td>
                                    <td>
                                        @php
                                            $defDescription = $defItem->description;
                                            $defBadgeColor = '';

                                            if ($defDescription == 'LOGIN') {
                                                $defBadgeColor = 'success';
                                            } elseif ($defDescription == 'LOGOUT') {
                                                $defBadgeColor = 'danger';
                                            } elseif (str_contains(strtolower($defDescription), 'insert')) {
                                                $defBadgeColor = 'success';
                                            } elseif (str_contains(strtolower($defDescription), 'update')) {
                                                $defBadgeColor = 'warning';
                                            } elseif (str_contains(strtolower($defDescription), 'delete')) {
                                                $defBadgeColor = 'danger';
                                            }
                                        @endphp

                                        @if ($defBadgeColor)
                                            <span
                                                class="badge bg-{{ $defBadgeColor }} text-white">{{ $defDescription }}</span>
                                        @else
                                            {{ $defDescription }}
                                        @endif
                                    </td>
                                    <td>{{ $defItem->causer?->username ?? 'Unknown User' }}</td>
                                    <td>{{ $defItem->created_at->setTimezone('Asia/Jakarta')->format('H:i d-m-Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        /* Gradient background classes */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #28a745 0%, #5cb85c 100%);
        }

        .bg-gradient-info {
            background: linear-gradient(135deg, #17a2b8 0%, #20c997 100%);
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
        }

        .bg-gradient-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #868e96 100%);
        }

        body {
            background-color: #f4f6f9;
        }
    </style>
@endpush
