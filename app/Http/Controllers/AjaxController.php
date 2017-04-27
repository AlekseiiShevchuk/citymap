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
        $model = CityTransfer::where([
            'city_id' => $request->cityId,
            'city_to_go_id' => $request->cityToGo
        ])->first();

        if ($model instanceof CityTransfer) {
            switch ($request->type) {
                case CityTransfer::GET_BY_CAR:
                    $model->is_possible_to_get_by_car = false;
                    break;
                case CityTransfer::GET_BY_TRAIN:
                    $model->is_possible_to_get_by_train = false;
                    break;
                case CityTransfer::GET_BY_PLAIN:
                    $model->is_possible_to_get_by_plane = false;
                    break;
                default:
                    $model->is_possible_to_get_by_car = false;
                    $model->is_possible_to_get_by_train = false;
                    $model->is_possible_to_get_by_plane = false;
            }
            
            $model->save();

            return response()->json([
                'status' => true,
                'city_id' => $request->cityId,
                'city_to_go' => $request->cityToGo,
                'typeId' => $request->type,
                'isPossibleToGet' => $model->is_possible_to_get
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
        $model = CityTransfer::where([
            'city_id' => $request->city,
            'city_to_go_id' => $request->cityToAdd
        ])->first();

        if ($model instanceof CityTransfer) {
            $model->is_possible_to_get_by_car = isset($request->car) ? $request->car : 0;
            $model->is_possible_to_get_by_train = isset($request->train) ? $request->train : 0;
            $model->is_possible_to_get_by_plane = isset($request->plain) ? $request->plain : 0;
            $model->save();

            return response()->json([
                'status' => true,
                'city_id' => $request->city,
                'city_to_go' => $request->cityToAdd,
            ]);
        }
    }
}
