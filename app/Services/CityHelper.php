<?php

namespace App\Services;


use App\CityPopulation;

class CityHelper
{
    public static function preFillCityData($languages)
    {
        $address = [
            'lat' => 0,
            'lng' => 0,
            'name' => '',
            'population' => null,
        ];
        foreach ($languages as $language) {
            $address[$language->id]['name'] = '';
            $address[$language->id]['description'] = '';
        }
        if (request()->has('address')) {
            $cityPopulation = file_get_contents('https://api.wolframalpha.com/v2/result?i='.request()->get('address').'+population&appid=VJRA2U-KPQHVHGLP2');
            $address_google_data = json_decode(file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . request()->get('address') . '&sensor=false'));
            $address['lat'] = $address_google_data->results[0]->geometry->location->lat;
            $address['lng'] = $address_google_data->results[0]->geometry->location->lng;
            $address['name'] = request()->get('address');

            if (stristr($cityPopulation, 'million people')) {
                $address['population'] = (int)(((float)$cityPopulation)*1000000);
            }elseif(stristr($cityPopulation, 'people')){
                $address['population'] = (int)$cityPopulation;
            }

            foreach ($languages as $language) {
                $data = json_decode(
                    file_get_contents(
                        'http://' . $language->abbreviation . '.wikipedia.org/w/api.php?format=json&action=query&prop=extracts&exintro=&explaintext=&titles=' . request()->get('address')
                    ), true
                )['query']['pages'];
                $data = $data[key($data)];
                if(!empty($data['title'])){
                $address[$language->id]['name'] = $data['title'];
                }
                if(!empty($data['extract'])){
                $address[$language->id]['description'] = $data['extract'];
                }
            }
        }
        return $address;
    }
}