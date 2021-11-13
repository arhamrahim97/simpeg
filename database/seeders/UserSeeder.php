<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 8 User
        $this->faker = Faker::create();
        $role = array('Admin','Guru','Pegawai','Tim Penilai','Admin Kepegawaian','KASUBAG Kepegawaian dan Umum','Sekretaris','Kepala Dinas');
        $username = array('admin','guru','pegawai','tim_penilai','admin_kepegawaian','kasubag','sekretaris','kepala_dinas');
        for($i = 0;$i < count($username);$i++){
            $user = [
                'nama' => $this->faker->name(),
                'nip' => $this->faker->unique()->numerify('##################'),
                'username' => $username[$i],
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'role' => $role[$i],
                'status' => 1,
            ];
            DB::table('user')->insert($user);
        }
    }
}
