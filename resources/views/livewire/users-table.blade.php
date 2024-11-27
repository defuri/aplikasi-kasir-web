<div>
    @include('livewire.users-edit')
    @include('livewire.delete-users')

    <!-- Search Input -->
    <div class="mb-4 d-sm-flex gap-3 align-items-center">
        <div class="input-group mt-2">
            <input type="text" name="defSearch" id="defSearch" wire:model="defSearch" class="form-control"
                placeholder="Cari nama...">
            <button class="btn btn-outline-primary bg-primary text-white" type="button">Cari</button>
        </div>
        <div class="mt-2" style="flex-shrink: 0; width: auto;">
            <select class="form-select" wire:model="defCariHak">
                <option value="" selected>Pilih Hak</option>
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
                <option value="kasir">Kasir</option>
            </select>
        </div>
    </div>



    <!-- Responsive Table -->
    <div class="table-responsive mb-5">
        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col" class="text-nowrap">Nama User</th>
                    <th scope="col">Hak</th>
                    <th scope="col">Telepon</th>
                    <th scope="col">Alamat</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody wire:poll>
                @forelse ($defUsers as $defItem)
                    <tr>
                        <td>{{ $defItem->id_user }}</td>
                        <td>{{ $defItem->username }}</td>
                        <td>{{ $defItem->nama_user }}</td>
                        <td>
                            @if ($defItem->hak === 'admin')
                                <span class="badge bg-primary">{{ ucfirst($defItem->hak) }}</span>
                            @elseif ($defItem->hak === 'manager')
                                <span class="badge bg-success">{{ ucfirst($defItem->hak) }}</span>
                            @else
                                <span class="badge bg-danger">{{ ucfirst($defItem->hak) }}</span>
                            @endif
                        </td>
                        <td>{{ $defItem->telepon }}</td>
                        <td class="text-nowrap">{{ $defItem->alamat }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-warning btn-sm fw-bold"
                                    wire:click="usersEdit({{ $defItem }})" data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-danger btn-sm fw-bold" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal" wire:click="setIdUser({{ $defItem->id_user }})">
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
        {{ $defUsers->links() }}
    </div>
</div>
