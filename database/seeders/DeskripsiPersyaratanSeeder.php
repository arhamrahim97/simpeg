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
                'deskripsi' => 'Pengembangan Diri 1',
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
                'deskripsi' => 'Pengembangan Diri 1',
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
                'deskripsi' => 'Pengembangan Diri 1',
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
            //
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
                'deskripsi' => 'Pengembangan Diri 1',
            ],
            [
                'id_persyaratan' => '7',
                'deskripsi' => 'PKG',
            ],
            [
                'id_persyaratan' => '7',
                'deskripsi' => 'DUPAK',
            ],
            [
                'id_persyaratan' => '7',
                'deskripsi' => 'Sertifikat 30 Jam (Minimal 3 File)',
            ],
            [
                'id_persyaratan' => '7',
                'deskripsi' => 'Resume Kegiatan',
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
                'deskripsi' => 'Pengembangan Diri 1',
            ],
            [
                'id_persyaratan' => '8',
                'deskripsi' => 'PKG',
            ],
            [
                'id_persyaratan' => '8',
                'deskripsi' => 'DUPAK',
            ],
            [
                'id_persyaratan' => '8',
                'deskripsi' => 'Sertifikat 30 Jam (Minimal 3 File)',
            ],
            [
                'id_persyaratan' => '8',
                'deskripsi' => 'Resume Kegiatan',
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
                'deskripsi' => 'Pengembangan Diri 1',
            ],
            [
                'id_persyaratan' => '9',
                'deskripsi' => 'PKG',
            ],
            [
                'id_persyaratan' => '9',
                'deskripsi' => 'DUPAK',
            ],
            [
                'id_persyaratan' => '9',
                'deskripsi' => 'Sertifikat 30 Jam (Minimal 3 File)',
            ],
            [
                'id_persyaratan' => '9',
                'deskripsi' => 'Resume Kegiatan',
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
                'deskripsi' => 'Pengembangan Diri 1',
            ],
            [
                'id_persyaratan' => '10',
                'deskripsi' => 'PKG',
            ],
            [
                'id_persyaratan' => '10',
                'deskripsi' => 'DUPAK',
            ],
            [
                'id_persyaratan' => '10',
                'deskripsi' => 'Sertifikat 30 Jam (Minimal 3 File)',
            ],
            [
                'id_persyaratan' => '10',
                'deskripsi' => 'Resume Kegiatan',
            ],
            //
            [
                'id_persyaratan' => '11',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '11',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '11',
                'deskripsi' => 'Pengembangan Diri 1',
            ],
            [
                'id_persyaratan' => '11',
                'deskripsi' => 'PKG',
            ],
            [
                'id_persyaratan' => '11',
                'deskripsi' => 'DUPAK',
            ],
            [
                'id_persyaratan' => '11',
                'deskripsi' => 'Sertifikat 30 Jam (Minimal 3 File)',
            ],
            [
                'id_persyaratan' => '11',
                'deskripsi' => 'Resume Kegiatan',
            ],
            //
            [
                'id_persyaratan' => '12',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '12',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '12',
                'deskripsi' => 'Pengembangan Diri 1',
            ],
            [
                'id_persyaratan' => '12',
                'deskripsi' => 'PKG',
            ],
            [
                'id_persyaratan' => '12',
                'deskripsi' => 'DUPAK',
            ],
            [
                'id_persyaratan' => '12',
                'deskripsi' => 'Sertifikat 30 Jam (Minimal 3 File)',
            ],
            [
                'id_persyaratan' => '12',
                'deskripsi' => 'Resume Kegiatan',
            ],
            //
            [
                'id_persyaratan' => '13',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '13',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '13',
                'deskripsi' => 'Pengembangan Diri 1',
            ],
            [
                'id_persyaratan' => '13',
                'deskripsi' => 'PKG',
            ],
            [
                'id_persyaratan' => '13',
                'deskripsi' => 'DUPAK',
            ],
            [
                'id_persyaratan' => '13',
                'deskripsi' => 'Sertifikat 30 Jam (Minimal 3 File)',
            ],
            [
                'id_persyaratan' => '13',
                'deskripsi' => 'Resume Kegiatan',
            ],
            //
            [
                'id_persyaratan' => '14',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '14',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '14',
                'deskripsi' => 'PTK 2',
            ],
            [
                'id_persyaratan' => '14',
                'deskripsi' => 'Pengembangan Diri 2',
            ],
            [
                'id_persyaratan' => '14',
                'deskripsi' => 'PKG',
            ],
            [
                'id_persyaratan' => '14',
                'deskripsi' => 'DUPAK',
            ],
            [
                'id_persyaratan' => '14',
                'deskripsi' => 'Sertifikat 30 Jam (Minimal 3 File)',
            ],
            [
                'id_persyaratan' => '14',
                'deskripsi' => 'Resume Kegiatan',
            ],
            //
            [
                'id_persyaratan' => '15',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '15',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '15',
                'deskripsi' => 'Pengembangan Diri 4',
            ],
            [
                'id_persyaratan' => '15',
                'deskripsi' => 'PKG',
            ],
            [
                'id_persyaratan' => '15',
                'deskripsi' => 'DUPAK',
            ],
            [
                'id_persyaratan' => '15',
                'deskripsi' => 'Sertifikat 30 Jam (Minimal 4 File)',
            ],
            [
                'id_persyaratan' => '15',
                'deskripsi' => 'Resume Kegiatan',
            ],
            [
                'id_persyaratan' => '15',
                'deskripsi' => 'Jurnal 1',
            ],
            //
            [
                'id_persyaratan' => '16',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '16',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '16',
                'deskripsi' => 'Pengembangan Diri 4',
            ],
            [
                'id_persyaratan' => '16',
                'deskripsi' => 'PKG',
            ],
            [
                'id_persyaratan' => '16',
                'deskripsi' => 'DUPAK',
            ],
            [
                'id_persyaratan' => '16',
                'deskripsi' => 'Sertifikat 30 Jam (Minimal 4 File)',
            ],
            [
                'id_persyaratan' => '16',
                'deskripsi' => 'Resume Kegiatan',
            ],
            [
                'id_persyaratan' => '16',
                'deskripsi' => 'Jurnal 1',
            ],
            //
            [
                'id_persyaratan' => '17',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '17',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '17',
                'deskripsi' => 'Pengembangan Diri 4',
            ],
            [
                'id_persyaratan' => '17',
                'deskripsi' => 'PKG',
            ],
            [
                'id_persyaratan' => '17',
                'deskripsi' => 'DUPAK',
            ],
            [
                'id_persyaratan' => '17',
                'deskripsi' => 'Sertifikat 30 Jam (Minimal 4 File)',
            ],
            [
                'id_persyaratan' => '17',
                'deskripsi' => 'Resume Kegiatan',
            ],
            [
                'id_persyaratan' => '17',
                'deskripsi' => 'Jurnal 1',
            ],
            //

        ];

        $persyaratanKenaikanPangkatPegawai = [
            // Kenaikan Pangkat Pegawai
            [
                'id_persyaratan' => '18',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '18',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '18',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '18',
                'deskripsi' => 'SK 80%',
            ],
            [
                'id_persyaratan' => '18',
                'deskripsi' => 'SK 100%',
            ],
            [
                'id_persyaratan' => '18',
                'deskripsi' => 'SK Terakhir',
            ],
            [
                'id_persyaratan' => '18',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '18',
                'deskripsi' => 'Sertifikat Ujian Dinas (Bagi yang penyesuaian ijazah)',
            ],
            //
            [
                'id_persyaratan' => '19',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '19',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '19',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '19',
                'deskripsi' => 'SK 80%',
            ],
            [
                'id_persyaratan' => '19',
                'deskripsi' => 'SK 100%',
            ],
            [
                'id_persyaratan' => '19',
                'deskripsi' => 'SK Terakhir',
            ],
            [
                'id_persyaratan' => '19',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '19',
                'deskripsi' => 'Sertifikat Ujian Dinas (Bagi yang penyesuaian ijazah)',
            ],
            //
            [
                'id_persyaratan' => '20',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '20',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '20',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '20',
                'deskripsi' => 'SK 80%',
            ],
            [
                'id_persyaratan' => '20',
                'deskripsi' => 'SK 100%',
            ],
            [
                'id_persyaratan' => '20',
                'deskripsi' => 'SK Terakhir',
            ],
            [
                'id_persyaratan' => '20',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '20',
                'deskripsi' => 'Sertifikat Ujian Dinas (Bagi yang penyesuaian ijazah)',
            ],
            //
            [
                'id_persyaratan' => '21',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '21',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '21',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '21',
                'deskripsi' => 'SK 80%',
            ],
            [
                'id_persyaratan' => '21',
                'deskripsi' => 'SK 100%',
            ],
            [
                'id_persyaratan' => '21',
                'deskripsi' => 'SK Terakhir',
            ],
            [
                'id_persyaratan' => '21',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '21',
                'deskripsi' => 'Sertifikat Ujian Dinas (Bagi yang penyesuaian ijazah)',
            ],
            //
            [
                'id_persyaratan' => '22',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '22',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '22',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '22',
                'deskripsi' => 'SK 80%',
            ],
            [
                'id_persyaratan' => '22',
                'deskripsi' => 'SK 100%',
            ],
            [
                'id_persyaratan' => '22',
                'deskripsi' => 'SK Terakhir',
            ],
            [
                'id_persyaratan' => '22',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '22',
                'deskripsi' => 'Sertifikat Ujian Dinas (Bagi yang penyesuaian ijazah)',
            ],
            //
            [
                'id_persyaratan' => '23',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '23',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '23',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '23',
                'deskripsi' => 'SK 80%',
            ],
            [
                'id_persyaratan' => '23',
                'deskripsi' => 'SK 100%',
            ],
            [
                'id_persyaratan' => '23',
                'deskripsi' => 'SK Terakhir',
            ],
            [
                'id_persyaratan' => '23',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '23',
                'deskripsi' => 'Sertifikat Ujian Dinas (Bagi yang penyesuaian ijazah)',
            ],
            //
            [
                'id_persyaratan' => '24',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '24',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '24',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '24',
                'deskripsi' => 'SK 80%',
            ],
            [
                'id_persyaratan' => '24',
                'deskripsi' => 'SK 100%',
            ],
            [
                'id_persyaratan' => '24',
                'deskripsi' => 'SK Terakhir',
            ],
            [
                'id_persyaratan' => '24',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '24',
                'deskripsi' => 'Sertifikat Ujian Dinas (Bagi yang penyesuaian ijazah)',
            ],
            //
            [
                'id_persyaratan' => '25',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '25',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '25',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '25',
                'deskripsi' => 'SK 80%',
            ],
            [
                'id_persyaratan' => '25',
                'deskripsi' => 'SK 100%',
            ],
            [
                'id_persyaratan' => '25',
                'deskripsi' => 'SK Terakhir',
            ],
            [
                'id_persyaratan' => '25',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '25',
                'deskripsi' => 'Sertifikat Ujian Dinas (Bagi yang penyesuaian ijazah)',
            ],
            //
            [
                'id_persyaratan' => '26',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '26',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '26',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '26',
                'deskripsi' => 'SK 80%',
            ],
            [
                'id_persyaratan' => '26',
                'deskripsi' => 'SK 100%',
            ],
            [
                'id_persyaratan' => '26',
                'deskripsi' => 'SK Terakhir',
            ],
            [
                'id_persyaratan' => '26',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '26',
                'deskripsi' => 'Sertifikat Ujian Dinas (Bagi yang penyesuaian ijazah)',
            ],
            //
            [
                'id_persyaratan' => '27',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '27',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '27',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '27',
                'deskripsi' => 'SK 80%',
            ],
            [
                'id_persyaratan' => '27',
                'deskripsi' => 'SK 100%',
            ],
            [
                'id_persyaratan' => '27',
                'deskripsi' => 'SK Terakhir',
            ],
            [
                'id_persyaratan' => '27',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '27',
                'deskripsi' => 'Sertifikat Ujian Dinas (Bagi yang penyesuaian ijazah)',
            ],
            //
            [
                'id_persyaratan' => '28',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '28',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '28',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '28',
                'deskripsi' => 'SK 80%',
            ],
            [
                'id_persyaratan' => '28',
                'deskripsi' => 'SK 100%',
            ],
            [
                'id_persyaratan' => '28',
                'deskripsi' => 'SK Terakhir',
            ],
            [
                'id_persyaratan' => '28',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '28',
                'deskripsi' => 'Sertifikat Ujian Dinas (Bagi yang penyesuaian ijazah)',
            ],
            //
            [
                'id_persyaratan' => '29',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '29',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '29',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '29',
                'deskripsi' => 'SK 80%',
            ],
            [
                'id_persyaratan' => '29',
                'deskripsi' => 'SK 100%',
            ],
            [
                'id_persyaratan' => '29',
                'deskripsi' => 'SK Terakhir',
            ],
            [
                'id_persyaratan' => '29',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '29',
                'deskripsi' => 'Sertifikat Ujian Dinas (Bagi yang penyesuaian ijazah)',
            ],
            //
            [
                'id_persyaratan' => '30',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '30',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '30',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '30',
                'deskripsi' => 'SK 80%',
            ],
            [
                'id_persyaratan' => '30',
                'deskripsi' => 'SK 100%',
            ],
            [
                'id_persyaratan' => '30',
                'deskripsi' => 'SK Terakhir',
            ],
            [
                'id_persyaratan' => '30',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '30',
                'deskripsi' => 'Sertifikat Ujian Dinas (Bagi yang penyesuaian ijazah)',
            ],
            //
            [
                'id_persyaratan' => '31',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '31',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '31',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '31',
                'deskripsi' => 'SK 80%',
            ],
            [
                'id_persyaratan' => '31',
                'deskripsi' => 'SK 100%',
            ],
            [
                'id_persyaratan' => '31',
                'deskripsi' => 'SK Terakhir',
            ],
            [
                'id_persyaratan' => '31',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '31',
                'deskripsi' => 'Sertifikat Ujian Dinas (Bagi yang penyesuaian ijazah)',
            ],
            //
            [
                'id_persyaratan' => '32',
                'deskripsi' => 'SK Pangkat Terakhir',
            ],
            [
                'id_persyaratan' => '32',
                'deskripsi' => 'SKP 2 Tahun Terakhir',
            ],
            [
                'id_persyaratan' => '32',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '32',
                'deskripsi' => 'SK 80%',
            ],
            [
                'id_persyaratan' => '32',
                'deskripsi' => 'SK 100%',
            ],
            [
                'id_persyaratan' => '32',
                'deskripsi' => 'SK Terakhir',
            ],
            [
                'id_persyaratan' => '32',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '32',
                'deskripsi' => 'Sertifikat Ujian Dinas (Bagi yang penyesuaian ijazah)',
            ],
            //
        ];

        $persyaratanBerkasDasarGuru = [
            // Berkas Dasar Guru
            [
                'id_persyaratan' => '33',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '33',
                'deskripsi' => 'Kartu Tanda Penduduk (KTP)',
            ],
            [
                'id_persyaratan' => '33',
                'deskripsi' => 'Kartu Keluarga (KK)',
            ],
            [
                'id_persyaratan' => '33',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '33',
                'deskripsi' => 'Kartu NUPTK',
            ],
            [
                'id_persyaratan' => '33',
                'deskripsi' => 'Sertifikasi Guru (Tidak Wajib)',
            ],
            [
                'id_persyaratan' => '33',
                'deskripsi' => 'SK CPNS',
            ],
            [
                'id_persyaratan' => '33',
                'deskripsi' => 'SK PNS',
            ],
            [
                'id_persyaratan' => '33',
                'deskripsi' => 'SK Kenaikan Gaji Berkala',
            ],
            [
                'id_persyaratan' => '33',
                'deskripsi' => 'SK Kenaikan Pangkat',
            ],
            [
                'id_persyaratan' => '33',
                'deskripsi' => 'SPMT',
            ],


        ];

        $persyaratanBerkasDasarPegawai = [
            // Berkas Dasar Pegawai
            [
                'id_persyaratan' => '34',
                'deskripsi' => 'Kartu Pegawai',
            ],
            [
                'id_persyaratan' => '34',
                'deskripsi' => 'Kartu Tanda Penduduk (KTP)',
            ],
            [
                'id_persyaratan' => '34',
                'deskripsi' => 'Kartu Keluarga (KK)',
            ],
            [
                'id_persyaratan' => '34',
                'deskripsi' => 'Ijazah Terakhir',
            ],
            [
                'id_persyaratan' => '34',
                'deskripsi' => 'Kartu NUPTK (Tidak Wajib)',
            ],
            [
                'id_persyaratan' => '34',
                'deskripsi' => 'SK CPNS',
            ],
            [
                'id_persyaratan' => '34',
                'deskripsi' => 'SK PNS',
            ],
            [
                'id_persyaratan' => '34',
                'deskripsi' => 'SK Kenaikan Gaji Berkala',
            ],
            [
                'id_persyaratan' => '34',
                'deskripsi' => 'SK Kenaikan Pangkat',
            ],
            [
                'id_persyaratan' => '34',
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
