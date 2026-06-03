<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\Country;

class BranchSeeder extends Seeder
{
    public function run(): void
    {
        $branchesData = [
            ['code' => 'CEON', 'company_name' => 'ORBE',   'country' => 'Nicaragua'],
            ['code' => 'ATI',  'company_name' => 'ATI',    'country' => 'Costa Rica'],
            ['code' => 'CEOH', 'company_name' => 'ORBE',   'country' => 'Honduras'],
            ['code' => 'NTE',  'company_name' => 'NOVA',   'country' => 'Costa Rica'],
            ['code' => 'CEOG', 'company_name' => 'ORBE',   'country' => 'Guatemala'],
            ['code' => 'CEOS', 'company_name' => 'ORBE',   'country' => 'El Salvador'],
            ['code' => 'SCO',  'company_name' => 'SISCON', 'country' => 'Costa Rica'],
            ['code' => 'CEO',  'company_name' => 'ORBE',   'country' => 'Costa Rica'],
            ['code' => 'CEOC', 'company_name' => 'ORBE',   'country' => 'Colombia'],
            ['code' => 'CEOP', 'company_name' => 'ORBE',   'country' => 'Panamá'],
        ];

        foreach ($branchesData as $branch) {
            $country = Country::where('name', $branch['country'])->first();

            if ($country) {
                Branch::firstOrCreate(
                    ['code' => $branch['code']],
                    [
                        'company_name' => $branch['company_name'],
                        'country_id'   => $country->id,
                        'estado'       => true
                    ]
                );
            }
        }
    }
}
