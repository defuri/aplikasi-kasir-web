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
        Schema::create('td_transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_transaksi');
            $table->unsignedBigInteger('id_menu');
            $table->unsignedBigInteger('jumlah');
            $table->unsignedBigInteger('harga');
            $table->unsignedBigInteger('sub_total');
            $table->foreign('id_transaksi')->references('id_transaksi')->on('th_transaksi')->onDelete('cascade');
            $table->foreign('id_menu')->references('id_menu')->on('tmenu')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('td_transaksi');
    }
};
