<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTypesSeeder extends Seeder
{
    // Nota: estos datos los cargué yo para arrancar más rápido el proyecto.
    public function run(): void
    {
        DB::table('user_types')->insertOrIgnore([
            ['id'=>1, 'user_type'=>'Admin', 'description'=>'Usuario con control total'],
            ['id'=>2, 'user_type'=>'Empresa', 'description'=>'Empresa que publica ofertas'],
            ['id'=>3, 'user_type'=>'Cliente', 'description'=>'Cliente que compra ofertas'],
        ]);

        // Usuario admin por defecto (puedo cambiar la contraseña luego en producción)
        if (!DB::table('users')->where('email','admin@demo.test')->exists()) {
            DB::table('users')->insert([
                'firstname'=>'Admin',
                'lastname'=>'Principal',
                'email'=>'admin@demo.test',
                'password'=>Hash::make('admin123'), // Cambiarla luego
                'user_type_id'=>1,
                'created_at'=>now(),
                'updated_at'=>now(),
            ]);
        }
    }
}
