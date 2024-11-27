<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\th_transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class LaporanPDFController extends Controller
{
    public function generatePDF(Request $request)
    {
        $query = th_transaksi::query();

        if ($request->kasir) {
            $query->where('id_user', $request->kasir);
        }

        if ($request->tanggal_mulai && $request->tanggal_selesai) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->tanggal_mulai)->startOfDay(),
                Carbon::parse($request->tanggal_selesai)->endOfDay(),
            ]);
        }

        $transactions = $query->orderByDesc('id_transaksi')->get();
        $totalPendapatan = $query->sum('total_bayar');

        $pdf = PDF::loadView('pdf.laporan-penjualan', [
            'transactions' => $transactions,
            'totalPendapatan' => $totalPendapatan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'pembuat_laporan' => Auth::user()->nama_user,
            'tanggal_pembuatan' => Carbon::now()->format('d F Y'),
        ]);

        return $pdf->stream('laporan-penjualan.pdf');
    }
}
