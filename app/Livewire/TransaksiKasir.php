<?php

namespace App\Livewire;

use App\Models\td_transaksi;
use Carbon\Carbon;
use App\Models\tmeja;
use App\Models\tmenu;
use Livewire\Component;
use App\Models\tkeranjang;
use App\Models\th_transaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiKasir extends Component
{
    public $defLastKodeTransaksi;
    public $defSearch = '';
    public $defIdp;
    public $defKeranjang;
    public $defTotal = 0;
    public $defBayar;
    public $defPilihMeja;

    public function mount()
    {
        $this->defIdp = Auth::user()->id_user;
        $this->defTotal = tkeranjang::where('idp', $this->defIdp)->get()->sum('subtotal');
        $this->defKeranjang = tkeranjang::where('idp', $this->defIdp)->get();
    }

    public function render()
    {
        $defKembali = ($this->defBayar < $this->defTotal) ? 0 : ($this->defBayar - $this->defTotal);

        return view('livewire.transaksi-kasir', [
            'defKodeTransaksi' => $this->getLastKodeTransaksi(),
            'defMenu' => tmenu::where('nama_menu', 'like', '%' . $this->defSearch . '%')->paginate(10),
            'defMeja' => tmeja::get(),
            'defMejaKosong' => tmeja::where('status', false)->get(),
            'defKeranjang' => $this->defKeranjang,
            'defKembali' => $defKembali,
        ]);
    }

    public function getLastKodeTransaksi()
    {
        $lastTransaction = th_transaksi::latest('kode_transaksi')->first();
        $lastKode = $lastTransaction ? $lastTransaction->kode_transaksi : null;

        if (!$lastKode) {
            return 'TRS001';
        }

        $prefix = 'TRS';
        $number = (int) str_replace($prefix, '', $lastKode);

        $newNumber = str_pad($number + 1, 3, '0', STR_PAD_LEFT);

        return $prefix . $newNumber;
    }

    public function gantiStatus($defIdMeja)
    {
        $defMeja = tmeja::where('id_meja', $defIdMeja)->first();

        if ($defMeja->status) {
            $defMeja->status = false;
            $defMeja->save();
        } else {
            $defMeja->status = true;
            $defMeja->save();
        }

        activity()->useLog('Meja')->log('UPDATE ID ' . $this->defPilihMeja);

        if ($this->defPilihMeja == $defIdMeja) {
            $defMeja = tmeja::where('id_meja', $this->defPilihMeja)->first();

            if ($defMeja->status) {
                $this->defPilihMeja = null;
            }
        }

    }

    public function pesan($defMenu)
    {
        $defData = [
            'idp' => $this->defIdp,
        ];

        if (is_array($defMenu)) {
            $defData['idm'] = $defMenu['id_menu'];
            $defHarga = $defMenu['harga'];
        } else {
            $defData['idm'] = $defMenu;
            $defHarga = tmenu::where('id_menu', $defMenu)->value('harga');
        }

        $defCekAda = tkeranjang::where('idm', $defData['idm'])
            ->where('idp', $this->defIdp)
            ->first();

        if (!$defCekAda) {
            $defData['quantity'] = 1;
            $defData['subtotal'] = $defHarga;
            $keranjang = tkeranjang::create($defData);
        } else {
            $defCekAda->quantity += 1;
            $defCekAda->subtotal = $defCekAda->quantity * $defHarga;
            $defCekAda->save();
        }

        $this->updateTotal();
    }

    public function updateQuantity($defIdMenu, $defQuantity)
    {
        $defMenu = tkeranjang::where('idm', $defIdMenu)
            ->where('idp', $this->defIdp)
            ->first();

        if ($defMenu) {
            $defHarga = tmenu::where('id_menu', $defIdMenu)->value('harga');

            if ($defQuantity <= 0) {
                $this->hapusMenu($defIdMenu);
            } else {
                $defMenu->quantity = $defQuantity;
                $defMenu->subtotal = $defQuantity * $defHarga;
                $defMenu->save();

                activity()
                    ->useLog('Keranjang')
                    ->log('UPDATE ID ' . $defMenu->id);
            }

            $this->updateTotal();
        }
    }

    public function total()
    {
        $defTotal = tkeranjang::where('idp', $this->defIdp)->get()->sum('subtotal');
        $this->defTotal = $defTotal;
    }

    public function tombolKurang($defIdMenu)
    {
        $defMenu = tkeranjang::where('idm', $defIdMenu)
            ->where('idp', $this->defIdp)
            ->first();

        if ($defMenu) {
            $defHarga = tmenu::where('id_menu', $defIdMenu)->value('harga');
            $defMenu->quantity -= 1;

            if ($defMenu->quantity <= 0) {
                $this->hapusMenu($defIdMenu);
            } else {
                $defMenu->subtotal = $defMenu->quantity * $defHarga;
                $defMenu->save();

                activity()
                    ->useLog('Keranjang')
                    ->log('UPDATE ID ' . $defMenu->id);
            }

            $this->updateTotal();
        }
    }

    public function hapusKeranjang()
    {
        $keranjangItems = tkeranjang::where('idp', $this->defIdp)->get();

        foreach ($keranjangItems as $item) {
            activity()
                ->useLog('Keranjang')
                ->log('DELETE ID ' . $item->id);
        }

        tkeranjang::where('idp', $this->defIdp)->delete();
        $this->updateTotal();
    }

    public function hapusMenu($defIdMenu)
    {
        $menu = tkeranjang::where('idm', $defIdMenu)
            ->where('idp', $this->defIdp)
            ->first();

        if ($menu) {
            activity()
                ->useLog('Keranjang')
                ->log('DELETE ID ' . $menu->id);

            $menu->delete();
        }

        $this->updateTotal();
    }

    private function updateTotal()
    {
        $this->defTotal = tkeranjang::where('idp', $this->defIdp)->get()->sum('subtotal');
        $this->defKeranjang = tkeranjang::where('idp', $this->defIdp)->get();
    }

    public function pilihMeja($defIdMeja)
    {
        $defMejaYangDipilih = tmeja::where('id_meja', $defIdMeja)->first();

        if (!$defMejaYangDipilih->status) {
            $this->defPilihMeja = $defIdMeja;
        }
    }

    public function bayar()
    {
        $this->validate([
            'defPilihMeja' => 'required|integer',
            'defBayar' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if ($value < $this->defTotal) {
                        $fail('Jumlah pembayaran harus lebih besar atau sama dengan total.');
                    }
                },
            ],
        ]);

        $defData = tkeranjang::where('idp',  $this->defIdp)->get();

        if ($defData->isEmpty()) {
            return redirect()->back();
        }

        $defLatestIdTrans = $this->getLastKodeTransaksi();

        $defTh = [
            'kode_transaksi' => $defLatestIdTrans,
            'id_meja' => $this->defPilihMeja,
            'id_user' => $this->defIdp,
            'total_bayar' => $this->defTotal,
            'jumlah_bayar' => $this->defBayar,
            'tgl_transaksi' => Carbon::now(),
        ];

        $headerTransaksi = th_transaksi::create($defTh);

        activity()
            ->useLog('Transaksi')
            ->log('INSERT ID ' . $headerTransaksi->id_transaksi);

        $defLatestIdTrans = $headerTransaksi->id_transaksi;

        foreach ($defData as $defItem) {
            $defHarga = tmenu::where('id_menu', $defItem['idm'])->first()->harga;

            $defTd = [
                'id_transaksi' => $defLatestIdTrans,
                'id_menu' => $defItem['idm'],
                'jumlah' => $defItem['quantity'],
                'harga' => $defHarga,
                'sub_total' => $defItem['subtotal'],
            ];

            $detailTransaksi = td_transaksi::create($defTd);

            activity()
                ->useLog('Detail Transaksi')
                ->log('INSERT ID ' . $detailTransaksi->id);
        }

        foreach ($defData as $item) {
            activity()
                ->useLog('Keranjang')
                ->log('DELETE ID ' . $item->id);
        }

        tkeranjang::where('idp', $this->defIdp)->delete();

        $defMeja = tmeja::where('id_meja', $this->defPilihMeja)->first();

        $defMeja->status = true;
        $defMeja->save();

        $this->reset([
            'defPilihMeja',
            'defBayar',
        ]);
    }
}
