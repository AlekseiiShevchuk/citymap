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
            $city->is_possible_to_get_by_car = false;
            $city->is_possible_to_get_by_train = false;
            $city->is_possible_to_get_by_plane = false;
            $cityToGo->is_possible_to_get_by_car = false;
            $cityToGo->is_possible_to_get_by_train = false;
            $cityToGo->is_possible_to_get_by_plane = false;
            $city->save();
            $cityToGo->save();

            return response()->json([
                'status' => true,
                'city_id' => $request->cityId,
                'city_to_go' => $request->cityToGo
            ]);
        }
    }

    /**
     * Add or remove city traffic option
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addOrRemoveCityTrafficOption(Request $request)
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
            $data = [
                'status' => true,
                'city_id' => $request->cityId,
                'city_to_go' => $request->cityToGo,
                'response_value' => $request->value ? 0 : 1,
                'typeId' => $request->type
            ];

            switch ($request->type) {
                case CityTransfer::GET_BY_CAR:
                    $city->is_possible_to_get_by_car = $request->value;
                    $cityToGo->is_possible_to_get_by_car = $request->value;
                    $data['price'] = $request->value ? $city->price_by_car : '-';
                    break;
                case CityTransfer::GET_BY_TRAIN:
                    $city->is_possible_to_get_by_train = $request->value;
                    $cityToGo->is_possible_to_get_by_train = $request->value;
                    $data['price'] = $request->value ? $city->price_by_train : '-';
                    break;
                case CityTransfer::GET_BY_PLAIN:
                    $city->is_possible_to_get_by_plane = $request->value;
                    $cityToGo->is_possible_to_get_by_plane = $request->value;
                    $data['price'] = $request->value ? $city->price_by_plane : '-';
                    break;
            }

            $city->save();
            $cityToGo->save();
            
            $data['isPossibleToGet'] = $city->is_possible_to_get;
            
            return response()->json($data);
        }
    }

    /**
     * Change price of traffic by type
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePrice(Request $request)
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
                    $city->price_by_car = $request->value;
                    $cityToGo->price_by_car = $request->value;
                    break;
                case CityTransfer::GET_BY_TRAIN:
                    $city->price_by_train = $request->value;
                    $cityToGo->price_by_train = $request->value;
                    break;
                case CityTransfer::GET_BY_PLAIN:
                    $city->price_by_plane = $request->value;
                    $cityToGo->price_by_plane = $request->value;
                    break;
            }

            $city->save();
            $cityToGo->save();

            return response()->json([
                'status' => true,
                'city_id' => $request->cityId,
                'city_to_go' => $request->cityToGo,
                'response_value' => $request->value,
                'typeId' => $request->type
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
            $data = [
                'status' => true,
                'city_id' => $request->city,
                'city_to_go' => $request->cityToAdd
            ];
            
            if (isset($request->car)) {
                $city->is_possible_to_get_by_car = $request->car;
                $cityToAdd->is_possible_to_get_by_car = $request->car;
            }
            if (isset($request->train)) {
                $city->is_possible_to_get_by_train = $request->train;
                $cityToAdd->is_possible_to_get_by_train = $request->train;
            }
            if (isset($request->plain)) {
                $city->is_possible_to_get_by_plane = $request->plain;
                $cityToAdd->is_possible_to_get_by_plane = $request->plain;
            }

            $city->save();
            $cityToAdd->save();
            
            if (isset($request->bySelectOption) && $request->bySelectOption) {
                $data['carPrice'] = $city->is_possible_to_get_by_car ? $city->price_by_car : '-';
                $data['trainPrice'] = $city->is_possible_to_get_by_train ? $city->price_by_train : '-';
                $data['planePrice'] = $city->is_possible_to_get_by_plane ? $city->price_by_plane : '-';
                $data['carPriceClass'] = $city->is_possible_to_get_by_car ? 'city-to-go-fix-price'
                    : 'city-to-go-fix-price-not-active';
                $data['trainPriceClass'] = $city->is_possible_to_get_by_train ? 'city-to-go-fix-price'
                    : 'city-to-go-fix-price-not-active';
                $data['planePriceClass'] = $city->is_possible_to_get_by_plane ? 'city-to-go-fix-price'
                    : 'city-to-go-fix-price-not-active';
                $data['isCarCheckboxChecked'] = $city->is_possible_to_get_by_car ? 'checked' : '';
                $data['isTrainCheckboxChecked'] = $city->is_possible_to_get_by_train ? 'checked' : '';
                $data['isPlaneCheckboxChecked'] = $city->is_possible_to_get_by_plane ? 'checked' : '';
                $data['carCheckboxValue'] = $city->is_possible_to_get_by_car ? 0 : 1;
                $data['trainCheckboxValue'] = $city->is_possible_to_get_by_train ? 0 : 1;
                $data['planeCheckboxValue'] = $city->is_possible_to_get_by_plane ? 0 : 1;
                $data['name'] = $request->cityToAddName;
            }

            return response()->json($data);
        }
    }
}
