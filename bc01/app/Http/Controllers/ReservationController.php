<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use http\Cookie;
use Illuminate\Http\Request;
use App\Reservation;
use Illuminate\Support\Facades\App;

use DB;


class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $locale = App::getLocale();
        //$reservations = Reservation::all();
        $cookie = $_COOKIE['room'];
        $reservations = Reservation::where('room', $cookie)->get();
        //dd($cookie);
        return view('reservations.index', compact('reservations','locale'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //return view('reservations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'description'  => 'required|string|max:255',
            'dateFrom' => 'required|date|before:dateTo',
            'dateTo' => 'required|date|after:dateFrom',
        ]);

        //KONTROLA DATUMOV
        /*if(Carbon::parse($request->dateFrom)->gt(Carbon::parse($request->dateTo))){
            return redirect()->route('reservations.index')->with('alert', 'Date From ('.$request->dateFrom.') can not be after date To ('.$request->dateTo.')!');
        }*/



        $startTime = Carbon::parse($request->dateFrom)->format('Y-m-d H:i:s');

        $endTime = Carbon::parse($request->dateTo)->format('Y-m-d H:i:s');

        $room = $request->room;

        $eventsCount = Reservation::where(function ($query) use ($startTime, $endTime, $room) {
            $query->where(function ($query) use ($startTime, $endTime, $room) {
                $query->where('room', $room)
                    ->where('dateFrom', '<=', $startTime)
                    ->where('dateTo', '>', $startTime);
                })
                ->orWhere(function ($query) use ($startTime, $endTime, $room) {
                    $query->where('room', $room)
                        ->where('dateFrom', '<', $endTime)
                        ->where('dateTo', '>=', $endTime);
                })

                ->orWhere(function ($query) use ($startTime, $endTime, $room) {
                    $query->where('room', $room)
                        ->where('dateFrom', '=', $startTime)
                        ->where('dateTo', '=', $endTime);
                })
                ->orWhere(function ($query) use ($startTime, $endTime, $room) {
                    $query->where('room', $room)
                        ->where('dateFrom', '>', $startTime)
                        ->where('dateTo', '<', $endTime);
                });

        })->count();
        //dd($eventsCount);

        if ($eventsCount == 0){
            Reservation::create([
                'name' => $request->name,
                'description' => $request->description,
                'room' => $request->room,
                'dateFrom' => Carbon::parse($request->dateFrom)->format('Y-m-d H:i:s'),
                'dateTo' => Carbon::parse($request->dateTo)->format('Y-m-d H:i:s')
            ]);

            return redirect()->route('reservations.index');
        } else {

            $engAlert = 'Date range From: '.$request->dateFrom.' To: '.$request->dateTo.' is already taken for room '.$request->room.'!';
            $svkAlert = 'Časový rozsah od: '.$request->dateFrom.' do: '.$request->dateTo.' je obsaneý pre miestnosť '.$request->room.'!';
            if(App::getLocale() == 'sk'){
                return redirect()->route('reservations.index')->with('alert', $svkAlert);
            }
            else{
                return redirect()->route('reservations.index')->with('alert', $engAlert);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $reservationData = Reservation::where('id', $id)->first();
        //dd($reservationData);
        return view('reservations.show', compact('reservationData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
