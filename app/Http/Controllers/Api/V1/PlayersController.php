<?php

namespace App\Http\Controllers\Api\V1;

use App\Player;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlayersRequest;
use App\Http\Requests\UpdatePlayersRequest;

class PlayersController extends Controller
{
    public function index()
    {
        return Player::all();
    }

    public function show($id)
    {
        return Player::findOrFail($id);
    }

    public function update(UpdatePlayersRequest $request, $id)
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
    }
}
