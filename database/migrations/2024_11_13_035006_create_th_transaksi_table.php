<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('th_transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->unsignedBigInteger('id_meja');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('total_bayar');
            $table->unsignedBigInteger('jumlah_bayar');
            $table->date('tgl_transaksi');
            $table->foreign('id_meja')->references('id_meja')->on('tmeja')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('tuser')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('th_transaksi');
    }
};
