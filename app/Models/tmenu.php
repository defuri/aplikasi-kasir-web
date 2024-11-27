<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class tmenu extends Model
{
    //
    protected $table = 'tmenu';

    protected $primaryKey = 'id_menu';
    
    protected $fillable = [
        'gambar',
        'nama_menu',
        'deskripsi',
        'harga',
        'kategori',
    ];

    /**
     * Get all of the td_transaksi for the tmenu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function td_transaksi(): HasMany
    {
        return $this->hasMany(td_transaksi::class, 'id_menu', 'id_menu');
    }
}
