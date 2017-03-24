<?php

namespace App\Http\Controllers\Api\V1;

use App\City;
use App\CityStep;
use App\Events\SocketNotification;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\UpdatePlayersRequest;
use App\Player;
use App\Services\OnlinePlayersService;
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
        event(new SocketNotification(SocketNotification::PLAYER_CHANGE_AVATAR, Auth::user()));
        return Auth::user();
    }

    public function stepToCity(City $city)
    {
        $city_step = CityStep::create([
            'by_player_id' => Auth::id(),
            'to_city_id' => $city->id
        ]);
        return Auth::user()->load('city_steps');
    }

    public function getOnlinePlayers()
    {
        return Cache::many(Redis::keys(OnlinePlayersService::CACHE_PREFIX . '*'));
    }

    public function login()
    {
        event(new SocketNotification(SocketNotification::PLAYER_LOGIN, Auth::user()));
        return response()->json('success login');
    }

    public function logout()
    {
        event(new SocketNotification(SocketNotification::PLAYER_LOGOUT, Auth::user()));
        Cache::forget(OnlinePlayersService::CACHE_PREFIX . Auth::id());
        return response()->json('success logout');
    }
}

