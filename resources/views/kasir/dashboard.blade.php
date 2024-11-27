@extends('layouts.kasir.layout')
@section('title', 'Dashboard | Kasir')
@section('content')

    <div class="container-fluid">
        <div class="card bg-primary text-white mb-4 shadow">
            <div class="card-body">
                <h4 class="card-title mb-1">Selamat datang, {{ Auth::user()->username }}!</h4>
                <p class="card-text">Disini apa yang terjadi di restoran hari ini.</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 bg-success text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Penjualan Hari Ini</div>
                                <div class="h5 mb-0 font-weight-bold">Rp
                                    {{ number_format($defPenjualanHariIni, 0, ',', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-white-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2 bg-primary text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Total Transaksi</div>
                                <div class="h5 mb-0 font-weight-bold">{{ $defTotalTransaksi }} Transaksi</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-white-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2 bg-warning text-white">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Menu Terjual</div>
                                <div class="h5 mb-0 font-weight-bold">{{ $defTotalItemTerjual }} Item</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-white-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 fw-bold">Transaksi Terbaru</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Kode Transaksi</th>
                                        <th>No Meja</th>
                                        <th>Total Bayar</th>
                                        <th>Jumlah Bayar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($defTransaksiTerbaru as $defItem)
                                        <tr>
                                            <td>{{ $defItem->kode_transaksi }}</td>
                                            <td>{{ $defItem->tmeja->nomor_meja }}</td>
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

            <div class="col-xl-4 col-lg-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-secondary border border-dark-subtle">
                        <h5 class="mb-0">Menu Terlaris</h5>
                    </div>
                    <div class="card-body border border-dark-subtle">
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

@endsection
