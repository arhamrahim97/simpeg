<?php

namespace Database\Factories;

use App\Models\ProfileGuruPegawai;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileGuruPegawaiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProfileGuruPegawai::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $jenis_kelamin = array('Laki-laki', 'Perempuan');
        $pendidikan_terakhir = array('SMP / Sederajat', 'SMA / Sederajat', 'D3', 'S1', 'S2');
        $jenis_asn = array('Guru', 'Pegawai');
        $jenis_guru = array('Guru BK', 'Guru Kelas', 'Guru Mapel', 'Guru Pendamping', 'Guru Pendamping Khusus', 'Guru Pengganti', 'Guru TIK', 'Instruktur', 'Kepala Sekolah', 'Laboran', 'Penjaga Sekolah', 'Pesuruh/Office Boy', 'Petugas Keamanan', 'Tenaga Administrasi Sekolah', 'Tenaga Perpustakaan', 'Tukang Kebun', 'Tutor', 'Lainnya');
        $bidang_studi = array('Administrasi dan Supervisi pendidikan', 'Akuntansi Manajemen', 'Arsitektur', 'Bahasa Dan Sastra Indonesia', 'Bahasa Inggris', 'Biologi', 'Ekonomi', 'Manajemen Informatika dan Komputer', 'Pendidikan Agama Islam', 'Lainnya');
        $mata_pelajaran = array('Bahasa Indonesia', 'Bahasa Inggris', 'Ekonomi', 'Ilmu Pengetahuan Alam (IPA)', 'Matematika (Umum)', 'Pendidikan Agama Islam', 'Pendidikan Kewarganegaraan', 'Teknologi Informasi dan Komunikasi', 'Lainnya');
        $status = array('GTY/PTY', 'Guru Honor Sekolah', 'Honor Daerah TK.I Provinsi', 'Honor Daerah TK.II Kab/Kota', 'PNS', 'PNS Depag', 'PNS Diperbantukan', 'Tenaga Honor Sekolah', 'Lainnya');
        $kecamatan = array('Mantikulore', 'Palu Barat', 'Palu Timur');
        $jenis_jabatan = array('Struktural', 'Fungsional');

        return [
            'id_user' => $this->faker->unique()->numberBetween(1, 50),
            'nama' => $this->faker->name(),
            'nik' => $this->faker->unique()->numerify('################'),
            'jenis_kelamin' => $jenis_kelamin[array_rand($jenis_kelamin)],
            'tempat_lahir' => $this->faker->state(),
            'tanggal_lahir' => $this->faker->date('Y-m-d', 'now'),
            'no_hp' => $this->faker->unique()->numerify('08##########'),
            'email' => $this->faker->email(),
            'alamat' => $this->faker->address(),
            'pendidikan_terakhir' => $pendidikan_terakhir[array_rand($pendidikan_terakhir)],
            'jenis_asn' => $jenis_asn[array_rand($jenis_asn)],
            'jenis_guru' => $jenis_guru[array_rand($jenis_guru)],
            'bidang_studi' => $bidang_studi[array_rand($bidang_studi)],
            'mata_pelajaran' => $mata_pelajaran[array_rand($mata_pelajaran)],
            'nip' => $this->faker->unique()->numerify('##################'),
            'npsn' => $this->faker->unique()->numerify('########'),
            'nuptk' => $this->faker->unique()->numerify('################'),
            'unit_kerja' => mt_rand(1, 5),
            'kecamatan' => $kecamatan[array_rand($kecamatan)],
            'status' => $status[array_rand($status)],
            'jenis_jabatan' => $jenis_jabatan[array_rand($jenis_jabatan)],
            'jabatan_pangkat_golongan' => mt_rand(1, 17),
            'tanggal_kerja' => '2005-08-16',
            'nilai_gaji' => mt_rand(1, 19) . '000000',
            'tmt_gaji' => $this->faker->dateTimeBetween('-3 years', 'now'),
            'tmt_pengangkatan' => $this->faker->dateTimeBetween('2010-01-01', '2015-01-01'),
            'tmt_pangkat' => $this->faker->dateTimeBetween('-5 years', 'now'),
            // 'foto' => 'test.jpg'
        ];
    }
}