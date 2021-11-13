<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unit_kerja = [
            [
                'nama' => 'KB AL-KAUTSAR',
                'kategori' => 'KB'
            ],
            [
                'nama' => 'PAUD KB AISYIYAH II',
                'kategori' => 'PAUD'
            ],
            [
                'nama' => 'PKBM ANUTAPURA TAGARI',
                'kategori' => 'PKBM'
            ],
            [
                'nama' => 'SD AL AZHAR MANDIRI PALU',
                'kategori' => 'SD'
            ],
            [
                'nama' => 'SMP ALKHAIRAAT 1 PALU',
                'kategori' => 'SMP'
            ],
        ];
        DB::table('unit_kerja')->insert($unit_kerja);
    }
}
