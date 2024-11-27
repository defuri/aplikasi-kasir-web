<div>
    <div class="modal fade" id="modalEditMeja" tabindex="-1" aria-labelledby="modalEditMejaLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditMejaLabel">Edit Meja</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="col">ID</th>
                                    <th class="col">Nomor</th>
                                    <th class="col">Status</th>
                                    <th class="col">Ganti Status</th>
                                </tr>
                            </thead>
                            <tbody class="overflow-auto" wire:poll>
                                @foreach ($defMeja as $defItem)
                                    <tr>
                                        <td>{{ $defItem->id_meja }}</td>
                                        <td>{{ $defItem->nomor_meja }}</td>
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
                                @endforeach
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

    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <h4 class="fw-bold">Pilih Meja</h4>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditMeja">Edit
                Meja</button>
        </div>
        <div class="row g-2" wire:poll>
            @foreach ($defMeja as $defItem)
                <div class="col-1">
                    <div wire:click="pilihMeja({{ $defItem->id_meja }})"
                        class="table-grid-item text-center d-flex align-items-center justify-content-center {{ $defPilihMeja == $defItem->id_meja ? 'selected' : ($defItem->status ? 'occupied' : 'available') }}">
                        {{ $defItem->nomor_meja }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@push('styles')
    <style>
        .table-grid-item {
            aspect-ratio: 1/1;
            border: 2px solid #dee2e6;
            border-radius: 0.375rem;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
            height: 80px;
        }

        .table-grid-item.available {
            background-color: #28a745;
            color: white;
        }

        .table-grid-item.occupied {
            background-color: #dc3545;
            color: white;
        }

        .table-grid-item.selected {
            border-color: #007bff;
            border-width: 3px;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }

        .table-grid-item:hover {
            opacity: 0.8;
        }
    </style>
@endpush
