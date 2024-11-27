<div wire:ignore.self class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Edit User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <label for="defEditUsername" class="form-label">Username</label>
                    <input type="text" name="defUsername" id="defEditUsername" wire:model="defUsername"
                        class="form-control @error('defUsername') is-invalid @enderror" required
                        placeholder="Masukan username">
                    @error('defUsername')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row mb-2">
                    <label for="defEditNamaUser" class="form-label">Nama</label>
                    <input type="text" name="defNamaUser" id="defEditNamaUser" wire:model="defNamaUser"
                        class="form-control @error('defNamaUser') is-invalid @enderror" required
                        placeholder="Masukan nama">
                    @error('defNamaUser')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row mb-2">
                    <label for="defEditPassword" class="form-label">Password</label>
                    <input type="password" name="defPassword" id="defEditPassword" wire:model="defPassword"
                        class="form-control @error('defPassword') is-invalid @enderror" required
                        placeholder="Masukan password baru">
                    @error('defPassword')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row mb-2">
                    <label for="defEditHak" class="form-label">Hak akses</label>
                    <select name="defHak" id="defEditHak" class="form-select @error('defHak') is-invalid @enderror"
                        wire:model="defHak">
                        <option value="">Pilih hak</option>
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                        <option value="kasir">Kasir</option>
                    </select>
                    @error('defHak')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row mb-2">
                    <label for="defEditTelepon" class="form-label">Telepon</label>
                    <input type="text" name="defTelepon" id="defEditTelepon" wire:model="defTelepon"
                        class="form-control @error('defTelepon') is-invalid @enderror" required
                        placeholder="Masukan password">
                    @error('defTelepon')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row mb-2">
                    <label for="defEditAlamat" class="form-label">Alamat</label>
                    <input type="text" name="defAlamat" id="defEditAlamat" wire:model="defAlamat"
                        class="form-control @error('defAlamat') is-invalid @enderror" required
                        placeholder="Masukan alamat">
                    @error('defAlamat')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" id="btnSimpan" class="btn btn-primary" wire:click.prevent="usersUpdate">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
