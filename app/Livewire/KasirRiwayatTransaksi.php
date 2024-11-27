<?php

namespace App\Livewire;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\td_transaksi;
use Livewire\Component;
use App\Models\th_transaksi;
use Illuminate\Support\Facades\Auth;

class KasirRiwayatTransaksi extends Component
{
    public $defDipilih;

    public function render()
    {
        return view('livewire.kasir-riwayat-transaksi', [
            'defData' => th_transaksi::where('id_user', Auth::user()->id_user)->orderByDesc('id_transaksi')->paginate(10),
        ]);
    }

    public function placeholder()
    {
        return <<< 'HTML'
            <div class="table-responsive mb-5">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>
                                <div class="placeholder-glow">
                                    <span class="placeholder col-4"></span>
                                </div>
                            </th>
                            <th>
                                <div class="placeholder-glow">
                                    <span class="placeholder col-4"></span>
                                </div>
                            </th>
                            <th>
                                <div class="placeholder-glow">
                                    <span class="placeholder col-4"></span>
                                </div>
                            </th>
                            <th>
                                <div class="placeholder-glow">
                                    <span class="placeholder col-4"></span>
                                </div>
                            </th>
                            <th>
                                <div class="placeholder-glow">
                                    <span class="placeholder col-4"></span>
                                </div>
                            </th>
                            <th>
                                <div class="placeholder-glow">
                                    <span class="placeholder col-4"></span>
                                </div>
                            </th>
                            <th>
                                <div class="placeholder-glow">
                                    <span class="placeholder col-4"></span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 5; $i++)
                            <tr>
                                <td>
                                    <div class="placeholder-glow">
                                        <span class="placeholder col-4"></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="placeholder-glow">
                                        <span class="placeholder col-6"></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="placeholder-glow">
                                        <span class="placeholder col-6"></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="placeholder-glow">
                                        <span class="placeholder col-3"></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="placeholder-glow">
                                        <span class="placeholder col-5"></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="placeholder-glow">
                                        <span class="placeholder col-5"></span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="placeholder-glow">
                                        <span class="placeholder btn-sm btn-primary"></span>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        HTML;
    }


    public function setDefDipilih($defData)
    {
        $this->defDipilih = td_transaksi::where('id_transaksi', $defData['id_transaksi'])->get();
    }
}
