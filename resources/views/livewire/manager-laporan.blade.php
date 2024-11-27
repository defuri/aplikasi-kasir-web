<div>
    <div class="container-fluid">

        <h3 class="fw-bold">Data Transaksi</h3>
        <div class="row mb-4 align-items-center">
            <div class="col-md-5">
                <div class="input-group">
                    <input type="date" wire:model="defTanggalMulai"
                        class="form-control @error('defTanggalMulai') is-invalid @enderror">
                    <span class="input-group-text">-</span>
                    <input type="date" wire:model="defTanggalSelesai"
                        class="form-control @error('defTanggalSelesai') is-invalid @enderror">
                </div>
                @error('defTanggalMulai')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                @error('defTanggalSelesai')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="col-md-2">
                <div class="d-flex">
                    <select class="form-select" wire:model="defPegawaiDipilih">
                        <option value="" selected>Pilih Kasir</option>
                        @foreach ($defKasir as $defKasirnya)
                            <option value="{{ $defKasirnya->id_user }}">{{ $defKasirnya->nama_user }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <h4 class="fw-bold">Total pendapatan: Rp {{ number_format($defTotalBayar, 0, ',', '.') }}</h4>
            <button type="button" class="btn btn-success" wire:click="generatePDF">Cetak</button>
        </div>

        <div class="table-responsive mb-5 mt-4">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">Kode Transaksi</th>
                        <th scope="col">No Meja</th>
                        <th scope="col">Kasir</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Total Bayar</th>
                        <th scope="col">Jumlah Bayar</th>
                    </tr>
                </thead>
                <tbody wire:poll>
                    @foreach ($defLaporan as $defItem)
                        <tr>
                            <td>{{ $defItem->kode_transaksi }}</td>
                            <td>{{ $defItem->tmeja->nomor_meja }}</td>
                            <td>{{ $defItem->tuser->nama_user }}</td>
                            <td>{{ \Carbon\Carbon::parse($defItem->tgl_transaksi)->format('d-m-Y') }}</td>
                            <td>Rp {{ number_format($defItem->total_bayar, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($defItem->jumlah_bayar, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $defLaporan->links() }}
        </div>
    </div>
</div>
