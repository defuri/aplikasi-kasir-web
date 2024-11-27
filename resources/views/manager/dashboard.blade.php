@extends('layouts.manager.layout')
@section('title', 'Dashboard | Manager')
@section('content')
    <div class="container-fluid">
        <div class="card bg-primary text-white mb-4 shadow">
            <div class="card-body">
                <h4 class="card-title mb-1">Selamat datang, {{ Auth::user()->username }}!</h4>
                <p class="card-text">Disini apa yang terjadi di restoran hari ini.</p>
            </div>
        </div>
        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white h-100 border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-white p-3 me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                fill="none" stroke="#0D6EFD" stroke-width="2.5" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-utensils">
                                <path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2" />
                                <path d="M7 2v20" />
                                <path d="M21 15V2a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7" />
                            </svg>
                        </div>
                        <div>
                            <h6 class="card-title mb-0">Total Menu</h6>
                            <h2 class="mb-0">{{ $defTotalMenu }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-info text-white h-100 border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-white p-3 me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                fill="none" stroke="#0DCAF0" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-users">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            </svg>
                        </div>
                        <div>
                            <h6 class="card-title mb-0">Pengunjung Hari Ini</h6>
                            <h2 class="mb-0">{{ $defJumlahPengunjung }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-white h-100 border-0 shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle bg-white p-3 me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                fill="none" stroke="#FFC107" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-wallet">
                                <path
                                    d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1" />
                                <path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4" />
                            </svg>
                        </div>
                        <div>
                            <h6 class="card-title mb-0">Pendapatan Hari Ini</h6>
                            <h2 class="mb-0">Rp {{ number_format($defPendapatanHariIni, 0, ',', '.') }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Transaksi Terkini</h5>
                            <a href="/manager/transaksi"><button class="btn btn-primary btn-sm">Lihat Semua</button></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover text-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th>Kode Transaksi</th>
                                        <th>Nomor Meja</th>
                                        <th>User</th>
                                        <th>Total Bayar</th>
                                        <th>Jumlah Bayar </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($defTransaksiTerbaru as $defItem)
                                        <tr>
                                            <td>{{ $defItem->kode_transaksi }}</td>
                                            <td>{{ $defItem->tmeja->nomor_meja }}</td>
                                            <td>{{ $defItem->tuser->nama_user }}</td>
                                            <td>Rp {{ number_format($defItem->total_bayar, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format($defItem->jumlah_bayar, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0">
                        <h5 class="mb-0">Menu Terlaris</h5>
                    </div>
                    <div class="card-body">
                        @foreach ($produkTerjual as $defItem)
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $defItem['gambar'] ? Storage::url($defItem['gambar']) : 'https://via.placeholder.com/50' }}"
                                        class="rounded me-2" alt="menu" style="width: 80px">
                                    <div>
                                        <h6 class="mb-0">{{ $defItem['nama_menu'] }}</h6>
                                        <small class="text-muted">Terjual: {{ $defItem['total_terjual'] }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            transition: transform 0.2s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .table> :not(caption)>*>* {
            padding: 1rem 0.75rem;
        }

        .badge {
            padding: 0.5em 0.8em;
        }
    </style>

    @push('scripts')
        <script src="https://kit.fontawesome.com/your-font-awesome-kit.js"></script>
    @endpush
@endsection
