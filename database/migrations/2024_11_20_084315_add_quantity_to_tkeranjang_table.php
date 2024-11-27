<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('tkeranjang', function (Blueprint $table) {
            $table->integer('quantity')->default(1)->after('subtotal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tkeranjang', function (Blueprint $table) {
            //
            $table->dropColumn('quantity');
        });
    }
};
