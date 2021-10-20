<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\ProfileGuruPegawai;
use Database\Seeders\UnitKerjaSeeder;
use Database\Seeders\PersyaratanSeeder;
use Database\Seeders\JabatanFungsionalSeeder;
use Database\Seeders\JabatanStrukturalSeeder;
use Database\Seeders\DeskripsiPersyaratanSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(4)->create();
        ProfileGuruPegawai::factory(2)->create();
        $this->call(JabatanFungsionalSeeder::class);
        $this->call(JabatanStrukturalSeeder::class);
        $this->call(UnitKerjaSeeder::class);
        $this->call(PersyaratanSeeder::class);
        $this->call(DeskripsiPersyaratanSeeder::class);
    }
}
