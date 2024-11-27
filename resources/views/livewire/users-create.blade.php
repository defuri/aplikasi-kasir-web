<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <div class="d-flex justify-content-between mb-4">
        <h3 class="fw-bold">Data User</h3>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah User
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-2">
                        <label for="defUsername" class="form-label">Username</label>
                        <input type="text" name="defUsername" id="defUsername" wire:model="defUsername"
                            class="form-control @error('defUsername') is-invalid @enderror" required
                            placeholder="Masukan username">
                        @error('defUsername')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row mb-2">
                        <label for="defNamaUser" class="form-label">Nama</label>
                        <input type="text" name="defNamaUser" id="defNamaUser" wire:model="defNamaUser"
                            class="form-control @error('defNamaUser') is-invalid @enderror" required
                            placeholder="Masukan nama">
                        @error('defNamaUser')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row mb-2">
                        <label for="defPassword" class="form-label">Password</label>
                        <input type="password" name="defPassword" id="defPassword" wire:model="defPassword"
                            class="form-control @error('defPassword') is-invalid @enderror" required
                            placeholder="Masukan password">
                        @error('defPassword')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row mb-2">
                        <label for="defHak" class="form-label">Hak akses</label>
                        <select name="defHak" id="defHak" class="form-select @error('defHak') is-invalid @enderror"
                            wire:model="defHak">
                            <option value="" selected>Pilih hak</option>
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
                        <label for="defTelepon" class="form-label">Telepon</label>
                        <input type="text" name="defTelepon" id="defTelepon" wire:model="defTelepon"
                            class="form-control @error('defTelepon') is-invalid @enderror" required
                            placeholder="Masukan password">
                        @error('defTelepon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="row mb-2">
                        <label for="defAlamat" class="form-label">Alamat</label>
                        <input type="text" name="defAlamat" id="defAlamat" wire:model="defAlamat"
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
                    <button type="button" id="btnSimpan" class="btn btn-primary"
                        wire:click.prevent="store">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const modalCreate = document.getElementById('exampleModal');
        const inputUsername = document.getElementById('defUsername');

        modalCreate.addEventListener('shown.bs.modal', () => {
            inputUsername.focus();
        });
    </script>
</div>
