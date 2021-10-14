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
                'nama' => 'SMP Negeri 1 Palu',
                'kategori' => 'SMP'
            ],
            [
                'nama' => 'SMP Negeri 2 Palu',
                'kategori' => 'SMP'
            ],
            [
                'nama' => 'SMA Negeri 1 Palu',
                'kategori' => 'SMA/SMK'
            ],
            [
                'nama' => 'SMA Negeri 2 Palu',
                'kategori' => 'SMA/SMK'
            ],
        ];
        DB::table('unit_kerja')->insert($unit_kerja);
    }
}
