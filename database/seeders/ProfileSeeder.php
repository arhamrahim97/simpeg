<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        $guru = [
            [
                'id_user' => 2,
                'nama' => $this->faker->name(),
                'jenis_kelamin' => "Laki-Laki",
                'tempat_lahir' => $this->faker->state(),
                'tanggal_lahir' => $this->faker->date('Y-m-d', 'now'),
                'no_hp' => $this->faker->unique()->numerify('08##########'),
                'email' => $this->faker->email(),
                'alamat' => $this->faker->address(),
                'pendidikan_terakhir' => 'Diploma IV/Strata I',
                'jenis_asn' => 'Guru',
                'jenis_guru' => 'Guru Mata Pelajaran',
                'nip' => $this->faker->unique()->numerify('##################'),
                'nuptk' => $this->faker->unique()->numerify('################'),
                'unit_kerja' => mt_rand(1, 4),
                'status' => 'PNS',
                'jenis_jabatan' => 'Fungsional',
                'jabatan_pangkat_golongan' => 4,
                'tanggal_kerja' => '2005-08-16',
                'nilai_gaji' => mt_rand(1, 19) . '000000',
                'tmt_gaji' => '2015-08-16',
                'status_berkas_dasar' => 1,
                'status_profile' => 1,
                'tmt_pangkat' => '2015-08-16',
                'foto' => 'profildummy.jpg'
            ],
            [
                'id_user' => 3,
                'nama' => $this->faker->name(),
                'jenis_kelamin' => "Perempuan",
                'tempat_lahir' => $this->faker->state(),
                'tanggal_lahir' => $this->faker->date('Y-m-d', 'now'),
                'no_hp' => $this->faker->unique()->numerify('08##########'),
                'email' => $this->faker->email(),
                'alamat' => $this->faker->address(),
                'pendidikan_terakhir' => 'Strata II',
                'jenis_asn' => 'Pegawai',
                'jenis_guru' => 'Guru Mata Pelajaran',
                'nip' => $this->faker->unique()->numerify('##################'),
                'nuptk' => $this->faker->unique()->numerify('################'),
                'unit_kerja' => mt_rand(1, 4),
                'status' => 'PNS',
                'jenis_jabatan' => 'Struktural',
                'jabatan_pangkat_golongan' => 4,
                'tanggal_kerja' => '2005-08-16',
                'nilai_gaji' => mt_rand(1, 19) . '000000',
                'tmt_gaji' => '2015-08-16',
                'status_berkas_dasar' => 1,
                'status_profile' => 1,
                'tmt_pangkat' => '2015-08-16',
                'foto' => 'profildummy.jpg'
            ],
        ];
        DB::table('profile_guru_pegawai')->insert($guru);
    }
}
