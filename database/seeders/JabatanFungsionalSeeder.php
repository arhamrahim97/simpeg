<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanFungsionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jabatan_fungsional = [
            [
                'golongan' => 'II/a',
                'jabatan' => 'Pengatur Muda',
                'pangkat' => 'Guru',
                'no_urut' => 1,
            ],
            [
                'golongan' => 'II/b',
                'jabatan' => 'Pengatur Muda Tkt. I',
                'pangkat' => 'Guru',
                'no_urut' => 2,
            ],
            [
                'golongan' => 'II/c',
                'jabatan' => 'Pengatur',
                'pangkat' => 'Guru',
                'no_urut' => 3,
            ],
            [
                'golongan' => 'II/d',
                'jabatan' => 'Pengatur Tkt. I',
                'pangkat' => 'Guru',
                'no_urut' => 4,
            ],
            [
                'golongan' => 'III/a',
                'jabatan' => 'Penata Muda',
                'pangkat' => 'Guru Ahli Pertama',
                'no_urut' => 5,
            ],
            [
                'golongan' => 'III/b',
                'jabatan' => 'Penata Muda Tkt. I',
                'pangkat' => 'Guru Ahli Pertama',
                'no_urut' => 6,
            ],
            [
                'golongan' => 'III/c',
                'jabatan' => 'Penata',
                'pangkat' => 'Guru Ahli Muda',
                'no_urut' => 7,
            ],
            [
                'golongan' => 'III/d',
                'jabatan' => 'Penata Tkt. I',
                'pangkat' => 'Guru Ahli Muda',
                'no_urut' => 8,
            ],
            [
                'golongan' => 'IV/a',
                'jabatan' => 'Pembina',
                'pangkat' => 'Guru Ahli Madya',
                'no_urut' => 9,
            ],
            [
                'golongan' => 'IV/b',
                'jabatan' => 'Pembina Tkt. I',
                'pangkat' => 'Guru Ahli Madya',
                'no_urut' => 10,
            ],
            [
                'golongan' => 'IV/c',
                'jabatan' => 'Pembina Utama Muda',
                'pangkat' => 'Guru Ahli Madya',
                'no_urut' => 11,
            ],
            [
                'golongan' => 'IV/d',
                'jabatan' => 'Pembina Utama Madya',
                'pangkat' => 'Guru Ahli Utama',
                'no_urut' => 12,
            ],
            [
                'golongan' => 'IV/e',
                'jabatan' => 'Pembina Utama Madya',
                'pangkat' => 'Guru Ahli Utama',
                'no_urut' => 13,
            ],
        ];
        DB::table('jabatan_fungsional')->insert($jabatan_fungsional);
    }
}
