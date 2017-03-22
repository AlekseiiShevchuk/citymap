<?php

namespace App\Observers;


use App\CityStep;
use App\Events\SocketNotificationOfNewCityStep;

class CityStepObserver
{
    public function __construct()
    {

    }


    public function created(CityStep $city_step)
    {
        event(new SocketNotificationOfNewCityStep($city_step));
    }

}