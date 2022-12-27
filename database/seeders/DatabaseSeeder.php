<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $array1 = ['ACTIVO', 'ELIMINADO', 'SUSPENDIDO', 'MANTENIMIENTO'];
        foreach ($array1 as $key => $value) {
            DB::table('tipo_estados')->insert([
                'nombre' => $value,
                'switch' => 'CRUD',
                'estado' => 1
            ]);
        }

        $array3 = ['SUPER_ADMIN', 'ADMINISTRADOR', 'USUARIO', 'VISITANTE'];

        foreach ($array3 as $key => $value) {
            DB::table('tipo_roles')->insert([
                'nombre' => $value,
                'tipo_estado_id' => 1
            ]);
        }

        $array5 = ['PALACIO MUNICIPAL', 'OTRO',];
        foreach ($array5 as $key => $value) {
            DB::table('sedes')->insert([
                "nombre" => $value,
                "tipo_estado_id" => 1
            ]);
        }
    }
}
