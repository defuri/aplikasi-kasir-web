<div>
    @include('livewire.meja-edit')
    @include('livewire.meja-delete')

    <!-- Search Input -->
    <div class="mb-4">
        <div class="input-group">
            <input type="text" name="defSearch" id="defSearch" wire:model="defSearch" class="form-control"
                placeholder="Cari nomor...">
            <button class="btn btn-outline-primary bg-primary text-white" type="button">Cari</button>
        </div>
    </div>

    <!-- Responsive Table -->
    <div class="table-responsive mb-5">
        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nomor Meja</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody wire:poll>
                @forelse ($defMeja as $defItem)
                    <tr>
                        <td>{{ $defItem->id_meja }}</td>
                        <td>{{ $defItem->nomor_meja }}</td>
                        <td>{{ $defItem->keterangan }}</td>
                        <td>
                            @if ($defItem->terisi)
                                <span class="badge text-bg-danger">Terisi</span>
                            @else
                                <span class="badge text-bg-success">Kosong</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-warning btn-sm fw-bold"
                                    wire:click="mejaEdit({{ $defItem }})" data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-danger btn-sm fw-bold" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" wire:click="setIdMeja({{ $defItem->id_meja }})">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-secondary fst-italic">Tidak Ada Data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        {{ $defMeja->links() }}
    </div>
</div>
