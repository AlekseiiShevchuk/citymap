<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('languages', 'LanguagesController');

        Route::resource('cities', 'CitiesController');
    
        Route::get('map/cities', 'CitiesController@indexForVisualAdmin')->name('map');

        Route::resource('localized_city_datas', 'LocalizedCityDatasController');

        Route::resource('players', 'PlayersController');
            Route::get('profile', 'PlayersController@showProfile');
            Route::put('profile', 'PlayersController@update');
            Route::post('profile', 'PlayersController@uploadAvatar');
            Route::get('step-to-city/{city}', 'PlayersController@stepToCity');
            Route::get('get-online-players', 'PlayersController@getOnlinePlayers');
            Route::get('login', 'PlayersController@login');
            Route::get('logout', 'PlayersController@logout');

        Route::resource('city_steps', 'CityStepsController');

        Route::resource('sea_zones', 'SeaZonesController');

});
