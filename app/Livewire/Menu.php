<?php

namespace App\Livewire;

use App\Models\tmenu;
use Livewire\Component;
use Livewire\WithPagination;

class Menu extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $defSearch = '';

    public function render()
    {
        return view('livewire.menu', [
            'defMenu' => tmenu::where('nama_menu', 'like', '%' . $this->defSearch . '%')->paginate(10),
        ]);
    }
}
