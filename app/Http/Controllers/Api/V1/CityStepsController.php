<?php

namespace App\Http\Controllers\Api\V1;

use App\CityStep;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCityStepsRequest;
use App\Http\Requests\UpdateCityStepsRequest;

class CityStepsController extends Controller
{
    public function index()
    {
        return CityStep::all();
    }

    public function show($id)
    {
        return CityStep::findOrFail($id);
    }

    public function update(UpdateCityStepsRequest $request, $id)
    {
        $city_step = CityStep::findOrFail($id);
        $city_step->update($request->all());

        return $city_step;
    }

    public function store(StoreCityStepsRequest $request)
    {
        $city_step = CityStep::create($request->all());

        return $city_step;
    }

    public function destroy($id)
    {
        $city_step = CityStep::findOrFail($id);
        $city_step->delete();
        return '';
    }
}
