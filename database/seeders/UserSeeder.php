<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'username' => 'admin', 
            'password' => bcrypt('admin123'), 
            'firstname' => 'Admin', 
            'lastname' => 'User', 
            'user_type_id' => 1
        ]);

        User::create([
            'username' => 'common', 
            'password' => bcrypt('common123'), 
            'firstname' => 'Common', 
            'lastname' => 'User', 
            'user_type_id' => 2
        ]);
    }
}
