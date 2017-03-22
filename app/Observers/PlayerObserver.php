<?php

namespace App\Observers;


use App\City;
use App\CityStep;
use App\Player;

class PlayerObserver
{

    public function __construct()
    {

    }

    /**
     * Listen to the Player created event.
     *
     * @param  Player $player
     * @return void
     */
    public function created(Player $player)
    {
        CityStep::create([
            'by_player_id' => $player->id,
            'to_city_id' => City::all()->random(1)->first()->id
        ]);
    }

    public function creating(Player $player)
    {
    }

    /**
     * Listen to the Player deleting event.
     *
     * @param  Player $player
     * @return void
     */
    public function deleting(Player $player)
    {
    }

}