<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('languages', 'LanguagesController');

        Route::resource('cities', 'CitiesController');

        Route::resource('localized_city_datas', 'LocalizedCityDatasController');

});
