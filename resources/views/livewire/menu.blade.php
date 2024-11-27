<div class="col-lg-8 mt-3">
    <div class="mb-4">
        <div class="input-group">
            <input type="text" name="defSearch" id="defSearch" wire:model="defSearch" class="form-control"
                placeholder="Cari menu...">
            <button class="btn btn-outline-primary bg-primary text-white" type="button" wire:click="show">Cari</button>
        </div>
    </div>
    <hr>
    <h4 class="fw-bold">Menu</h4>
    <div class="row g-3" wire:poll>
        @foreach ($defMenu as $defItem)
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $defItem->gambar) }}" class="card-img-top"
                        alt="Gambar Menu">
                    <div class="card-body p-2">
                        <h6 class="card-title mb-1 text-truncate">{{ $defItem->nama_menu }}</h6>
                        <p class="text-muted small mb-1">{{ $defItem->deskripsi }}</p>
                        <p class="fw-bold small">Rp {{ $defItem->harga }}</p>
                        <button class="btn btn-outline-primary btn-sm w-100" wire:click="pesan({{ $defItem }})">Pesan</button>
                    </div>
                </div>
            </div>
        @endforeach

        {{ $defMenu->links() }}
    </div>
</div>
