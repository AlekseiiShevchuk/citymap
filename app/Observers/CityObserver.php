<?php

namespace App\Observers;

use App\City;
use App\Services\GoogleMapsAPI;

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
        foreach ($cities as $city) {
            $city->cities_to_go()->sync($cities);
            $city->cities_to_go()->detach($city);

            foreach ($city->cities_to_go as $city_to_go) {
                if ($city_to_go->pivot->points == null) {
                    $city_to_go->pivot->points = GoogleMapsAPI::getPointsBetweenTwoCities($city, $city_to_go);
                    $city_to_go->pivot->save();
                }
            }
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