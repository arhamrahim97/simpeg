<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pangkat;
use App\Models\Profile;
use App\Models\Golongan;
use Illuminate\Database\Seeder;
use Database\Seeders\JabatanStrukturalSeeder;

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
        Profile::factory(2)->create();
        $this->call(JabatanFungsionalSeeder::class);
        $this->call(JabatanStrukturalSeeder::class);
        $this->call(UnitKerjaSeeder::class);
    }
}
