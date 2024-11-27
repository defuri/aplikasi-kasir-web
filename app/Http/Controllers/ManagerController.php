<?php

namespace App\Http\Controllers;

use App\Models\td_transaksi;
use App\Models\th_transaksi;
use App\Models\tmeja;
use App\Models\tmenu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ManagerController extends Controller
{
    //
    public function index()
    {
        $defTotalMeja = tmeja::all()->count();
        $defTotalMenu = tmenu::all()->count();
        $defMenu = tmenu::orderByDesc('id_menu')->take(5)->get();
        $defMeja = tmeja::orderByDesc('id_meja')->take(5)->get();
        $defJumlahPengunjung = th_transaksi::whereBetween('created_at', [
            Carbon::now()->startOfDay(),
            Carbon::now()->endOfDay(),
        ])->count();
        $defPendapatanHariIni = th_transaksi::where('tgl_transaksi', today())->sum('total_bayar');
        $defTransaksiTerbaru = th_transaksi::orderByDesc('id_user')->take(5)->get();
        $produkTerjual = td_transaksi::selectRaw('tmenu.nama_menu, tmenu.gambar, SUM(td_transaksi.jumlah) as total_terjual')
            ->join('tmenu', 'td_transaksi.id_menu', '=', 'tmenu.id_menu')
            ->groupBy('tmenu.nama_menu', 'tmenu.gambar')
            ->orderByDesc('total_terjual')
            ->get();

        return view("manager.dashboard", compact(
            'defTotalMeja',
            'defTotalMenu',
            'defMenu',
            'defMeja',
            'defJumlahPengunjung',
            'defPendapatanHariIni',
            'defTransaksiTerbaru',
            'produkTerjual',
        ));
    }
}
