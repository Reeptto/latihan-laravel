<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterAlamatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('master_alamat')->insert(
[
            
            [
                'provinsi' => 'Jawa Barat',
                'kota' => 'Karawang',
                'kecamatan' => 'Karawang Timur',
                'kode_pos' => '417310',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'provinsi' => 'Jawa Tengah',
                'kota' => 'Pemalang',
                'kecamatan' => 'Ulujami',
                'kode_pos' => '412111',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'provinsi' => 'Jawa Timur',
                'kota' => 'Ngawi',
                'kecamatan' => 'Jogorogo',
                'kode_pos' => '422212',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'provinsi' => 'DKI Jakarta',
                'kota' => 'Jakarta Pusat',
                'kecamatan' => 'Menteng',
                'kode_pos' => '432313',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'provinsi' => 'Yogyakarta',
                'kota' => 'Sleman',
                'kecamatan' => 'Gunungkidul',
                'kode_pos' => '442414',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ],
        
    );
    }
}
