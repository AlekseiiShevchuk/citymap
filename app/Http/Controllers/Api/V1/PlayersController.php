<?php

namespace App\Http\Controllers\Api\V1;

use App\Player;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlayersRequest;
use App\Http\Requests\UpdatePlayersRequest;
use Illuminate\Support\Facades\Auth;

class PlayersController extends Controller
{
    public function index()
    {
        return Player::all();
    }

    public function showProfile()
    {
        return Auth::user();
    }

    public function update(UpdatePlayersRequest $request)
    {
        Auth::user()->update($request->all());
        Auth::user()->save();
        return Auth::user();
    }

    /*public function update(UpdatePlayersRequest $request, $id)
    {
        $player = Player::findOrFail($id);
        $player->update($request->all());

        return $player;
    }

    public function store(StorePlayersRequest $request)
    {
        $player = Player::create($request->all());

        return $player;
    }

    public function destroy($id)
    {
        $player = Player::findOrFail($id);
        $player->delete();
        return '';
    }*/
}
