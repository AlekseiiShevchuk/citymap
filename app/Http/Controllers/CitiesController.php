<?php

namespace App\Http\Controllers;

use App\City;
use App\CityTransfer;
use App\Country;
use App\Http\Requests\StoreCitiesRequest;
use App\Http\Requests\UpdateCitiesRequest;
use App\Language;
use App\LocalizedCityDatum;
use App\Services\CityHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CitiesController extends Controller
{
    /**
     * Display a listing of City.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows('city_access')) {
            return abort(401);
        }
        $cities = City::all();

        return view('cities.index', compact('cities'));
    }

    /**
     * Show the form for creating new City.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!Gate::allows('city_create')) {
            return abort(401);
        }
        $relations = [
            'languages' => Language::where('is_active_for_admin', 1)->get(),
            'countries' => Country::all()->pluck('name', 'id'),
            'cities_to_go' => \App\City::get()->pluck('name_en', 'id'),
        ];

        $relations['address'] = CityHelper::preFillCityData($relations['languages']);

        return view('cities.create', $relations);
    }

    /**
     * Store a newly created City in storage.
     *
     * @param  \App\Http\Requests\StoreCitiesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCitiesRequest $request)
    {
        if (!Gate::allows('city_create')) {
            return abort(401);
        }
        $city = City::create($request->all());
        $city->cities_to_go()->sync(array_filter((array)$request->input('cities_to_go_all')));
        foreach ($request->get('languages') as $language_id => $inputLocalizedData) {
            LocalizedCityDatum::create([
                'name' => $inputLocalizedData['name'],
                'description' => $inputLocalizedData['description'],
                'language_id' => $language_id,
                'city_id' => $city->id,
            ]);
        }
        $city->updateReverseCitiesInfo((array)$request->input('cities_to_go_all'));
        return redirect()->route('cities.index');
    }


    /**
     * Show the form for editing City.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Gate::allows('city_edit')) {
            return abort(401);
        }
        $relations = [
            'cities_to_go' => \App\City::get()->pluck('name_en', 'id'),
            'countries' => Country::all()->pluck('name', 'id'),
        ];

        $city = City::findOrFail($id);

        return view('cities.edit', compact('city') + $relations);
    }

    /**
     * Update City in storage.
     *
     * @param  \App\Http\Requests\UpdateCitiesRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCitiesRequest $request, $id)
    {

        if (!Gate::allows('city_edit')) {
            return abort(401);
        }

        $city = City::findOrFail($id);
        $city->update($request->all());
        if ($request->exists('cities_to_go')) {
            foreach ($request->input('cities_to_go') as $city_to_go_id => $values) {
                if (!is_array($values)) {
                    continue;
                }
                $cityTransfer = CityTransfer::where([
                    'city_id' => $city->id,
                    'city_to_go_id' => $city_to_go_id
                ])->get()->first();

                if (!$cityTransfer instanceof CityTransfer) {
                    continue;
                }

                $reverseCityTransfer = CityTransfer::where([
                    'city_id' => $city_to_go_id,
                    'city_to_go_id' => $city->id
                ])->get()->first();

                if (!$reverseCityTransfer instanceof CityTransfer) {
                    continue;
                }

                $cityTransfer->price_by_car = $values['price_by_car'];
                $cityTransfer->price_by_train = $values['price_by_train'];
                $cityTransfer->price_by_plane = $values['price_by_plane'];

                if (isset($values['is_possible_to_get_by_car'])) {
                    $cityTransfer->is_possible_to_get_by_car = $values['is_possible_to_get_by_car'];
                } else {
                    $cityTransfer->is_possible_to_get_by_car = 0;
                }

                if (isset($values['is_possible_to_get_by_train'])) {
                    $cityTransfer->is_possible_to_get_by_train = $values['is_possible_to_get_by_train'];
                } else {
                    $cityTransfer->is_possible_to_get_by_train = 0;
                }

                if (isset($values['is_possible_to_get_by_plane'])) {
                    $cityTransfer->is_possible_to_get_by_plane = $values['is_possible_to_get_by_plane'];
                } else {
                    $cityTransfer->is_possible_to_get_by_plane = 0;
                }

                $cityTransfer->save();
                $reverseCityTransfer->synchronizeSettings($cityTransfer);
            }
        }
        $city->cities_to_go()->sync(array_filter((array)$request->input('cities_to_go_all')));
        $city->touch();
        $city->save();

        $city->updateReverseCitiesInfo((array)$request->input('cities_to_go_all'));

        return redirect()->route('cities.index');
    }


    /**
     * Display City.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Gate::allows('city_view')) {
            return abort(401);
        }
        $relations = [
            'cities_to_go' => \App\City::get()->pluck('name_en', 'id'),
            'localized_city_datas' => \App\LocalizedCityDatum::where('city_id', $id)->get(),
        ];

        $city = City::findOrFail($id);

        return view('cities.show', compact('city') + $relations);
    }


    /**
     * Remove City from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows('city_delete')) {
            return abort(401);
        }
        $city = City::findOrFail($id);
        $city->delete();

        return redirect()->route('cities.index');
    }

    /**
     * Delete all selected City at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (!Gate::allows('city_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = City::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
