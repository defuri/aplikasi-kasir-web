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
        Schema::table('th_transaksi', function (Blueprint $table) {
            //
            $table->string('kode_transaksi', 10)->after('id_transaksi')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('th_transaksi', function (Blueprint $table) {
            //
            $table->dropColumn('kode_transaksi');
        });
    }
};
