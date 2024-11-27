<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class TableLog extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function render()
    {
        if (Auth::user()->hak === 'admin') {
            $defActivities = Activity::with('causer')
                ->orderBy('id', 'desc')
                ->paginate(10);
        }
        else if (Auth::user()->hak === 'manager') {
            $defActivities = Activity::with('causer')
                ->whereHas('causer', function ($query) {
                    $query->where('hak', 'kasir');
                })
                ->orderBy('id', 'desc')
                ->paginate(10);
        }

        return view('livewire.table-log', [
            'defLog' => $defActivities
        ]);
    }
}
