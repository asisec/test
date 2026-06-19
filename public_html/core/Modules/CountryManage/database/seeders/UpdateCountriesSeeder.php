<?php

namespace Modules\CountryManage\database\seeders;

use Illuminate\Database\Seeder;
use Modules\CountryManage\app\Models\Country;

class UpdateCountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $turkey = Country::where('country_code', 'TR')
            ->orWhere('country', 'Turkey')
            ->orWhere('country', 'Türkiye')
            ->first();

        if ($turkey) {
            $turkey->update([
                'country' => 'Türkiye',
                'country_code' => 'TR',
                'status' => 1,
            ]);
        } else {
            Country::create([
                'country' => 'Türkiye',
                'country_code' => 'TR',
                'status' => 1,
            ]);
        }

        $china = Country::where('country_code', 'CN')->first();

        if (! $china) {
            Country::create([
                'country' => 'China',
                'country_code' => 'CN',
                'status' => 1,
            ]);
        }
    }
}
