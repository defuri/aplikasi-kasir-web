<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class tmeja extends Model
{
    //
    protected $table = 'tmeja';

    protected $primaryKey = 'id_meja';

    protected $fillable = [
        'nomor_meja',
        'keterangan',
        'status',
    ];

    /**
     * Get all of the tmeja for the tmeja
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tmeja(): HasMany
    {
        return $this->hasMany(th_transaksi::class, 'id_meja', 'id_meja');
    }
}
