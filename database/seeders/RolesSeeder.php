<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insertar el rol de Administrador
        DB::table('roles')->insert([
            'rol' => 'Administrador',
        ]);

        // Insertar el rol de Coordinador
        DB::table('roles')->insert([
            'rol' => 'Coordinador',
        ]);

        // Insertar el rol de Invitado
        DB::table('roles')->insert([
            'rol' => 'Invitado',
        ]);
    }
}