<?php

namespace App\Http\Controllers\Api\V1;

use App\LocalizedCityDatum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLocalizedCityDatasRequest;
use App\Http\Requests\UpdateLocalizedCityDatasRequest;

class LocalizedCityDatasController extends Controller
{
    public function index()
    {
        return LocalizedCityDatum::all();
    }

    public function show($id)
    {
        return LocalizedCityDatum::findOrFail($id);
    }

    public function update(UpdateLocalizedCityDatasRequest $request, $id)
    {
        $localized_city_datum = LocalizedCityDatum::findOrFail($id);
        $localized_city_datum->update($request->all());

        return $localized_city_datum;
    }

    public function store(StoreLocalizedCityDatasRequest $request)
    {
        $localized_city_datum = LocalizedCityDatum::create($request->all());

        return $localized_city_datum;
    }

    public function destroy($id)
    {
        $localized_city_datum = LocalizedCityDatum::findOrFail($id);
        $localized_city_datum->delete();
        return '';
    }
}
