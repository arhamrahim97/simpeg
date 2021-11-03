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
                'ke_golongan' => '1',
            ],
            [
                'id' => '4',
                'jenis_asn' => 'Guru',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '2',
            ],
            [
                'id' => '5',
                'jenis_asn' => 'Guru',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '3',
            ],
            [
                'id' => '6',
                'jenis_asn' => 'Guru',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '4',
            ],
            [
                'id' => '7',
                'jenis_asn' => 'Guru',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '5',
            ],
            [
                'id' => '8',
                'jenis_asn' => 'Guru',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '6',
            ],
            [
                'id' => '9',
                'jenis_asn' => 'Guru',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '7',
            ],
            [
                'id' => '10',
                'jenis_asn' => 'Guru',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '8',
            ],
            [
                'id' => '11',
                'jenis_asn' => 'Guru',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '9',
            ],
            [
                'id' => '12',
                'jenis_asn' => 'Guru',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '10',
            ],
            [
                'id' => '13',
                'jenis_asn' => 'Guru',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '11',
            ],
            [
                'id' => '14',
                'jenis_asn' => 'Guru',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '12',
            ],
            [
                'id' => '15',
                'jenis_asn' => 'Guru',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '13',
            ],
            [
                'id' => '16',
                'jenis_asn' => 'Guru',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '14',
            ],
            [
                'id' => '17',
                'jenis_asn' => 'Guru',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '15',
            ],

        ];

        $persyaratanKenaikanPangkatPegawai = [
            // Kenaikan Pangkat Pegawai
            [
                'id' => '18',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '1',
            ],
            [
                'id' => '19',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '2',
            ],
            [
                'id' => '20',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '3',
            ],
            [
                'id' => '21',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '4',
            ],
            [
                'id' => '22',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '5',
            ],
            [
                'id' => '23',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '6',
            ],
            [
                'id' => '24',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '7',
            ],
            [
                'id' => '25',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '8',
            ],
            [
                'id' => '26',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '9',
            ],
            [
                'id' => '27',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '10',
            ],
            [
                'id' => '28',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '11',
            ],
            [
                'id' => '29',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '12',
            ],
            [
                'id' => '30',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '13',
            ],
            [
                'id' => '31',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '14',
            ],
            [
                'id' => '32',
                'jenis_asn' => 'Pegawai',
                'kategori' => 'Usulan Kenaikan Pangkat',
                'ke_golongan' => '15',
            ],
        ];


        $persyaratanBerkasDasar = [
            // Berkas Dasar Guru
            [
                'id' => '33',
                'jenis_asn' => 'Guru',
                'kategori' => 'Berkas Dasar',
            ],
            [
                'id' => '34',
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
