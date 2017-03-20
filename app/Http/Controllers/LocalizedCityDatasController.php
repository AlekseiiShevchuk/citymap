<?php

namespace App\Http\Controllers;

use App\LocalizedCityDatum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreLocalizedCityDatasRequest;
use App\Http\Requests\UpdateLocalizedCityDatasRequest;

class LocalizedCityDatasController extends Controller
{
    /**
     * Display a listing of LocalizedCityDatum.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('localized_city_datum_access')) {
            return abort(401);
        }
        $localized_city_datas = LocalizedCityDatum::all();

        return view('localized_city_datas.index', compact('localized_city_datas'));
    }

    /**
     * Show the form for creating new LocalizedCityDatum.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('localized_city_datum_create')) {
            return abort(401);
        }
        $relations = [
            'cities' => \App\City::get()->pluck('name_en', 'id')->prepend('Please select', ''),
            'languages' => \App\Language::where('is_active_for_admin',1)->get()->pluck('name', 'id')->prepend('Please select', ''),
        ];

        return view('localized_city_datas.create', $relations);
    }

    /**
     * Store a newly created LocalizedCityDatum in storage.
     *
     * @param  \App\Http\Requests\StoreLocalizedCityDatasRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocalizedCityDatasRequest $request)
    {
        if (! Gate::allows('localized_city_datum_create')) {
            return abort(401);
        }
        $localized_city_datum = LocalizedCityDatum::create($request->all());

        return redirect()->route('localized_city_datas.index');
    }


    /**
     * Show the form for editing LocalizedCityDatum.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('localized_city_datum_edit')) {
            return abort(401);
        }
        $relations = [
            'cities' => \App\City::get()->pluck('name_en', 'id')->prepend('Please select', ''),
            'languages' => \App\Language::where('is_active_for_admin',1)->get()->pluck('name', 'id')->prepend('Please select', ''),
        ];

        $localized_city_data = LocalizedCityDatum::findOrFail($id);

        return view('localized_city_datas.edit', compact('localized_city_data') + $relations);
    }

    /**
     * Update LocalizedCityDatum in storage.
     *
     * @param  \App\Http\Requests\UpdateLocalizedCityDatasRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocalizedCityDatasRequest $request, $id)
    {
        if (! Gate::allows('localized_city_datum_edit')) {
            return abort(401);
        }
        $localized_city_datum = LocalizedCityDatum::findOrFail($id);
        $localized_city_datum->update($request->all());

        return redirect()->route('localized_city_datas.index');
    }


    /**
     * Display LocalizedCityDatum.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('localized_city_datum_view')) {
            return abort(401);
        }
        $relations = [
            'cities' => \App\City::get()->pluck('name_en', 'id')->prepend('Please select', ''),
            'languages' => \App\Language::where('is_active_for_admin',1)->get()->pluck('name', 'id')->prepend('Please select', ''),
        ];

        $localized_city_data = LocalizedCityDatum::findOrFail($id);

        return view('localized_city_datas.show', compact('localized_city_data') + $relations);
    }


    /**
     * Remove LocalizedCityDatum from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('localized_city_datum_delete')) {
            return abort(401);
        }
        $localized_city_datum = LocalizedCityDatum::findOrFail($id);
        $localized_city_datum->delete();

        return redirect()->route('localized_city_datas.index');
    }

    /**
     * Delete all selected LocalizedCityDatum at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('localized_city_datum_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = LocalizedCityDatum::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
