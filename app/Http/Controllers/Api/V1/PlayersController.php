<?php

namespace App\Http\Controllers\Api\V1;

use App\City;
use App\CityStep;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\UpdatePlayersRequest;
use App\Player;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class PlayersController extends Controller
{
    use FileUploadTrait;

    public function index()
    {
        return Player::all();
    }

    public function showProfile()
    {
        return Auth::user()->load('city_steps');
    }

    public function update(UpdatePlayersRequest $request)
    {
        Auth::user()->update($request->all());
        Auth::user()->save();
        return Auth::user();
    }

    public function uploadAvatar(UpdatePlayersRequest $request)
    {
        $request = $this->saveFiles($request);
        Auth::user()->update($request->only(['avatar']));
        Auth::user()->save();
        return Auth::user();
    }

    public function stepToCity(City $city)
    {
        $city_step = CityStep::create([
            'by_player_id' => Auth::user()->id,
            'to_city_id' => $city->id
        ]);
        return Auth::user()->load('city_steps');
    }

    public function getOnlinePlayers()
    {
        return Cache::many(Redis::keys('citymap.players:*'));
    }
}
