<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class rolSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('rols')->insert([
            'nombre' => 'Auxiliar administrativo',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('rols')->insert([
            'nombre' => 'Desarrollador',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('rols')->insert([
            'nombre' => 'Analista',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('rols')->insert([
            'nombre' => 'Tester',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('rols')->insert([
            'nombre' => 'Diseñador',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('rols')->insert([
            'nombre' => 'Profesional PMO',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('rols')->insert([
            'nombre' => 'Profesional de servicios',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('rols')->insert([
            'nombre' => 'Codirector',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
