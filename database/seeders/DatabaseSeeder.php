<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
// Ajoute cette ligne :
use Database\Seeders\StorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // // Exemple de seed utilisateur
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Ajoute cette ligne pour lancer le StorySeeder
        $this->call(StorySeeder::class);
    }
}
