<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit Meja</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <label for="defNomorMeja" class="form-label">Nomor meja</label>
                    <input type="text" name="defNomorMeja" id="defNomorMeja" wire:model="defNomorMeja"
                        class="form-control @error('defNomorMeja') is-invalid @enderror" required
                        placeholder="Masukan nomor meja">
                    @error('defNomorMeja')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row mb-2">
                    <label for="defKeterangan" class="form-label">Keterangan</label>
                    <input type="text" name="defKeterangan" id="defKeterangan" wire:model="defKeterangan"
                        class="form-control @error('defKeterangan') is-invalid @enderror" required
                        placeholder="Masukan keterangan">
                    @error('defKeterangan')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSimpan" class="btn btn-primary"
                    wire:click.prevent="mejaUpdate">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
