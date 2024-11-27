<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\User;
use Livewire\Component;
use App\Models\th_transaksi;

class ManagerLaporan extends Component
{
    public $defPegawaiDipilih;
    public $defTanggalMulai;
    public $defTanggalSelesai;
    public $defDipilih;
    public $defOmzet;


    public function render()
    {
        $query = th_transaksi::when(
            $this->defPegawaiDipilih != '',
            fn($defQuery) => $defQuery->where('id_user', $this->defPegawaiDipilih)
        )
            ->when(
                $this->defTanggalMulai != null && $this->defTanggalSelesai != null,
                fn($defQuery) => $defQuery->whereBetween('created_at', [
                    Carbon::parse($this->defTanggalMulai)->startOfDay(),
                    Carbon::parse($this->defTanggalSelesai)->endOfDay(),
                ])
            );

        $defTotalBayar = $query->sum('total_bayar');

        return view('livewire.manager-laporan', [
            'defLaporan' => $query->orderByDesc('id_transaksi')->paginate(10),
            'defKasir' => User::where('hak', 'kasir')->get(),
            'defTotalBayar' => $defTotalBayar,
        ]);
    }


    protected $rules = [
        'defTanggalMulai' => 'nullable|date',
        'defTanggalSelesai' => 'nullable|date|after_or_equal:defTanggalMulai',
    ];

    protected $messages = [
        'defTanggalSelesai.after_or_equal' => 'Tanggal selesai tidak boleh lebih kecil dari tanggal mulai.',
    ];

    public function updated($defPropertyName)
    {
        $this->validateOnly($defPropertyName);
    }

    public function generatePDF()
    {
        return redirect()->route('laporan.pdf', [
            'kasir' => $this->defPegawaiDipilih,
            'tanggal_mulai' => $this->defTanggalMulai,
            'tanggal_selesai' => $this->defTanggalSelesai
        ]);
    }
}
