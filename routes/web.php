<?php
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

    Route::resource('roles', 'RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'RolesController@massDestroy', 'as' => 'roles.mass_destroy']);

    Route::resource('users', 'UsersController');
    Route::post('users_mass_destroy', ['uses' => 'UsersController@massDestroy', 'as' => 'users.mass_destroy']);

    Route::resource('languages', 'LanguagesController');
    Route::post('languages_mass_destroy', ['uses' => 'LanguagesController@massDestroy', 'as' => 'languages.mass_destroy']);

    Route::resource('cities', 'CitiesController');
    Route::post('cities_mass_destroy', ['uses' => 'CitiesController@massDestroy', 'as' => 'cities.mass_destroy']);

    Route::resource('localized_city_datas', 'LocalizedCityDatasController');
    Route::post('localized_city_datas_mass_destroy', ['uses' => 'LocalizedCityDatasController@massDestroy', 'as' => 'localized_city_datas.mass_destroy']);

    Route::resource('players', 'PlayersController');
    Route::post('players_mass_destroy', ['uses' => 'PlayersController@massDestroy', 'as' => 'players.mass_destroy']);
});
