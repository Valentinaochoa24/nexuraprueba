<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class empleadoRolSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empleado_rols')->insert([
            'empleado_id'=>1,
            'rol_id'=>2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('empleado_rols')->insert([
            'empleado_id'=>1,
            'rol_id'=>3,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
