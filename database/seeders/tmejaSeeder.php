<?php

namespace Database\Seeders;

use App\Models\tmeja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class tmejaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        tmeja::truncate();
        Schema::enableForeignKeyConstraints();

        tmeja::insert([
            [
                'nomor_meja' => 1,
                'keterangan' => '2 orang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_meja' => 2,
                'keterangan' => '4 orang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nomor_meja' => 3,
                'keterangan' => '2 orang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
