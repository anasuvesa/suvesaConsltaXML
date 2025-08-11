<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'OBSadmin',
            'email' => 'rolando.obando@gmail.com',
            'password' => bcrypt('+$+%1a2@3a4a5at@Pc1+.#')
        ]);

        User::create([
            'name' => 'Obsoluciones',
            'email' => 'tiobscr@gmail.com',
            'password' => bcrypt('14121988')
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
