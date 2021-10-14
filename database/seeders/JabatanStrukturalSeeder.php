<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanStrukturalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatan_struktural = [
            [
                'golongan' => 'III/a',
                'jabatan' => 'Penata Muda',
                'pangkat' => 'Ahli Pertama',
                'no_urut' => 1,
            ],
            [
                'golongan' => 'III/b',
                'jabatan' => 'Penata Muda Tkt. I',
                'pangkat' => 'Ahli Pertama',
                'no_urut' => 2,
            ],
            [
                'golongan' => 'III/c',
                'jabatan' => 'Penata',
                'pangkat' => 'Ahli Muda',
                'no_urut' => 3,
            ],
            [
                'golongan' => 'III/d',
                'jabatan' => 'Penata Tkt. I',
                'pangkat' => 'Ahli Muda',
                'no_urut' => 4,
            ],
            [
                'golongan' => 'IV/a',
                'jabatan' => 'Pembina',
                'pangkat' => 'Ahli Madya',
                'no_urut' => 5,
            ],
            [
                'golongan' => 'IV/b',
                'jabatan' => 'Pembina Tkt. I',
                'pangkat' => 'Ahli Madya',
                'no_urut' => 6,
            ],
            [
                'golongan' => 'IV/c',
                'jabatan' => 'Pembina Utama Muda',
                'pangkat' => 'Ahli Madya',
                'no_urut' => 7,
            ],
            [
                'golongan' => 'IV/d',
                'jabatan' => 'Pembina Utama Madya',
                'pangkat' => 'Ahli Utama',
                'no_urut' => 8,
            ],
            [
                'golongan' => 'IV/e',
                'jabatan' => 'Pembina Utama Madya',
                'pangkat' => 'Ahli Utama',
                'no_urut' => 9,
            ],
        ];
        DB::table('jabatan_struktural')->insert($jabatan_struktural);
    }
}
