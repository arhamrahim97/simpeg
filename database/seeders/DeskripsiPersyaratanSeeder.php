<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DeskripsiPersyaratanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perdeskripsianKenaikanGajiGuru = [
            // Kenaikan Gaji Guru
            [
                'id_persyaratan' => '1',
                'deskripsi' => 'Upload Pengantar Dari Sekolah',
            ],
            [
                'id_persyaratan' => '1',
                'deskripsi' => 'SK Gaji Berkala',
            ],
            [
                'id_persyaratan' => '1',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '1',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
        ];

        $perdeskripsianKenaikanGajiPegawai = [
            // Kenaikan Gaji Pegawai
            [
                'id_persyaratan' => '2',
                'deskripsi' => 'Upload Pengantar Dari Sekolah',
            ],
            [
                'id_persyaratan' => '2',
                'deskripsi' => 'SK Gaji Berkala',
            ],
            [
                'id_persyaratan' => '2',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '2',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],

        ];

        $persyaratanKenaikanPangkatGuru = [
            // Kenaikan Pangkat Guru
            [
                'id_persyaratan' => '3',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '3',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '3',
                'deskripsi' => 'Pengembangan Diri 1',
            ],
            [
                'id_persyaratan' => '3',
                'deskripsi' => 'PKG',
            ],
            [
                'id_persyaratan' => '3',
                'deskripsi' => 'DUPAK',
            ],
            [
                'id_persyaratan' => '3',
                'deskripsi' => 'Sertifikat 30 Jam (Minimal 3 File)',
            ],
            [
                'id_persyaratan' => '3',
                'deskripsi' => 'Resume Kegiatan',
            ],
            //
            [
                'id_persyaratan' => '4',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '4',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '4',
                'deskripsi' => 'PTK 2',
            ],
            [
                'id_persyaratan' => '4',
                'deskripsi' => 'Pengembangan Diri 2',
            ],
            [
                'id_persyaratan' => '4',
                'deskripsi' => 'PKG',
            ],
            [
                'id_persyaratan' => '4',
                'deskripsi' => 'DUPAK',
            ],
            [
                'id_persyaratan' => '4',
                'deskripsi' => 'Sertifikat 30 Jam (Minimal 3 File)',
            ],
            [
                'id_persyaratan' => '4',
                'deskripsi' => 'Resume Kegiatan',
            ],
            //
            [
                'id_persyaratan' => '5',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '5',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '5',
                'deskripsi' => 'PTK 2',
            ],
            [
                'id_persyaratan' => '5',
                'deskripsi' => 'Pengembangan Diri 3',
            ],
            [
                'id_persyaratan' => '5',
                'deskripsi' => 'PKG',
            ],
            [
                'id_persyaratan' => '5',
                'deskripsi' => 'DUPAK',
            ],
            [
                'id_persyaratan' => '5',
                'deskripsi' => 'Sertifikat 30 Jam (Minimal 3 File)',
            ],
            [
                'id_persyaratan' => '5',
                'deskripsi' => 'Resume Kegiatan',
            ],
            //
            [
                'id_persyaratan' => '6',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '6',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '6',
                'deskripsi' => 'Pengembangan Diri 2',
            ],
            [
                'id_persyaratan' => '6',
                'deskripsi' => 'PKG',
            ],
            [
                'id_persyaratan' => '6',
                'deskripsi' => 'DUPAK',
            ],
            [
                'id_persyaratan' => '6',
                'deskripsi' => 'Sertifikat 30 Jam (Minimal 3 File)',
            ],
            [
                'id_persyaratan' => '6',
                'deskripsi' => 'Resume Kegiatan',
            ],
            [
                'id_persyaratan' => '6',
                'deskripsi' => 'Jurnal 1',
            ],

        ];

        $persyaratanKenaikanPangkatPegawai = [
            // Kenaikan Pangkat Pegawai
            [
                'id_persyaratan' => '7',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '7',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '7',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '7',
                'deskripsi' => 'SK 80%',
            ],
            [
                'id_persyaratan' => '7',
                'deskripsi' => 'SK 100%',
            ],
            [
                'id_persyaratan' => '7',
                'deskripsi' => 'SK Terakhir',
            ],
            [
                'id_persyaratan' => '7',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '7',
                'deskripsi' => 'Sertifikat Ujian Dinas (Bagi yang penyesuaian ijazah)',
            ],
            //
            [
                'id_persyaratan' => '8',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '8',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '8',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '8',
                'deskripsi' => 'SK 80%',
            ],
            [
                'id_persyaratan' => '8',
                'deskripsi' => 'SK 100%',
            ],
            [
                'id_persyaratan' => '8',
                'deskripsi' => 'SK Terakhir',
            ],
            [
                'id_persyaratan' => '8',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '8',
                'deskripsi' => 'Sertifikat Ujian Dinas (Bagi yang penyesuaian ijazah)',
            ],
            //
            [
                'id_persyaratan' => '9',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '9',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '9',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '9',
                'deskripsi' => 'SK 80%',
            ],
            [
                'id_persyaratan' => '9',
                'deskripsi' => 'SK 100%',
            ],
            [
                'id_persyaratan' => '9',
                'deskripsi' => 'SK Terakhir',
            ],
            [
                'id_persyaratan' => '9',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '9',
                'deskripsi' => 'Sertifikat Ujian Dinas (Bagi yang penyesuaian ijazah)',
            ],
            //
            [
                'id_persyaratan' => '10',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '10',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '10',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '10',
                'deskripsi' => 'SK 80%',
            ],
            [
                'id_persyaratan' => '10',
                'deskripsi' => 'SK 100%',
            ],
            [
                'id_persyaratan' => '10',
                'deskripsi' => 'SK Terakhir',
            ],
            [
                'id_persyaratan' => '10',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '10',
                'deskripsi' => 'Sertifikat Ujian Dinas (Bagi yang penyesuaian ijazah)',
            ],
        ];

        $persyaratanBerkasDasarGuru = [
            // Berkas Dasar Guru
            [
                'id_persyaratan' => '11',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '11',
                'deskripsi' => 'Kartu Tanda Penduduk (KTP)',
            ],
            [
                'id_persyaratan' => '11',
                'deskripsi' => 'Kartu Keluarga (KK)',
            ],
            [
                'id_persyaratan' => '11',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '11',
                'deskripsi' => 'Kartu NUPTK',
            ],
            [
                'id_persyaratan' => '11',
                'deskripsi' => 'Sertifikasi Guru (Tidak Wajib)',
            ],
            [
                'id_persyaratan' => '11',
                'deskripsi' => 'SK CPNS',
            ],
            [
                'id_persyaratan' => '11',
                'deskripsi' => 'SK PNS',
            ],
            [
                'id_persyaratan' => '11',
                'deskripsi' => 'SK Kenaikan Gaji Berkala',
            ],
            [
                'id_persyaratan' => '11',
                'deskripsi' => 'SK Kenaikan Pangkat',
            ],
            [
                'id_persyaratan' => '11',
                'deskripsi' => 'SPMT',
            ],


        ];

        $persyaratanBerkasDasarPegawai = [
            // Berkas Dasar Pegawai
            [
                'id_persyaratan' => '12',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '12',
                'deskripsi' => 'Kartu Tanda Penduduk (KTP)',
            ],
            [
                'id_persyaratan' => '12',
                'deskripsi' => 'Kartu Keluarga (KK)',
            ],
            [
                'id_persyaratan' => '12',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '12',
                'deskripsi' => 'Kartu NUPTK (Tidak Wajib)',
            ],
            [
                'id_persyaratan' => '12',
                'deskripsi' => 'SK CPNS',
            ],
            [
                'id_persyaratan' => '12',
                'deskripsi' => 'SK PNS',
            ],
            [
                'id_persyaratan' => '12',
                'deskripsi' => 'SK Kenaikan Gaji Berkala',
            ],
            [
                'id_persyaratan' => '12',
                'deskripsi' => 'SK Kenaikan Pangkat',
            ],
            [
                'id_persyaratan' => '12',
                'deskripsi' => 'SPMT',
            ],


        ];

        DB::table('deskripsi_persyaratan')->insert($perdeskripsianKenaikanGajiGuru);
        DB::table('deskripsi_persyaratan')->insert($perdeskripsianKenaikanGajiPegawai);
        DB::table('deskripsi_persyaratan')->insert($persyaratanKenaikanPangkatGuru);
        DB::table('deskripsi_persyaratan')->insert($persyaratanKenaikanPangkatPegawai);
        DB::table('deskripsi_persyaratan')->insert($persyaratanBerkasDasarGuru);
        DB::table('deskripsi_persyaratan')->insert($persyaratanBerkasDasarPegawai);
    }
}
