<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    {{-- <div class="mb-4">
        <div class="input-group">
            <input type="text" name="defSearch" id="defSearch" wire:model="defSearch" class="form-control"
                placeholder="Cari nomor...">
            <button class="btn btn-outline-primary bg-primary text-white" type="button">Cari</button>
        </div>
    </div> --}}

    <!-- Responsive Table -->
    <div class="table-responsive mb-5">
        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nomor Meja</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody wire:poll>
                @forelse ($defMeja as $defItem)
                    <tr>
                        <td>{{ $defItem->id_meja }}</td>
                        <td>{{ $defItem->nomor_meja }}</td>
                        <td>{{ $defItem->keterangan }}</td>
                        <td>
                            @if ($defItem->status)
                                <span class="badge text-bg-danger">TERISI</span>
                            @else
                                <span class="badge text-bg-success">KOSONG</span>
                            @endif
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch"
                                    @if ($defItem->status) checked @endif
                                    wire:click="gantiStatus({{ $defItem->id_meja }})">
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-secondary fst-italic">Tidak Ada Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $defMeja->links() }}
    </div>
</div>
