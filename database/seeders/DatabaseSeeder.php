<?php

namespace Database\Seeders;

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
        $this->call(JabatanFungsionalSeeder::class);
        $this->call(JabatanStrukturalSeeder::class);
        $this->call(UnitKerjaSeeder::class);
    }
}
