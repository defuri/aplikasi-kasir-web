<?php

namespace App\Livewire;

use App\Models\tmeja;
use Livewire\Component;

class MejaTable extends Component
{
    public $defIdMeja;
    public $defNomorMeja;
    public $defKeterangan;
    public $defSearch;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.meja-table', [
            'defMeja' => tmeja::where('nomor_meja', 'like', '%' . $this->defSearch . '%')->orderByDesc('id_meja')->paginate(10),
        ]);
    }

    public function mejaEdit($defMeja)
    {
        $this->defIdMeja = $defMeja['id_meja']; // Tambahkan baris ini
        $this->defNomorMeja = $defMeja['nomor_meja'];
        $this->defKeterangan = $defMeja['keterangan'];
    }


    public function mejaUpdate()
    {
        $this->validate([
            'defNomorMeja' => 'required|string|max:10',
            'defKeterangan' => 'required|string|max:11',
        ]);

        $defData = [
            'nomor_meja' => $this->defNomorMeja,
            'keterangan' => $this->defKeterangan,
        ];

        tmeja::where('id_meja', $this->defIdMeja)->update($defData);

        activity()->useLog('Meja')->log('UPDATE ID ' . $this->defIdMeja);

        $this->dispatch('dataUpdated');

        $this->reset();

        session()->flash('success', 'Data berhasil dirubah');
    }

    public function setIdMeja($defIdMeja)
    {
        $this->defIdMeja = $defIdMeja;
    }

    public function delete()
    {
        activity()
            ->useLog('Meja')
            ->log('DELETE ID ' . $this->defIdMeja);

        tmeja::where('id_meja', $this->defIdMeja)->delete();

        session()->flash('success', 'Data berhasil dihapus');

        $this->defIdMeja = null;
    }
}
