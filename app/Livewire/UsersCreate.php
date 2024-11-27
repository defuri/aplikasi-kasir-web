<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class UsersCreate extends Component
{
    public $defUsername;
    public $defNamaUser;
    public $defPassword;
    public $defHak;
    public $defTelepon;
    public $defAlamat;

    public function store()
    {
        $this->validate([
            'defUsername' => 'required|string|max:11',
            'defNamaUser' => 'required|string|max:20',
            'defPassword' => 'required|string',
            'defHak' => 'required|in:manager,admin,kasir',
            'defTelepon' => 'required|string',
            'defAlamat' => 'required|string|max:25',
        ]);

        $defData = [
            'username' => $this->defUsername,
            'nama_user' => $this->defNamaUser,
            'password' => Hash::make($this->defPassword),
            'hak' => $this->defHak,
            'telepon' => $this->defTelepon,
            'alamat' => $this->defAlamat,
        ];

        User::create($defData);

        $defIdAkunTerbaru = User::latest()->first()->id_user;

        activity()
            ->useLog('User')
            ->log('INSERT ID ' . $defIdAkunTerbaru);

        session()->flash('success', 'Data berhasil disimpan');

        $this->dispatch('usersAdded');

        $this->reset();
    }


    public function render()
    {
        return view('livewire.users-create');
    }
}
