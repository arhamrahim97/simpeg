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
        $pendidikan_terakhir = array('SLTA/Sederajat', 'Diploma I/II', 'Akademi/Diploma III/Sarjana Muda', 'Diploma IV/Strata I', 'Strata II');
        $jenis_asn = array('Guru', 'Pegawai');
        $jenis_guru = array('Guru Kelas', 'Guru Mata Pelajaran', 'Guru Bimbingan dan Konseling');
        $status = array('PNS', 'PKKK', 'Honorer');
        $jenis_jabatan = array('Struktural', 'Fungsional');

        $no = 0;

        return [
            'id_user' => $this->faker->unique()->numberBetween(1, 2),
            'nama' => $this->faker->name(),
            'jenis_kelamin' => $jenis_kelamin[array_rand($jenis_kelamin)],
            'tempat_lahir' => $this->faker->state(),
            'tanggal_lahir' => $this->faker->date('Y-m-d', 'now'),
            'no_hp' => $this->faker->unique()->numerify('08##########'),
            'email' => $this->faker->email(),
            'alamat' => $this->faker->address(),
            'pendidikan_terakhir' => $pendidikan_terakhir[array_rand($pendidikan_terakhir)],
            'jenis_asn' => $jenis_asn[array_rand($jenis_asn)],
            'jenis_guru' => $jenis_guru[array_rand($jenis_guru)],
            'nip' => $this->faker->unique()->numerify('##################'),
            'nuptk' => $this->faker->unique()->numerify('################'),
            'unit_kerja' => mt_rand(1, 4),
            'status' => $status[array_rand($status)],
            'jenis_jabatan' => $jenis_jabatan[array_rand($jenis_jabatan)],
            'jabatan_pangkat_golongan' => 1,
            'tanggal_kerja' => '2005-08-16',
            'nilai_gaji' => mt_rand(1, 19) . '000000',
            'tmt_gaji' => date('Y-m-d H:i:s'),
            'tmt_pangkat' => date('Y-m-d H:i:s'),
            'foto' => 'test.jpg'
        ];
    }
}
