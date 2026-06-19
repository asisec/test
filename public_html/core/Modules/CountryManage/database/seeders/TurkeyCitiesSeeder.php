<?php

namespace Modules\CountryManage\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Modules\CountryManage\app\Models\City;
use Modules\CountryManage\app\Models\Country;

class TurkeyCitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        City::truncate();
        Schema::enableForeignKeyConstraints();

        $country = Country::where('country_code', 'TR')
            ->orWhere('country', 'Turkey')
            ->orWhere('country', 'Türkiye')
            ->first();

        if (! $country) {
            $country = Country::create([
                'country' => 'Turkey',
                'country_code' => 'TR',
                'status' => 1,
            ]);
        }

        $provinces = [
            'Adana',
            'Adıyaman',
            'Afyonkarahisar',
            'Ağrı',
            'Amasya',
            'Ankara',
            'Antalya',
            'Artvin',
            'Aydın',
            'Balıkesir',
            'Bilecik',
            'Bingöl',
            'Bitlis',
            'Bolu',
            'Burdur',
            'Bursa',
            'Çanakkale',
            'Çankırı',
            'Çorum',
            'Denizli',
            'Diyarbakır',
            'Edirne',
            'Elazığ',
            'Erzincan',
            'Erzurum',
            'Eskişehir',
            'Gaziantep',
            'Giresun',
            'Gümüşhane',
            'Hakkari',
            'Hatay',
            'Isparta',
            'Mersin',
            'İstanbul',
            'İzmir',
            'Kars',
            'Kastamonu',
            'Kayseri',
            'Kırklareli',
            'Kırşehir',
            'Kocaeli',
            'Konya',
            'Kütahya',
            'Malatya',
            'Manisa',
            'Kahramanmaraş',
            'Mardin',
            'Muğla',
            'Muş',
            'Nevşehir',
            'Niğde',
            'Ordu',
            'Rize',
            'Sakarya',
            'Samsun',
            'Siirt',
            'Sinop',
            'Sivas',
            'Tekirdağ',
            'Tokat',
            'Trabzon',
            'Tunceli',
            'Şanlıurfa',
            'Uşak',
            'Van',
            'Yozgat',
            'Zonguldak',
            'Aksaray',
            'Bayburt',
            'Karaman',
            'Kırıkkale',
            'Batman',
            'Şırnak',
            'Bartın',
            'Ardahan',
            'Iğdır',
            'Yalova',
            'Karabük',
            'Kilis',
            'Osmaniye',
            'Düzce',
        ];

        foreach ($provinces as $province) {
            City::create([
                'city' => $province,
                'country_id' => $country->id,
                'state_id' => 0,
                'status' => 1,
            ]);
        }
    }
}
