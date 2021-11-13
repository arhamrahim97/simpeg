<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProfilePejabatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        $pejabat = [
            [
                'id_user' => 4,
                'nama' => $this->faker->name(),
                'jenis_kelamin' => "Laki-Laki",
                'tempat_lahir' => $this->faker->state(),
                'tanggal_lahir' => $this->faker->date('Y-m-d', 'now'),
                'no_hp' => $this->faker->unique()->numerify('08##########'),
                'email' => $this->faker->email(),
                'alamat' => $this->faker->address(),
                'nip' => $this->faker->unique()->numerify('##################'),
                'jabatan_pangkat_golongan' => 6,
                'foto' => 'profildummy.jpg',
                'foto_ttd' => 'ttddummy1.png'
            ],
            [
                'id_user' => 5,
                'nama' => $this->faker->name(),
                'jenis_kelamin' => "Perempuan",
                'tempat_lahir' => $this->faker->state(),
                'tanggal_lahir' => $this->faker->date('Y-m-d', 'now'),
                'no_hp' => $this->faker->unique()->numerify('08##########'),
                'email' => $this->faker->email(),
                'alamat' => $this->faker->address(),
                'nip' => $this->faker->unique()->numerify('##################'),
                'jabatan_pangkat_golongan' => 6,
                'foto' => 'profildummy.jpg',
                'foto_ttd' => 'ttddummy2.png'
            ],
            [
                'id_user' => 6,
                'nama' => $this->faker->name(),
                'jenis_kelamin' => "Laki-Laki",
                'tempat_lahir' => $this->faker->state(),
                'tanggal_lahir' => $this->faker->date('Y-m-d', 'now'),
                'no_hp' => $this->faker->unique()->numerify('08##########'),
                'email' => $this->faker->email(),
                'alamat' => $this->faker->address(),
                'nip' => $this->faker->unique()->numerify('##################'),
                'jabatan_pangkat_golongan' => 7,
                'foto' => 'profildummy.jpg',
                'foto_ttd' => 'ttddummy3.png'
            ],
            [
                'id_user' => 7,
                'nama' => $this->faker->name(),
                'jenis_kelamin' => "Laki-Laki",
                'tempat_lahir' => $this->faker->state(),
                'tanggal_lahir' => $this->faker->date('Y-m-d', 'now'),
                'no_hp' => $this->faker->unique()->numerify('08##########'),
                'email' => $this->faker->email(),
                'alamat' => $this->faker->address(),
                'nip' => $this->faker->unique()->numerify('##################'),
                'jabatan_pangkat_golongan' => 8,
                'foto' => 'profildummy.jpg',
                'foto_ttd' => 'ttddummy4.png'
            ],
            [
                'id_user' => 8,
                'nama' => $this->faker->name(),
                'jenis_kelamin' => "Laki-Laki",
                'tempat_lahir' => $this->faker->state(),
                'tanggal_lahir' => $this->faker->date('Y-m-d', 'now'),
                'no_hp' => $this->faker->unique()->numerify('08##########'),
                'email' => $this->faker->email(),
                'alamat' => $this->faker->address(),
                'nip' => $this->faker->unique()->numerify('##################'),
                'jabatan_pangkat_golongan' => 9,
                'foto' => 'profildummy.jpg',
                'foto_ttd' => 'ttddummy5.png'
            ],
        ];
        DB::table('profile_pejabat')->insert($pejabat);
    }
}
