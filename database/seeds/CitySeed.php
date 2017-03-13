<?php

use Illuminate\Database\Seeder;

class CitySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [

            [
                'name_en' => 'Stockholm',
                'population' => 1252020,
                'year_of_foundation' => 1250,
                'latitude' => 59.3229,
                'longitude' => 18.1048,
            ],
            [
                'name_en' => 'Gothenburg',
                'population' => 510491,
                'year_of_foundation' => 1619,
                'latitude' => 57.7063,
                'longitude' => 12.0218,
            ],
            [
                'name_en' => 'Malmö',
                'population' => 258020,
                'year_of_foundation' => 1250,
                'latitude' => 55.5888,
                'longitude' => 13.0548,
            ],
            [
                'name_en' => 'Uppsala',
                'population' => 128409,
                'year_of_foundation' => 1286,
                'latitude' => 59.8571,
                'longitude' => 17.688,
            ],
            [
                'name_en' => 'Västerås',
                'population' => 107005,
                'year_of_foundation' => 990,
                'latitude' => 59.607,
                'longitude' => 16.6048,
            ],
            [
                'name_en' => 'Örebro',
                'population' => 98237,
                'year_of_foundation' => 1200,
                'latitude' => 59.2729,
                'longitude' => 15.272,
            ],
            [
                'name_en' => 'Linköping',
                'population' => 97428,
                'year_of_foundation' => 1287,
                'latitude' => 58.4066,
                'longitude' => 15.672,
            ],
            [
                'name_en' => 'Helsingborg',
                'population' => 91457,
                'year_of_foundation' => 1085,
                'latitude' => 56.0389,
                'longitude' => 12.7548,
            ],
            [
                'name_en' => 'Jönköping',
                'population' => 84423,
                'year_of_foundation' => 1284,
                'latitude' => 57.7723,
                'longitude' => 14.2379,
            ],
            [
                'name_en' => 'Norrköping',
                'population' => 83561,
                'year_of_foundation' => 1384,
                'latitude' => 58.5896,
                'longitude' => 16.2378,
            ],

        ];

        foreach ($items as $item) {
            \App\City::create($item);
        }
    }
}
