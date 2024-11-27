<div class="container-fluid pb-4">

    @include('livewire.kasir-nomor-meja')

    <div class="row">
        @include('livewire.menu')

        <div class="col-lg-4">
            <div class="card shadow-sm position-sticky" style="top: 90px;">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">Keranjang</h6>
                        <h6 class="mb-0 fw-bold">{{ $defKodeTransaksi }}</h6>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-trash-2 cursor-pointer" style="color: red;"
                        wire:click="hapusKeranjang">
                        <path d="M3 6h18" />
                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                        <line x1="10" x2="10" y1="11" y2="17" />
                        <line x1="14" x2="14" y1="11" y2="17" />
                    </svg>
                </div>
                <div class="overflow-auto" style="max-height: 30vh">
                    @foreach ($defKeranjang as $defItem)
                        <div class="card-body p-3 position-relative">
                            <div class="d-flex align-items-center mb-3">
                                <div style="width: 60px; height: 60px;" class="me-2">
                                    <img src="{{ Storage::url($defItem->menu->gambar) }}" class="rounded w-100 h-100"
                                        alt="{{ $defItem->menu->nama_menu }}" style="object-fit: cover;">
                                </div>
                                <div class="flex-grow-1">
                                    <span class="d-block small">{{ $defItem->menu->nama_menu }}</span>
                                    <small class="text-muted">Rp
                                        {{ number_format($defItem->subtotal, 0, ',', '.') }}</small>
                                </div>
                            </div>
                            <div class="input-group input-group-sm w-auto">
                                <button class="btn btn-outline-secondary" type="button"
                                    wire:click="tombolKurang({{ $defItem->idm }})">-</button>
                                <input type="number" class="form-control text-center" min="1"
                                    wire:model.live="defItem.quantity"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                    wire:change="updateQuantity({{ $defItem->idm }}, $event.target.value)"
                                    value="{{ $defItem->quantity }}">
                                <button class="btn btn-outline-secondary" type="button"
                                    wire:click="pesan({{ $defItem->idm }})">+</button>
                            </div>
                            <i class="fa-solid fa-x"
                                style="color: black; cursor: pointer; position: absolute; right: 25px; top: 15px"
                                wire:click="hapusMenu({{ $defItem->idm }})"></i>
                        </div>
                    @endforeach
                </div>

                <form>
                    <div class="card-footer bg-light">
                        <div class="mb-3">
                            <label class="form-label small">Total Bayar</label>
                            <input type="number"
                                class="form-control form-control-sm @error('defBayar') is-invalid @enderror"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '');" min="1"
                                placeholder="Masukan total bayar" wire:model="defBayar" required>
                            @error('defBayar')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label small">Meja</label>
                            <select class="form-select form-select-sm @error('defPilihMeja') is-invalid @enderror"
                                aria-label="Default select example" wire:model="defPilihMeja">
                                <option selected>Pilih meja</option>
                                @foreach ($defMejaKosong as $defItem)
                                    <option value="{{ $defItem->id_meja }}">{{ $defItem->nomor_meja }}</option>
                                @endforeach
                            </select>
                            @error('defPilihMeja')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Kembalian:</span>
                            <span>Rp {{ number_format($defKembali, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between fw-bold mb-2">
                            <span>Total:</span>
                            <span>Rp {{ number_format($defTotal, 0, ',', '.') }}</span>
                        </div>
                        <button class="btn btn-primary btn-sm w-100" wire:click.prevent="bayar">Selesaikan
                            Pesanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
