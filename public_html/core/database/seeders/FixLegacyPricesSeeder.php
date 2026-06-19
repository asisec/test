<?php

namespace Database\Seeders;

use App\Models\Backend\Listing;
use Illuminate\Database\Seeder;

class FixLegacyPricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Listing::where('price', 1)->update(['price' => 0]);
    }
}