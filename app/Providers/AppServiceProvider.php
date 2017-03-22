<?php

namespace App\Providers;

use App\City;
use App\CityStep;
use App\Observers\CityObserver;
use App\Observers\CityStepObserver;
use App\Observers\PlayerObserver;
use App\Player;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        City::observe(CityObserver::class);
        Player::observe(PlayerObserver::class);
        CityStep::observe(CityStepObserver::class);
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
