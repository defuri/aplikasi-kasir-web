<?php

namespace App\Livewire;

use App\Models\tmenu;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class MenuCreate extends Component
{
    use WithFileUploads;

    public $defIdMenu;
    public $defGambar;
    public $defNamaMenu;
    public $defDeskripsi;
    public $defHarga;
    public $defKategori;

    public function render()
    {
        return view('livewire.menu-create');
    }

    public function store()
    {
        $this->validate([
            'defGambar' => 'required|file|image|max:4096',
            'defNamaMenu' => 'required|string|max:50',
            'defDeskripsi' => 'required|string',
            'defHarga' => 'required|integer',
            'defKategori' => 'required|in:makanan,minuman',
        ]);

        $defPath = $this->defGambar->store('gambar-menu', 'public');

        $defData = [
            'gambar' => $defPath,
            'nama_menu' => $this->defNamaMenu,
            'deskripsi' => $this->defDeskripsi,
            'harga' => $this->defHarga,
            'kategori' => $this->defKategori,
        ];

        tmenu::create($defData);

        $defIdMenuTerbaru = tmenu::latest()->first()->id_menu;

        activity()
            ->useLog('Menu')
            ->log('INSERT ID ' . $defIdMenuTerbaru);

        session()->flash('success', 'Data berhasil disimpan');

        $this->reset();

        $this->dispatch('dataCreated');

    }
}
