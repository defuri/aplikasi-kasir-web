<div>
    @include('livewire.kasir-modal-detail')
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="table-responsive mb-5">
        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kode Transaksi</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nomor Meja</th>
                    <th scope="col">Total Bayar</th>
                    <th scope="col">Jumlah Bayar</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody wire:poll>
                @forelse ($defData as $defItem)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $defItem->kode_transaksi }}</td>
                        <td>{{ \Carbon\Carbon::parse($defItem->tgl_transaksi)->format('d-m-Y') }}</td>
                        <td>{{ $defItem->tmeja->nomor_meja }}</td>
                        <td>Rp {{ number_format($defItem->total_bayar, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($defItem->jumlah_bayar, 0, ',', '.') }}</td>
                        <td class="align-items-center justify-content-center d-flex gap-2">
                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#modalDetail"
                                wire:click="setDefDipilih({{ $defItem }})">Detail</button>
                            <form action="{{ route('kasir.cetak') }}" method="POST">
                                @csrf
                                <input type="hidden" name="defIdTransaksi" value="{{ $defItem->id_transaksi }}">
                                <button type="submit" class="btn btn-success btn-sm">Cetak</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-secondary fst-italic">Tidak Ada Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        {{ $defData->links() }}
    </div>
</div>
