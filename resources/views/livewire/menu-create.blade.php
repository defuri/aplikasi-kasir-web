<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="d-flex justify-content-between mb-4">
        <h3 class="fw-bold">Data Menu</h3>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah Menu
        </button>
    </div>

    @session('success')
        @livewire('alert-success')
    @endsession

    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Menu</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <label for="defGambar" class="form-label">Masukan gambar</label>
                        <input class="form-control @error('defGambar') is-invalid @enderror" type="file" id="defGambar" wire:model="defGambar"
                            accept="image/*" required>
                        @error('defGambar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row mb-2">
                        <label for="defNamaMenu" class="form-label">Nama menu</label>
                        <input type="text" name="defNamaMenu" id="defNamaMenu" wire:model="defNamaMenu"
                            class="form-control @error('defNamaMenu') is-invalid @enderror" required
                            placeholder="Masukan nama">
                        @error('defNamaMenu')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row mb-2">
                        <label for="defDeskripsi" class="form-label">Deskripsi</label>
                        <textarea name="defDeskripsi" id="defDeskripsi" wire:model="defDeskripsi"
                            class="form-control @error('defDeskripsi') is-invalid @enderror" required
                            placeholder="Masukan deskripsi"></textarea>
                        @error('defDeskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row mb-2">
                        <label for="defHarga" class="form-label">Harga</label>
                        <input type="number" min="1" name="defHarga" id="defHarga" wire:model="defHarga"
                            class="form-control @error('defHarga') is-invalid @enderror" required oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                            placeholder="Masukan harga">
                        @error('defHarga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row mb-2">
                        <label for="defKategori" class="form-label">Kategori</label>
                        <select name="defKategori" id="defKategori"
                            class="form-select @error('defKategori') is-invalid @enderror" wire:model="defKategori">
                            <option value="" selected>Pilih kategori</option>
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                        </select>
                        @error('defKategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="btnSimpan" class="btn btn-primary"
                        wire:click.prevent="store">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const modalCreate = document.getElementById('exampleModal');
        const inputUsername = document.getElementById('defGambar');

        modalCreate.addEventListener('shown.bs.modal', () => {
            inputUsername.focus();
        });
    </script>
</div>
