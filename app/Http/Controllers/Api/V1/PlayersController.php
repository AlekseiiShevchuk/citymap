<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Http\Requests\UpdatePlayersRequest;
use App\Player;
use Illuminate\Support\Facades\Auth;

class PlayersController extends Controller
{
    use FileUploadTrait;

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

    public function uploadAvatar(UpdatePlayersRequest $request)
    {
        $request = $this->saveFiles($request);
        Auth::user()->update($request->only(['avatar']));
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
