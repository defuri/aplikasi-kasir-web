<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class tkeranjang extends Model
{
    //
    protected $table = "tkeranjang";
    protected $fillable = [
        "idp",
        "idm",
        "subtotal",
    ];

    /**
     * Get the menu that owns the tkeranjang
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu(): BelongsTo
    {
        return $this->belongsTo(tmenu::class, 'idm', 'id_menu');
    }
}
