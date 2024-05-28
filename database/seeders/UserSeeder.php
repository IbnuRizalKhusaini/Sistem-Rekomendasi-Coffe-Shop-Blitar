<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'), // or bcrypt('admin')
                'role' => 'admin',
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('user'), // or bcrypt('user')
                'role' => 'user',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
