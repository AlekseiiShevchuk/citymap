<?php

namespace App\Http\Controllers\Api\V1;

use App\SeaZone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSeaZonesRequest;
use App\Http\Requests\UpdateSeaZonesRequest;

class SeaZonesController extends Controller
{
    public function index()
    {
        return SeaZone::all();
    }

    public function show($id)
    {
        return SeaZone::findOrFail($id);
    }

    public function update(UpdateSeaZonesRequest $request, $id)
    {
        $sea_zone = SeaZone::findOrFail($id);
        $sea_zone->update($request->all());

        return $sea_zone;
    }

    public function store(StoreSeaZonesRequest $request)
    {
        $sea_zone = SeaZone::create($request->all());

        return $sea_zone;
    }

    public function destroy($id)
    {
        $sea_zone = SeaZone::findOrFail($id);
        $sea_zone->delete();
        return '';
    }
}
