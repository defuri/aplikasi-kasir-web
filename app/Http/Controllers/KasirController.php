<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\User;
use App\Models\td_transaksi;
use App\Models\th_transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KasirController extends Controller
{
    //
    public function index()
    {
        $defPenjualanHariIni = th_transaksi::whereBetween('tgl_transaksi', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->where('id_user', Auth::user()->id_user)->sum('total_bayar');
        $defTotalTransaksi = th_transaksi::where('id_user', Auth::user()->id_user)->count();

        $defTotalItemTerjual = th_transaksi::where('id_user', Auth::user()->id_user)
            ->join('td_transaksi', 'th_transaksi.id_transaksi', '=', 'td_transaksi.id_transaksi')
            ->sum('td_transaksi.jumlah');

        $defTransaksiTerbaru = th_transaksi::where('id_user', Auth::user()->id_user)->take(5)->orderByDesc('id_transaksi')->get();

        $produkTerjual = td_transaksi::selectRaw('tmenu.nama_menu, tmenu.gambar, SUM(td_transaksi.jumlah) as total_terjual')
            ->join('tmenu', 'td_transaksi.id_menu', '=', 'tmenu.id_menu')
            ->groupBy('tmenu.nama_menu', 'tmenu.gambar')
            ->orderByDesc('total_terjual')
            ->get();

        return view("kasir.dashboard", compact(
            'defPenjualanHariIni',
            'defTotalTransaksi',
            'defTotalItemTerjual',
            'defTransaksiTerbaru',
            'produkTerjual',
        ));
    }

    public function cetak(Request $request)
    {
        $defDetail = td_transaksi::where('id_transaksi', $request->defIdTransaksi)->get();
        $defThTransaksi = th_transaksi::where('id_transaksi', $request->defIdTransaksi)->first();
        $defKasir = User::where('id_user', Auth::user()->id_user)->first()->nama_user;

        $defDomPdf = new Dompdf();
        $defHtml = '
            <html>
                <head>
                    <style>
                        * {
                            margin: 0;
                            padding: 0;
                            box-sizing: border-box;
                        }

                        body {
                            font-family: monospace;
                            font-size: 9px;
                            width: 100%;
                            padding: 5px;
                        }

                        .container {
                            width: 100%;
                            max-width: 210px;
                            margin: 30px auto 0 auto;
                        }

                        .header {
                            text-align: center;
                            margin-bottom: 10px;
                        }

                        table {
                            width: 100%;
                            margin-bottom: 10px;
                        }

                        td {
                            padding: 2px 0;
                            vertical-align: top;
                        }

                        .text-end {
                            text-align: right;
                        }

                        .text-center {
                            text-align: center;
                        }

                        .separator {
                            border-top: 1px dashed #000;
                            margin: 5px 0;
                        }

                        .footer {
                            margin-top: 10px;
                            text-align: center;
                        }

                        .namaPt {
                            font-weight: bold;
                            font-size: .7rem;
                        }
                    </style>
                </head>
                <body>
                    <div class="container">
                        <div class="header">
                            <div class="namaPt">PT Restoran Sukamaju, TBK</div>
                            <div>ALFA TOWER LT.12, ALAM SUTERA</div>
                            <div>JL. CABANG BARU NO.41 JATINEGARA</div>
                        </div>
                        <div class="separator"></div>

                        <table>
                            <tr>
                                <td>' . Carbon::now()->setTimezone('Asia/Jakarta')->format('d-m-Y H:i') . '</td>
                                <td class="text-end">' . $defThTransaksi->kode_transaksi . '</td>
                            </tr>
                            <tr>
                                <td>Kasir</td>
                                <td class="text-end">' . $defKasir . '</td>
                            </tr>
                        </table>
                        <div class="separator"></div>

                        <table>';

        foreach ($defDetail as $defItem) {
            $defHtml .= '
                <tr>
                    <td colspan="2">' . $defItem->tmenu->nama_menu . '</td>
                </tr>
                <tr>
                    <td>' . $defItem->jumlah . ' x ' .  number_format($defItem->tmenu->harga, 0, ',', '.') . '</td>
                    <td class="text-end">Rp ' . number_format($defItem->sub_total, 0, ',', '.') . '</td>
                </tr>';
        }

        $defHtml .= '</table>
                        <div class="separator"></div>

                        <table>
                            <tr>
                                <td>Total</td>
                                <td class="text-end">' . number_format($defThTransaksi->total_bayar, 0, ',', '.') . '</td>
                            </tr>
                            <tr>
                                <td>Bayar(Cash)</td>
                                <td class="text-end">' . number_format($defThTransaksi->jumlah_bayar, 0, ',', '.') . '</td>
                            </tr>
                            <tr>
                                <td>Kembali</td>
                                <td class="text-end">' . number_format($defThTransaksi->jumlah_bayar - $defThTransaksi->total_bayar, 0, ',', '.') . '</td>
                            </tr>
                        </table>
                        <div class="separator"></div>

                        <div class="footer">
                            <div>Kritik Dan saran</div>
                            <div>bit.ly/3ZfVDWm</div>
                        </div>
                    </div>
                </body>
            </html>';

        $defDomPdf->loadHtml($defHtml);

        $defDomPdf->setPaper([0, 0, 220, 300], 'portrait');

        $defDomPdf->render();

        return $defDomPdf->stream('Struk.pdf', ['Attachment' => 0]);
    }
}
