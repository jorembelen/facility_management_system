<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Jorem Belen',
            'username' => 'jorem.belen',
            'email' => 'rcl.support@rezayat.net',
            'role' => 'super_admin',
            'password' => 'password',
        ]);

        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@joreb.net',
            'role' => 'admin',
            'password' => 'password',
        ]);

        User::create([
            'name' => 'Supervisor',
            'username' => 'supervisor',
            'email' => 'supervisor@joreb.net',
            'role' => 'supervisor',
            'password' => 'password',
        ]);

        User::create([
            'name' => 'Assigner',
            'username' => 'assigner',
            'email' => 'assigner@joreb.net',
            'role' => 'assigner',
            'password' => 'password',
        ]);

    }
}
