<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $role = array('Guru', 'Pegawai', 'Admin');
        $jenis_guru = array('Guru Kelas', 'Kepala Sekolah', 'Tenaga Administrasi Sekolah');
        $status_kepegawaian = array('PNS', 'PNS Depag', 'PNS Diperbantukan', 'Tenaga Honor Sekolah', 'Guru Honor Sekolah', 'GTY/PTY');
        return [
            'nama' => $this->faker->name(),
            'nip' => $this->faker->unique()->numerify('##################'),
            'username' => $this->faker->unique()->numerify('##################'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'jenis_guru' => $jenis_guru[array_rand($jenis_guru)],
            'status_kepegawaian' => $status_kepegawaian[array_rand($status_kepegawaian)],
            'role' => $role[array_rand($role)],
            'status' => 1,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
