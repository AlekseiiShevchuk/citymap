<?php

namespace App\Services;


use App\Contracts\HasCoordinates;

class GoogleMapsAPI
{
    public static function getPointsBetweenTwoCities(HasCoordinates $city, HasCoordinates $city_to_go)
    {
        $endpoint = 'https://maps.googleapis.com/maps/api/directions/json?&key=' .
            env('GOOGLE_MAPS_API_KEY') .
            '&origin=' .
            $city->getCoordinates() .
            '&destination=' .
            $city_to_go->getCoordinates();
        //dd($endpoint);
        $data = json_decode(file_get_contents($endpoint), true);

        if (!empty($data['routes'][0]['overview_polyline']['points'])) {
            return $data['routes'][0]['overview_polyline']['points'];
        }
        return null;

    }
}