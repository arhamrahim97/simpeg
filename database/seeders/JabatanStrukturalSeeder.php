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
                'golongan' => 'I/a',
                'jabatan' => '-',
                'pangkat' => '-',
                'no_urut' => 1,
            ],
            [
                'golongan' => 'I/b',
                'jabatan' => '-',
                'pangkat' => '-',
                'no_urut' => 2,
            ],
            [
                'golongan' => 'I/c',
                'jabatan' => 'Juru',
                'pangkat' => '-',
                'no_urut' => 3,
            ],
            [
                'golongan' => 'I/d',
                'jabatan' => 'Juru Tkt. 1',
                'pangkat' => '-',
                'no_urut' => 4,
            ],
            [
                'golongan' => 'II/a',
                'jabatan' => 'Pengatur Muda',
                'pangkat' => '-',
                'no_urut' => 5,
            ],
            [
                'golongan' => 'II/b',
                'jabatan' => 'Pengatur Muda Tkt. I',
                'pangkat' => '-',
                'no_urut' => 6,
            ],
            [
                'golongan' => 'II/c',
                'jabatan' => 'Pengatur',
                'pangkat' => '-',
                'no_urut' => 7,
            ],
            [
                'golongan' => 'II/d',
                'jabatan' => 'Pengatur Tkt. I',
                'pangkat' => '-',
                'no_urut' => 8,
            ],
            [
                'golongan' => 'III/a',
                'jabatan' => 'Penata Muda',
                'pangkat' => 'Ahli Pertama',
                'no_urut' => 9,
            ],
            [
                'golongan' => 'III/b',
                'jabatan' => 'Penata Muda Tkt. I',
                'pangkat' => 'Ahli Pertama',
                'no_urut' => 10,
            ],
            [
                'golongan' => 'III/c',
                'jabatan' => 'Penata',
                'pangkat' => 'Ahli Muda',
                'no_urut' => 11,
            ],
            [
                'golongan' => 'III/d',
                'jabatan' => 'Penata Tkt. I',
                'pangkat' => 'Ahli Muda',
                'no_urut' => 12,
            ],
            [
                'golongan' => 'IV/a',
                'jabatan' => 'Pembina',
                'pangkat' => 'Ahli Madya',
                'no_urut' => 13,
            ],
            [
                'golongan' => 'IV/b',
                'jabatan' => 'Pembina Tkt. I',
                'pangkat' => 'Ahli Madya',
                'no_urut' => 14,
            ],
            [
                'golongan' => 'IV/c',
                'jabatan' => 'Pembina Utama Muda',
                'pangkat' => 'Ahli Madya',
                'no_urut' => 15,
            ],
            [
                'golongan' => 'IV/d',
                'jabatan' => 'Pembina Utama Madya',
                'pangkat' => 'Ahli Utama',
                'no_urut' => 16,
            ],
            [
                'golongan' => 'IV/e',
                'jabatan' => 'Pembina Utama Madya',
                'pangkat' => 'Ahli Utama',
                'no_urut' => 17,
            ],
        ];
        DB::table('jabatan_struktural')->insert($jabatan_struktural);
    }
}
