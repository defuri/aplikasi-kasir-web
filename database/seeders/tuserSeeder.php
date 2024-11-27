<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class tuserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        User::insert([
            [
                'username' => 'kasir 1',
                'password' => Hash::make(1),
                'nama_user' => 'Raiden',
                'hak' => 'kasir',
                'telepon' => '+6281234567890',
                'alamat' => 'Jl. In Aja Dulu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'manager 1',
                'password' => Hash::make(1),
                'nama_user' => 'Nahihi',
                'hak' => 'manager',
                'telepon' => '+6280987654321',
                'alamat' => 'Jl. Jl tapi gak ada uang',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'admin 1',
                'password' => Hash::make(1),
                'nama_user' => 'Venti',
                'hak' => 'admin',
                'telepon' => '+620000000001',
                'alamat' => 'Jl. Jl santai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
