<?php

namespace App\Observers;


use App\CityStep;
use App\Events\SocketNotification;
use App\Player;

class CityStepObserver
{
    public function __construct()
    {

    }


    public function created(CityStep $city_step)
    {
        $player = Player::find($city_step->by_player_id);
        //если это первый (базовый/начальный) город игрока то нотификацию о переходе не выбрасываем тк этот city_step генерится для него автоматически
        if ($player->city_steps->count() > 1) {
            event(new SocketNotification(SocketNotification::NEW_CITY_STEP, $city_step));
        }
    }

}