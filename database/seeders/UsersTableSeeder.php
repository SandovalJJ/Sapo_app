<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Crear un usuario de ejemplo
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), // Utiliza Hash::make para cifrar la contraseña
        ]);

        // Puedes crear más usuarios aquí según tus necesidades
    }
}