<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersyaratanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $persyaratanKenaikanGaji = [
            [
                'id' => '1',
                'jenis_asn' => 'Guru',
                'kategori' => 'Usulan Kenaikan Gaji Berkala',
            ],
            [
                'id' => '2',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Gaji Berkala',
            ],
        ];

        $persyaratanKenaikanPangkatGuru = [
            // Kenaikan Pangkat Guru
            [
                'id' => '3',
                'jenis_asn' => 'Guru',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '7',
            ],
            //
            [
                'id' => '4',
                'jenis_asn' => 'Guru',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '8',
            ],
            //
            [
                'id' => '5',
                'jenis_asn' => 'Guru',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '9',
            ],
            //
            [
                'id' => '6',
                'jenis_asn' => 'Guru',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '10',
            ],
        ];

        $persyaratanKenaikanPangkatPegawai = [
            // Kenaikan Pangkat Pegawai
            [
                'id' => '7',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '7',
            ],
            //
            [
                'id' => '8',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '8',
            ],
            //
            [
                'id' => '9',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '9',
            ],
            //
            [
                'id' => '10',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '10',
            ],
        ];


        $persyaratanBerkasDasar = [
            // Berkas Dasar Guru
            [
                'id' => '11',
                'jenis_asn' => 'Guru',
                'kategori' => 'Berkas Dasar',
            ],
            [
                'id' => '12',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Berkas Dasar',
            ],
        ];



        DB::table('persyaratan')->insert($persyaratanKenaikanGaji);
        DB::table('persyaratan')->insert($persyaratanKenaikanPangkatGuru);
        DB::table('persyaratan')->insert($persyaratanKenaikanPangkatPegawai);
        DB::table('persyaratan')->insert($persyaratanBerkasDasar);
    }
}
