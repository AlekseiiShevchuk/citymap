<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StorePlayersRequest;
use App\Http\Requests\UpdatePlayersRequest;

class PlayersController extends Controller
{
    /**
     * Display a listing of Player.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('player_access')) {
            return abort(401);
        }
        $players = Player::all();

        return view('players.index', compact('players'));
    }

    /**
     * Show the form for creating new Player.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('player_create')) {
            return abort(401);
        }
        $relations = [
            'languages' => \App\Language::where('is_active_for_admin',1)->get()->pluck('name', 'id')->prepend('Please select', ''),
        ];

        return view('players.create', $relations);
    }

    /**
     * Store a newly created Player in storage.
     *
     * @param  \App\Http\Requests\StorePlayersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePlayersRequest $request)
    {
        if (! Gate::allows('player_create')) {
            return abort(401);
        }
        $player = Player::create($request->all());

        return redirect()->route('players.index');
    }


    /**
     * Show the form for editing Player.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('player_edit')) {
            return abort(401);
        }
        $relations = [
            'languages' => \App\Language::where('is_active_for_admin',1)->get()->pluck('name', 'id')->prepend('Please select', ''),
        ];

        $player = Player::findOrFail($id);

        return view('players.edit', compact('player') + $relations);
    }

    /**
     * Update Player in storage.
     *
     * @param  \App\Http\Requests\UpdatePlayersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePlayersRequest $request, $id)
    {
        if (! Gate::allows('player_edit')) {
            return abort(401);
        }
        $player = Player::findOrFail($id);
        $player->update($request->all());

        return redirect()->route('players.index');
    }


    /**
     * Display Player.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('player_view')) {
            return abort(401);
        }
        $relations = [
            'languages' => \App\Language::get()->pluck('name', 'id')->prepend('Please select', ''),
        ];

        $player = Player::findOrFail($id);

        return view('players.show', compact('player') + $relations);
    }


    /**
     * Remove Player from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('player_delete')) {
            return abort(401);
        }
        $player = Player::findOrFail($id);
        $player->delete();

        return redirect()->route('players.index');
    }

    /**
     * Delete all selected Player at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('player_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Player::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
