<?php

namespace Database\Seeders;

use App\Models\ProfileGuruPegawai;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ProfileSeeder;
use Database\Seeders\UnitKerjaSeeder;
use Database\Seeders\BerkasDasarSeeder;
use Database\Seeders\PersyaratanSeeder;
use Database\Seeders\ProfilePejabatSeeder;
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
        User::factory(50)->create();
        ProfileGuruPegawai::factory(50)->create();
        // $this->call(UserSeeder::class);
        // $this->call(ProfileSeeder::class);
        
        $this->call(JabatanFungsionalSeeder::class);
        $this->call(JabatanStrukturalSeeder::class);
        $this->call(UnitKerjaSeeder::class);
        $this->call(PersyaratanSeeder::class);
        $this->call(DeskripsiPersyaratanSeeder::class);

        $this->call(BerkasDasarSeeder::class);
//         $this->call(UserSeeder::class);
//         $this->call(ProfileSeeder::class);
        // $this->call(BerkasDasarSeeder::class);
        $this->call(ProfilePejabatSeeder::class);
        $this->call(JabatanStrukturalTableSeeder::class);
    }
}