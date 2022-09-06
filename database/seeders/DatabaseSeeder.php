<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([areaSeederTable::class]);
        $this->call([empleadoSeederTable::class]);
        $this->call([rolSeederTable::class]);
        $this->call([empleadoRolSeederTable::class]);
    }
}
