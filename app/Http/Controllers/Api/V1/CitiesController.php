<?php

namespace App\Http\Controllers\Api\V1;

use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCitiesRequest;
use App\Http\Requests\UpdateCitiesRequest;

class CitiesController extends Controller
{
    public function index()
    {
        return City::all()->load(['possible_cities_to_go']);
    }

    public function show($id)
    {
        return City::findOrFail($id)->load(['localized_data']);
    }

   /* public function update(UpdateCitiesRequest $request, $id)
    {
        $city = City::findOrFail($id);
        $city->update($request->all());

        return $city;
    }

    public function store(StoreCitiesRequest $request)
    {
        $city = City::create($request->all());

        return $city;
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return '';
    }*/
}
