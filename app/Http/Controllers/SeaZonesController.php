<?php

namespace App\Http\Controllers;

use App\City;
use App\CityTransfer;
use App\SeaZone;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreSeaZonesRequest;
use App\Http\Requests\UpdateSeaZonesRequest;

class SeaZonesController extends Controller
{
    /**
     * Display a listing of SeaZone.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('sea_zone_access')) {
            return abort(401);
        }
        $sea_zones = SeaZone::all();

        return view('sea_zones.index', compact('sea_zones'));
    }

    /**
     * Show the form for creating new SeaZone.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('sea_zone_create')) {
            return abort(401);
        }
        $city_transfers = new Collection();
        foreach (CityTransfer::all() as $city_transfer){
            $city_transfers->put($city_transfer->id, 'from ' . City::find($city_transfer->city_id)->name_en . ' to ' . City::find($city_transfer->city_to_go_id)->name_en );
        }
        $relations = [
            'city_transfers' => $city_transfers->prepend('Please select', ''),
        ];
        return view('sea_zones.create', $relations);
    }

    /**
     * Store a newly created SeaZone in storage.
     *
     * @param  \App\Http\Requests\StoreSeaZonesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSeaZonesRequest $request)
    {
        if (! Gate::allows('sea_zone_create')) {
            return abort(401);
        }
        $sea_zone = SeaZone::create($request->all());

        return redirect()->route('sea_zones.index');
    }


    /**
     * Show the form for editing SeaZone.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('sea_zone_edit')) {
            return abort(401);
        }
        $relations = [
            'city_transfers' => \App\CityTransfer::get()->pluck('points', 'id')->prepend('Please select', ''),
        ];

        $sea_zone = SeaZone::findOrFail($id);

        return view('sea_zones.edit', compact('sea_zone') + $relations);
    }

    /**
     * Update SeaZone in storage.
     *
     * @param  \App\Http\Requests\UpdateSeaZonesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeaZonesRequest $request, $id)
    {
        if (! Gate::allows('sea_zone_edit')) {
            return abort(401);
        }
        $sea_zone = SeaZone::findOrFail($id);
        $sea_zone->update($request->all());

        return redirect()->route('sea_zones.index');
    }


    /**
     * Display SeaZone.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('sea_zone_view')) {
            return abort(401);
        }
        $relations = [
            'city_transfers' => \App\CityTransfer::get()->pluck('points', 'id')->prepend('Please select', ''),
        ];

        $sea_zone = SeaZone::findOrFail($id);

        return view('sea_zones.show', compact('sea_zone') + $relations);
    }


    /**
     * Remove SeaZone from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('sea_zone_delete')) {
            return abort(401);
        }
        $sea_zone = SeaZone::findOrFail($id);
        $sea_zone->delete();

        return redirect()->route('sea_zones.index');
    }

    /**
     * Delete all selected SeaZone at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('sea_zone_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = SeaZone::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
