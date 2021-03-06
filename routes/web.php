<?php
// TMP Routs START

//page for socket testing
use App\City;
use App\Services\GoogleMapsAPI;

Route::get('/redis', function () {

    event(new \App\Events\SocketSendTestMessage('Just a test message'));

    return view('auth.socket');

});
//set random weight for each city to go
Route::get('/set-random-price', function () {

    $cities = \App\City::all();

    foreach ($cities as $city) {
        foreach ($city->cities_to_go as $cityToGo) {
            $cityToGo->pivot->price_by_car = rand(10, 200);
            $cityToGo->pivot->price_by_train = rand(10, 200);
            $cityToGo->pivot->price_by_plane = rand(10, 200);
            $cityToGo->pivot->save();
        }
    }

    $cityTransfers = \App\CityTransfer::all();

    foreach ($cityTransfers as $cityTransfer)
    {
        $cityTransfer->is_possible_to_get_by_car = 0;
        $cityTransfer->is_possible_to_get_by_train = 0;
        $cityTransfer->is_possible_to_get_by_plane = 0;
        $cityTransfer->save();
    }

});

Route::get('google-api-test', function () {
    $cities = City::all();
    foreach ($cities as $city) {
        $city->cities_to_go()->sync($cities);
        $city->cities_to_go()->detach($city);

        foreach ($city->cities_to_go as $city_to_go) {
            if ($city_to_go->pivot->points == null) {
                $city_to_go->pivot->points = GoogleMapsAPI::getPointsBetweenTwoCities($city, $city_to_go);
                $city_to_go->pivot->save();
            }
        }
    }
});

// TMP Routs END

Route::get('/', function () {
    return redirect('/home');
});

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index');

    Route::post('/ajax/delete-city-to-go', 'AjaxController@deleteCityToGo');

    Route::post('/ajax/add-or-remove-traffic-option', 'AjaxController@addOrRemoveCityTrafficOption');

    Route::post('/ajax/change-price', 'AjaxController@changePrice');

    Route::post('/ajax/add-city-to-go', 'AjaxController@addCityToGo');

    Route::resource('roles', 'RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'RolesController@massDestroy', 'as' => 'roles.mass_destroy']);

    Route::resource('users', 'UsersController');
    Route::post('users_mass_destroy', ['uses' => 'UsersController@massDestroy', 'as' => 'users.mass_destroy']);

    Route::resource('languages', 'LanguagesController');
    Route::post('languages_mass_destroy',
        ['uses' => 'LanguagesController@massDestroy', 'as' => 'languages.mass_destroy']);

    Route::resource('cities', 'CitiesController');
    Route::post('cities_mass_destroy', ['uses' => 'CitiesController@massDestroy', 'as' => 'cities.mass_destroy']);

    Route::resource('localized_city_datas', 'LocalizedCityDatasController');
    Route::post('localized_city_datas_mass_destroy',
        ['uses' => 'LocalizedCityDatasController@massDestroy', 'as' => 'localized_city_datas.mass_destroy']);

    Route::resource('players', 'PlayersController');
    Route::post('players_mass_destroy', ['uses' => 'PlayersController@massDestroy', 'as' => 'players.mass_destroy']);

    Route::resource('city_steps', 'CityStepsController');
    Route::post('city_steps_mass_destroy',
        ['uses' => 'CityStepsController@massDestroy', 'as' => 'city_steps.mass_destroy']);

    Route::resource('sea_zones', 'SeaZonesController');
    Route::post('sea_zones_mass_destroy', ['uses' => 'SeaZonesController@massDestroy', 'as' => 'sea_zones.mass_destroy']);
});
