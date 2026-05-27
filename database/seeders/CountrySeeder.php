<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        $countries = [
            'Nicaragua',
            'Costa Rica',
            'Honduras',
            'Guatemala',
            'El Salvador',
            'Colombia',
            'Panamá'
        ];

        foreach ($countries as $countryName) {
            Country::firstOrCreate(
                ['name' => $countryName],
                ['estado' => true]
            );
        }
    }
}
