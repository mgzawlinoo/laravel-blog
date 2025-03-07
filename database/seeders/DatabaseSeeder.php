<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);

        User::factory()->create([
            'name' => 'Mg Mg',
            'email' => 'mgmg@example.com',
        ]);

        User::factory()->create([
            'name' => 'Hla Hla',
            'email' => 'hlahla@example.com',
        ]);

        $this->call([
            CategorySeeder::class,
            // PostSeeder::class
        ]);

    }
}
