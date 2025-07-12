<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            [
                'email' => 'admin@example.com' // Kunci unik untuk dicari
            ],
            [
                'name' => 'Admin', // Data yang akan diisi/diperbarui
                'password' => Hash::make('password'), // ganti dengan passwordmu
            ]
        );
    }
}
