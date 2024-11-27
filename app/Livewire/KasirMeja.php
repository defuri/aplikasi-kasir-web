<?php

namespace App\Livewire;

use App\Models\tmeja;
use Livewire\Component;
use Livewire\WithPagination;

class KasirMeja extends Component
{
    use WithPagination;
    public $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.kasir-meja', [
            'defMeja' => tmeja::orderByDesc('id_meja')->paginate(10),
        ]);
    }

    public function gantiStatus($defIdMeja)
    {
        $defMeja = tmeja::where('id_meja', $defIdMeja)->first();

        activity()->useLog('Meja')->log('UPDATE ID ' . $defIdMeja);

        if ($defMeja->status) {
            $defMeja->status = false;
            $defMeja->save();
        } else {
            $defMeja->status = true;
            $defMeja->save();
        }
    }
}
