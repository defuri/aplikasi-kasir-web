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
        Schema::create('tmenu', function (Blueprint $table) {
            $table->id('id_menu');
            $table->string('gambar');
            $table->string('nama_menu', 50);
            $table->text('deskripsi');
            $table->integer('harga');
            $table->enum('kategori', ['makanan', 'minuman']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmenu');
    }
};
