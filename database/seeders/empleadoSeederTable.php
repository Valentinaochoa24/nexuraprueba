<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class empleadoSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empleados')->insert([
            'nombre' => 'Pedro Perez',
            'email'=> 'pperez@example.co',
            'sexo'=> 'M',
            'area_id'=> 5,
            'boletin'=>1,
            'descripcion'=> 'Hola mundo',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
    }
}
