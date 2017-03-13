<?php

namespace App\Observers;

use App\City;

class CityObserver
{
    public function __construct()
    {

    }

    /**
     * Listen to the City created event.
     *
     * @param  City $city
     * @return void
     */
    public function created(City $city)
    {
        $cities = City::all();
        foreach ($cities as $city){
            $city->cities_to_go()->sync($cities);
            $city->cities_to_go()->detach($city);
        }
    }

    public function creating(City $city)
    {
    }

    /**
     * Listen to the City deleting event.
     *
     * @param  City $city
     * @return void
     */
    public function deleting(City $city)
    {
    }
}