<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class td_transaksi extends Model
{
    //
    protected $table = 'td_transaksi';

    protected $fillable = [
        'id_transaksi',
        'id_menu',
        'jumlah',
        'harga',
        'sub_total',
    ];

    /**
     * Get the thTransaksi that owns the td_transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function th_transaksi(): BelongsTo
    {
        return $this->belongsTo(th_transaksi::class, 'id_transaksi', 'id_transaksi');
    }

    /**
     * Get the t_menu that owns the td_transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tmenu(): BelongsTo
    {
        return $this->belongsTo(tmenu::class, 'id_menu', 'id_menu');
    }
}
