<?php

namespace App\Livewire;

use App\Models\tmeja;
use Livewire\Component;

class MejaCreate extends Component
{
    public $defNomorMeja;
    public $defKeterangan;

    public function store()
    {
        $this->validate([
            'defNomorMeja' => 'required|string|max:10',
            'defKeterangan' => 'required|string|max:11',
        ]);

        $defMeja = [
            'nomor_meja' => $this->defNomorMeja,
            'keterangan' => $this->defKeterangan,
        ];

        tmeja::create($defMeja);

        $defIdMejaTerbaru = tmeja::latest()->first()->id_meja;

        activity()
            ->useLog('Meja')
            ->log('INSERT ID ' . $defIdMejaTerbaru);

        session()->flash('success', 'Data berhasil disimpan');

        $this->dispatch('dataCreated');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.meja-create');
    }
}
