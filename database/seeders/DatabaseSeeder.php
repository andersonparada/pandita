<?php

namespace Database\Seeders;

use App\Models\Estado;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'              => 'admin',
            'email'             => 'admin@admin.com',
            'email_verified_at' => now(),
            'remember_token'    => Str::random(10),
            'admin'             => 1,
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        Estado::create(['descripcion' => 'PENDIENTE']);
        Estado::create(['descripcion' => 'FINALIZADO']);
    }
}
