<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\PostTagSeeder;

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

        User::factory()->create([
            'name' => 'Kyaw Kyaw',
            'email' => 'kyawkyaw@example.com',
        ]);

        User::factory()->create([
            'name' => 'Zaw Zaw',
            'email' => 'zawzaw@example.com',
        ]);

        $this->call([
            CategorySeeder::class,
            TagSeeder::class,
            PostSeeder::class,
            PostTagSeeder::class
        ]);

    }
}
