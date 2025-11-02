<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersDemoSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email'=>'empresa@demo.test'],
            ['firstname'=>'Empresa','lastname'=>'Demo','password'=>Hash::make('empresa123'),'user_type_id'=>2]
        );

        User::updateOrCreate(
            ['email'=>'cliente@demo.test'],
            ['firstname'=>'Cliente','lastname'=>'Demo','password'=>Hash::make('cliente123'),'user_type_id'=>3]
        );
    }
}
