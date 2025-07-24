<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Uli;
use Carbon\Carbon;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password'
        ]);
        $tanggal = Carbon::now()->format('Y-m-d');
        Uli::create([
            'tanggal' => $tanggal,
            'kategori' => 'cadangan',
            'uli_25' => 100,
            'uli_5' => 100,
            'uli_10' => 100,
            'total' => (100 * 2500) + (100 * 5000) + (100 * 10000),
        ]);

        Uli::create([
            'tanggal' => $tanggal,
            'kategori' => 'beredar',
            'uli_25' => 200,
            'uli_5' => 200,
            'uli_10' => 200,
            'total' => (200 * 2500) + (200 * 5000) + (200 * 10000),
        ]);
    }
}
