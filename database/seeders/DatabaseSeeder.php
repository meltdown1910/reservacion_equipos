<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@reservaciones.com',
            'password' => 'Admin12345',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Estudiante',
            'email' => 'estudiante@reservaciones.com',
            'password' => 'Estudiante12345',
            'role' => 'student',
        ]);
    }
}
