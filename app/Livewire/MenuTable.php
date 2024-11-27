<?php

namespace App\Livewire;

use App\Models\tmenu;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class MenuTable extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $defSelectedImage;

    public $defIdMenu;
    public $defGambar;
    public $defNamaMenu;
    public $defDeskripsi;
    public $defHarga;
    public $defEditGambar;
    public $defKategori;
    public $defSearch = '';
    public $defOption;

    public function render()
    {
        return view('livewire.menu-table', [
            'defMenu' => tmenu::where('nama_menu', 'like', '%' . $this->defSearch . '%')
                ->when($this->defOption, function ($query) {
                    $query->where('kategori', $this->defOption);
                })
                ->orderByDesc('id_menu')
                ->paginate(10),
        ]);
    }

    public function showImage($defImage)
    {
        $this->defSelectedImage = $defImage;

        $this->dispatch('show-gambar-modal');
    }

    public function setIdMenu($defIdMenu)
    {
        $this->defIdMenu = $defIdMenu;
    }

    public function destroy()
    {
        activity()
            ->useLog('Menu')
            ->log('DELETE ID ' . $this->defIdMenu);

        tmenu::find($this->defIdMenu)->delete();

        $this->defIdMenu = null;
    }

    public function edit($defMenu)
    {
        $this->defIdMenu = $defMenu['id_menu'];
        $this->defNamaMenu = $defMenu['nama_menu'];
        $this->defDeskripsi = $defMenu['deskripsi'];
        $this->defHarga = $defMenu['harga'];
        $this->defKategori = $defMenu['kategori'];
        $this->defSelectedImage = Storage::url($defMenu['gambar']);
    }

    public function update()
    {
        $this->validate([
            'defNamaMenu' => 'required|string|max:50',
            'defDeskripsi' => 'required|string|max:50',
            'defHarga' => 'required|integer',
            'defKategori' => 'required|in:makanan,minuman',
            'defGambar' => 'nullable|image|max:3072',
        ]);

        $defData = [
            'nama_menu' => $this->defNamaMenu,
            'deskripsi' => $this->defDeskripsi,
            'harga' => $this->defHarga,
            'kategori' => $this->defKategori,
        ];

        if ($this->defGambar) {
            $imagePath = $this->defGambar->store('gambar-menu', 'public');
            $defData['gambar'] = $imagePath;
        }

        tmenu::find($this->defIdMenu)->update($defData);

        activity()->useLog('Menu')->log('UPDATE ID ' . $this->defIdMenu);

        $this->reset();

        $this->dispatch('dataUpdated');
    }
}
