<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('users', 'tuser');

        Schema::table('tuser', function (Blueprint $table) {
            $table->renameColumn('id', 'id_user');
            $table->string('username', 11)->after('id_user');
            $table->renameColumn('name', 'nama_user');
            $table->string('nama_user', 20)->change();
            $table->dropColumn('email');
            $table->dropColumn('email_verified_at');
            $table->enum('hak', ['admin', 'manager', 'kasir'])->after('password');
            $table->string('telepon', 30)->after('hak');
            $table->string('alamat', 25)->after('telepon');
        });
    }

    public function down(): void
    {
        Schema::table('tuser', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('hak');
            $table->dropColumn('telepon');
            $table->dropColumn('alamat');
            $table->renameColumn('nama_user', 'name');
            $table->string('name', 255)->change();
        });

        Schema::rename('tuser', 'users');
    }
};
