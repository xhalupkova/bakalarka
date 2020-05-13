<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Auth;
use App\Quotation;

use Illuminate\Http\Request;


class RoomInfoController extends Controller
{


    public function index()
    {
        //$locale = App::getLocale();
       return view('room_info');
    }

    public function floorInfo(){

        //dd($floors);
        return $floors = DB::select(DB::raw('select * from floors'));
    }

    public function cubeInfo1(Request $request)
    {
        //return $infos = DB::table('room_data')->select('room', 'people', 'room_type')->where('cube_id', 'Cube6')->get();
        return $infos = DB::select(DB::raw('select * from room_data1 where cube_id = "'.$request->cubeId.'"'));

    }

    public function cubeInfo2(Request $request)
    {
        //return $infos = DB::table('room_data')->select('room', 'people', 'room_type')->where('cube_id', 'Cube6')->get();
        return $infos = DB::select(DB::raw('select * from room_data2 where cube_id = "'.$request->cubeId.'"'));

    }

}
