<?php

namespace App\Http\Controllers;

use App\City;
use App\Language;
use App\LocalizedCityDatum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreCitiesRequest;
use App\Http\Requests\UpdateCitiesRequest;

class CitiesController extends Controller
{
    /**
     * Display a listing of City.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('city_access')) {
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
    public function create()
    {
        if (! Gate::allows('city_create')) {
            return abort(401);
        }
        $relations = [
            'languages' => Language::where('is_active_for_admin',1)->get(),
        ];

        return view('cities.create', $relations);
    }

    /**
     * Store a newly created City in storage.
     *
     * @param  \App\Http\Requests\StoreCitiesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCitiesRequest $request)
    {
        if (! Gate::allows('city_create')) {
            return abort(401);
        }
        $city = City::create($request->all());

        foreach ($request->get('languages') as $language_id => $inputLocalizedData){
            LocalizedCityDatum::create([
                'name' => $inputLocalizedData['name'],
                'description' => $inputLocalizedData['description'],
                'language_id' => $language_id,
                'city_id' => $city->id,
            ]);
        }

        return redirect()->route('cities.index');
    }


    /**
     * Show the form for editing City.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('city_edit')) {
            return abort(401);
        }
        $relations = [
            'cities_to_go' => \App\City::get()->pluck('name_en', 'id'),
        ];

        $city = City::findOrFail($id);

        return view('cities.edit', compact('city') + $relations);
    }

    /**
     * Update City in storage.
     *
     * @param  \App\Http\Requests\UpdateCitiesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCitiesRequest $request, $id)
    {

        if (! Gate::allows('city_edit')) {
            return abort(401);
        }

        $city = City::findOrFail($id);
        $city->update($request->all());

        foreach ($request->input('cities_to_go') as $city_to_go_id => $values){
            $city_to_go = $city->cities_to_go->find($city_to_go_id);
            $city_to_go->pivot->weight = $values['weight'];
            if(isset($values['is_possible_to_get'])){
                $city_to_go->pivot->is_possible_to_get = $values['is_possible_to_get'];
            }
            $city_to_go->pivot->save();
        }

        return redirect()->route('cities.index');
    }


    /**
     * Display City.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('city_view')) {
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('city_delete')) {
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
        if (! Gate::allows('city_delete')) {
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
