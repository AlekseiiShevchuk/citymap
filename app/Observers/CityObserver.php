<?php

namespace App\Observers;

use App\City;
use App\CityTransfer;
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
    public function saved(City $city)
    {
        $cityTransfers = CityTransfer::all();

        foreach ($cityTransfers as $cityTransfer) {
            if ($cityTransfer->points == null) {
                $cityTransfer->points = GoogleMapsAPI::getPointsBetweenTwoCities(City::find($cityTransfer->city_id),
                    City::find($cityTransfer->city_to_go_id));
                $cityTransfer->save();
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