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
        // DB::table('users')->truncate();
        DB::table('users')->insert(
            [
                [
                    'username' => 'admin1111',
                    'user_type' => 'Admin',
                    'email' => 'admin@aa.com',
                    'password' => bcrypt('12345678'),
                ],
                [
                    'username' => 'viewer1111',
                    'user_type' => 'Viewer',
                    'email' => 'user@aa.com',
                    'password' => bcrypt('12345678'),
                ]
            ] // password
        );
    }
}
