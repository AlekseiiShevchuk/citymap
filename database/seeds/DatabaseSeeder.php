<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(\App\Role::all()->first() == null){
        $this->call(RoleSeed::class);
        }
        if(\App\User::all()->first() == null){
            $this->call(UserSeed::class);
        }
        if(\App\Language::all()->first() == null){
            $this->call(LanguageSeed::class);
        }
        if(\App\City::all()->first() == null){
            $this->call(CitySeed::class);
        }
        if(\App\CityPopulation::all()->first() == null){
            $this->call(CityPopulationSeed::class);
        }
        if(\App\Country::all()->first() == null){
            $this->call(CountriesSeed::class);
        }





    }
}
