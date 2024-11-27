<div class="modal fade" id="modalDetail" tabindex="-1" aria-labelledby="modalDetailLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalDetailLabel">Detail Transaksi </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Menu</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">harga</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($defDipilih)
                                @foreach ($defDipilih as $defItem)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $defItem->tmenu->nama_menu }}</td>
                                        <td>{{ $defItem->jumlah }}</td>
                                        <td>Rp {{ number_format($defItem->harga, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($defItem->sub_total, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">Sedang Memuat</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
