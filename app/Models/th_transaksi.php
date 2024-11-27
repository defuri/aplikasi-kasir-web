<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class th_transaksi extends Model
{
    //
    protected $table = 'th_transaksi';

    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'kode_transaksi',
        'id_meja',
        'id_user',
        'total_bayar',
        'jumlah_bayar',
        'tgl_transaksi',
    ];

    /**
     * Get the t_meja that owns the th_transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tmeja(): BelongsTo
    {
        return $this->belongsTo(tmeja::class, 'id_meja', 'id_meja');
    }

    /**
     * Get the tuser that owns the th_transaksi
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tuser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
