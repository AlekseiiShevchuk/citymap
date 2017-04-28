<?php

namespace App\Http\Controllers;

use App\CityTransfer;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /**
     * Delete related city
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteCityToGo(Request $request)
    {
        $city = CityTransfer::where([
            'city_id' => $request->cityId,
            'city_to_go_id' => $request->cityToGo
        ])->first();

        $cityToGo = CityTransfer::where([
            'city_id' => $request->cityToGo,
            'city_to_go_id' => $request->cityId
        ])->first();

        if ($city instanceof CityTransfer && $cityToGo instanceof CityTransfer) {
            switch ($request->type) {
                case CityTransfer::GET_BY_CAR:
                    $city->is_possible_to_get_by_car = false;
                    $cityToGo->is_possible_to_get_by_car = false;
                    break;
                case CityTransfer::GET_BY_TRAIN:
                    $city->is_possible_to_get_by_train = false;
                    $cityToGo->is_possible_to_get_by_train = false;
                    break;
                case CityTransfer::GET_BY_PLAIN:
                    $city->is_possible_to_get_by_plane = false;
                    $cityToGo->is_possible_to_get_by_plane = false;
                    break;
                default:
                    $city->is_possible_to_get_by_car = false;
                    $city->is_possible_to_get_by_train = false;
                    $city->is_possible_to_get_by_plane = false;
                    $cityToGo->is_possible_to_get_by_car = false;
                    $cityToGo->is_possible_to_get_by_train = false;
                    $cityToGo->is_possible_to_get_by_plane = false;
            }

            $city->save();
            $cityToGo->save();

            return response()->json([
                'status' => true,
                'city_id' => $request->cityId,
                'city_to_go' => $request->cityToGo,
                'typeId' => $request->type,
                'isPossibleToGet' => $city->is_possible_to_get
            ]);
        }
    }

    /**
     * Add city to relation
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addCityToGo(Request $request)
    {
        $city = CityTransfer::where([
            'city_id' => $request->city,
            'city_to_go_id' => $request->cityToAdd
        ])->first();

        $cityToAdd = CityTransfer::where([
            'city_id' => $request->cityToAdd,
            'city_to_go_id' => $request->city
        ])->first();

        if ($city instanceof CityTransfer && $cityToAdd instanceof CityTransfer) {
            $city->is_possible_to_get_by_car = isset($request->car) ? $request->car : 0;
            $city->is_possible_to_get_by_train = isset($request->train) ? $request->train : 0;
            $city->is_possible_to_get_by_plane = isset($request->plain) ? $request->plain : 0;
            $cityToAdd->is_possible_to_get_by_car = isset($request->car) ? $request->car : 0;
            $cityToAdd->is_possible_to_get_by_train = isset($request->train) ? $request->train : 0;
            $cityToAdd->is_possible_to_get_by_plane = isset($request->plain) ? $request->plain : 0;
            $city->save();
            $cityToAdd->save();

            return response()->json([
                'status' => true,
                'city_id' => $request->city,
                'city_to_go' => $request->cityToAdd
            ]);
        }
    }
}
