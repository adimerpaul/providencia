<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
        $user = User::create([
            'name' => 'Chambi Ajata Adimer Paul ',
            'username' => 'admin',
            'avatar' => 'default.png',
//            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123Admin'),
            'role' => 'Admin',
        ]);
        $user = User::create([
            'name' => 'Chambi Ajhuacho Maribel',
            'username' => 'maribel',
            'avatar' => 'default.png',
//            'email' => 'admin@gmail.com',
            'password' => bcrypt('maribel123Maribel'),
        ]);
        $sqlFile = file_get_contents(base_path('database/seeders/productos_202502251544.sql'));
        DB::unprepared($sqlFile);
    }
}
