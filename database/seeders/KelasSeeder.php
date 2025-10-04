<?php

namespace Database\Seeders;
use App\Models\Clas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clas::create(['nama_kelas' => 'ASE-10']);
        Clas::create(['nama_kelas' => 'OAA-13']);
        Clas::create(['nama_kelas' => 'AIS-12']);
    }
}
