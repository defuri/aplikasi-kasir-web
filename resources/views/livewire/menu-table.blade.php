<div>
    @include('livewire.menu-edit')
    @include('livewire.menu-destroy')
    @include('livewire.menu-gambar')

    <div class="mb-4 d-sm-flex gap-3 align-items-center">
        <div class="input-group mt-2">
            <input type="text" name="defSearch" id="defSearch" wire:model="defSearch" class="form-control"
                placeholder="Cari nama...">
            <button class="btn btn-outline-primary bg-primary text-white" type="button">Cari</button>
        </div>
        <div class="mt-2" style="flex-shrink: 0; width: auto;">
            <select class="form-select" wire:model="defOption">
                <option value="" selected>Pilih Kategori</option>
                <option value="makanan">Makanan</option>
                <option value="minuman">Minuman</option>
            </select>
        </div>
    </div>

    <!-- Responsive Table -->
    <div class="table-responsive mb-5">
        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr class="text-capitalize">
                    <th scope="col">id</th>
                    <th scope="col">gambar</th>
                    <th scope="col" class="text-nowrap">nama menu</th>
                    <th scope="col">deskripsi</th>
                    <th scope="col">harga</th>
                    <th scope="col">kategori</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody wire:poll>
                @forelse ($defMenu as $defItem)
                    <tr>
                        <td>{{ $defItem->id_menu }}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm text-nowrap" data-bs-toggle="modal"
                                wire:click="showImage('{{ Storage::url($defItem->gambar) }}')"
                                data-bs-target="#gambarModal">
                                Lihat Gambar
                            </button>
                        </td>
                        <td>{{ $defItem->nama_menu }}</td>
                        <td>{{ $defItem->deskripsi }}</td>
                        <td>{{ $defItem->harga }}</td>
                        <td>{{ $defItem->kategori }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-warning btn-sm fw-bold"
                                    wire:click="edit({{ $defItem }})" data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-danger btn-sm fw-bold" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" wire:click="setIdMenu({{ $defItem->id_menu }})">
                                    Delete
                                </button>
                            </div>
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
        {{ $defMenu->links() }}
    </div>
</div>
