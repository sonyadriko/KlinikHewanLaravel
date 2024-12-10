<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama' => 'Admin',
                'email' => 'admin@klinik.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'nama' => 'Dr. John',
                'email' => 'doctor@klinik.com',
                'password' => Hash::make('password'),
                'role' => 'doctor',
            ],
            [
                'nama' => 'Jane Doe',
                'email' => 'patient@klinik.com',
                'password' => Hash::make('password'),
                'role' => 'patient',
            ]
        ]);
    }
}