<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CountrySeeder::class,
            MessageSeeder::class, // Las 366 frases diarias
            MailConfigsSeeder::class, // Las 5 configuraciones visuales de plantillas
            BranchSeeder::class,
        ]);
    }
}
