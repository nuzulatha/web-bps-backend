<?php
// seeders\DatabaseSeeders.php
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Hapus semua data dari tabel users
        User::truncate();

        // Buat user baru dengan password yang sudah di-hash
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Ganti 'password' dengan yang Anda mau
        ]);
    }
}
