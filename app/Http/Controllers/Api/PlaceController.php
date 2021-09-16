<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\place;

class PlaceController extends Controller
{
    public function status() {
        return ['status' => 'ok'];
    }

    public function add(Request $request) {

        try {
            $place = new Place();

            $place->name = $request->name;
            $place->lat = $request->lat;
            $place->lng = $request->lng;

            $place->save();

            return ['retorno'=>'ok'];

        } catch(\Exception $erro) {

            return ['retorno'=>'erro', 'details'=>$erro];
        }
    }

    public function list() {

        $place = Place::all('id', 'name');

        return $place;
    }

    public function select($id) {

        $place = Place::find($id);

        return $place;
    }

    public function update(Request $request, $id) {

        try {

            $place = Place::find($id);

            $place->name = $request->name;
            $place->lat = $request->lat;
            $place->lng = $request->lng;

            $place->save();

            return ['retorno'=>'ok', 'data'=>$request->all()];

        } catch(\Exception $erro) {

            return ['retorno'=>'erro', 'details'=>$erro];
        }
    }

    public function delete($id) {

        try {

            $place = Place::find($id);

            $place->delete();

            return ['retorno'=>'ok'];

        } catch(\Exception $erro) {

            return ['retorno'=>'erro', 'details'=>$erro];
        }
    }
}
