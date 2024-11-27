<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersTable extends Component
{
    use WithPagination;

    public $defIdUser;
    public $defUsername;
    public $defNamaUser;
    public $defPassword;
    public $defHak;
    public $defTelepon;
    public $defAlamat;
    public $defCariHak;

    public $defSearch;

    protected $paginationTheme = "bootstrap";

    public function render()
    {
        return view('livewire.users-table', [
            'defUsers' => User::where('nama_user', 'like', '%' . $this->defSearch . '%')
                ->when($this->defCariHak, function ($query) {
                    $query->where('hak', $this->defCariHak);
                })
                ->orderByDesc('id_user')
                ->paginate(10),
        ]);
    }

    public function usersEdit($defUsers)
    {
        $this->defIdUser = $defUsers['id_user'];
        $this->defUsername = $defUsers['username'];
        $this->defNamaUser = $defUsers['nama_user'];
        $this->defHak = $defUsers['hak'];
        $this->defTelepon = $defUsers['telepon'];
        $this->defAlamat = $defUsers['alamat'];
    }


    public function usersUpdate()
    {
        $this->validate([
            'defUsername' => 'required|string|max:11',
            'defNamaUser' => 'required|string|max:20',
            'defHak' => 'required|in:manager,admin,kasir',
            'defTelepon' => 'required|string',
            'defAlamat' => 'required|string|max:25',
        ]);

        $defData = [
            'username' => $this->defUsername,
            'nama_user' => $this->defNamaUser,
            'hak' => $this->defHak,
            'telepon' => $this->defTelepon,
            'alamat' => $this->defAlamat,
        ];

        if ($this->defPassword !== null) {
            $defData['password'] = Hash::make($this->defPassword);
        }

        User::where('id_user', $this->defIdUser)->update($defData);

        activity()->useLog('User')->log('UPDATE ID ' . $this->defIdUser);

        session()->flash('success', 'Data berhasil diubah');

        $this->dispatch('usersEdited');

        $this->reset();
    }

    public function setIdUser($defIdUser)
    {
        $this->defIdUser = $defIdUser;
    }

    public function usersDelete()
    {
        $defUserYangMauDihapus = User::where('id_user', $this->defIdUser)->first();

        if($defUserYangMauDihapus->hak == Auth::user()->hak)
        {
            return redirect()->back();
        }

        activity()
            ->useLog('User')
            ->log('DELETE ID ' . $this->defIdUser);

        User::find($this->defIdUser)->delete();
        $this->defIdUser = null;
    }
}
