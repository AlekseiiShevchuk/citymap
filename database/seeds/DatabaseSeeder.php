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
        
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);
        $this->call(LanguageSeed::class);
        $this->call(CitySeed::class);
        $this->call(CityPopulationSeed::class);

    }
}
