<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BerkasDasarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $berkasDasar = [
            [
                'id_user' => 2,
                'nama' => 'KTP',
                'file' => 'berkasdummy1.pdf'
            ],
            [
                'id_user' => 2,
                'nama' => 'SK Gaji Berkala',
                'file' => 'berkasdummy2.pdf'
            ],
            [
                'id_user' => 3,
                'nama' => 'KTP',
                'file' => 'berkasdummy1.pdf'
            ],
            [
                'id_user' => 3,
                'nama' => 'SK Gaji Berkala',
                'file' => 'berkasdummy2.pdf'
            ],
        ];
        DB::table('berkas_dasar')->insert($berkasDasar);
    }
}
