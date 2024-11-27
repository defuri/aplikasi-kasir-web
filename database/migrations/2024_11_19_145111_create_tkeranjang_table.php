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
        Schema::create('tkeranjang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idp');
            $table->unsignedBigInteger('idm');
            $table->integer('subtotal');
            $table->timestamps();
            $table->foreign('idp')->references('id_user')->on('tuser')->onDelete('cascade');
            $table->foreign('idm')->references('id_menu')->on('tmenu')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tkeranjang');
    }
};
