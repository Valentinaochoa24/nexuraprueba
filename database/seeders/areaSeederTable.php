<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class areaSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('areas')->insert([
            'nombre' => 'Administrativa y financiera',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('areas')->insert([
            'nombre' => 'Ingieneria',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('areas')->insert([
            'nombre' => 'Desarrollo de Negocio',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('areas')->insert([
            'nombre' => 'Proyectos',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('areas')->insert([
            'nombre' => 'Servicios',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('areas')->insert([
            'nombre' => 'Calidad',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
