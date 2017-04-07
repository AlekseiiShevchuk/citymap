<?php

namespace App\Observers;

use App\CityTransfer;

class CityTransferObserver
{
    public function __construct()
    {

    }

    /**
     * Listen to the CityTransfer created event.
     *
     * @param  CityTransfer $cityTransfer
     * @return void
     */
    public function created(CityTransfer $cityTransfer)
    {

    }

    public function saving(CityTransfer $cityTransfer)
    {
        if (
            $cityTransfer->is_possible_to_get_by_car == 1 ||
            $cityTransfer->is_possible_to_get_by_train == 1 ||
            $cityTransfer->is_possible_to_get_by_plane == 1
        ) {
            $cityTransfer->is_possible_to_get = 1;
        } else {
            $cityTransfer->is_possible_to_get = 0;
        }
    }

    /**
     * Listen to the CityTransfer deleting event.
     *
     * @param  CityTransfer $cityTransfer
     * @return void
     */
    public function deleting(CityTransfer $cityTransfer)
    {
    }
}