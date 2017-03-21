<?php

namespace App\Http\Controllers;

use App\CityStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreCityStepsRequest;
use App\Http\Requests\UpdateCityStepsRequest;

class CityStepsController extends Controller
{
    /**
     * Display a listing of CityStep.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('city_step_access')) {
            return abort(401);
        }
        $city_steps = CityStep::all();

        return view('city_steps.index', compact('city_steps'));
    }

    /**
     * Show the form for creating new CityStep.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('city_step_create')) {
            return abort(401);
        }
        $relations = [
            'by_players' => \App\Player::get()->pluck('device_id', 'id')->prepend('Please select', ''),
            'to_cities' => \App\City::get()->pluck('name_en', 'id')->prepend('Please select', ''),
        ];

        return view('city_steps.create', $relations);
    }

    /**
     * Store a newly created CityStep in storage.
     *
     * @param  \App\Http\Requests\StoreCityStepsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCityStepsRequest $request)
    {
        if (! Gate::allows('city_step_create')) {
            return abort(401);
        }
        $city_step = CityStep::create($request->all());

        return redirect()->route('city_steps.index');
    }


    /**
     * Show the form for editing CityStep.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('city_step_edit')) {
            return abort(401);
        }
        $relations = [
            'by_players' => \App\Player::get()->pluck('device_id', 'id')->prepend('Please select', ''),
            'to_cities' => \App\City::get()->pluck('name_en', 'id')->prepend('Please select', ''),
        ];

        $city_step = CityStep::findOrFail($id);

        return view('city_steps.edit', compact('city_step') + $relations);
    }

    /**
     * Update CityStep in storage.
     *
     * @param  \App\Http\Requests\UpdateCityStepsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityStepsRequest $request, $id)
    {
        if (! Gate::allows('city_step_edit')) {
            return abort(401);
        }
        $city_step = CityStep::findOrFail($id);
        $city_step->update($request->all());

        return redirect()->route('city_steps.index');
    }


    /**
     * Remove CityStep from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('city_step_delete')) {
            return abort(401);
        }
        $city_step = CityStep::findOrFail($id);
        $city_step->delete();

        return redirect()->route('city_steps.index');
    }

    /**
     * Delete all selected CityStep at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('city_step_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = CityStep::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
