<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
            'role' => 'admin'
        ], [
            'name' => 'Bagus',
            'email' => 'bagus@admin.com',
            'password' => bcrypt('123456'),
            'role' => 'user'
        ]);
    }
}
