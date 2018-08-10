<?php

namespace Modules\Bookings\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Bookings\Entities\Bookings;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('bookings::index');
    }

    public function submit(Request $request)
    {
       
        $saved = false;
        $error_message = "Booking can't save..!!";
        $error = true;
        if($request->has("values")){
          //  print_r(($request->values));
            $value = array();
            $bookDate = array();
            parse_str($request->values,$values);
            parse_str($request->bookDate,$bookDate);
            $values["bookdate"] = $bookDate["date"];
            $values["total_guest"] = $request->total_guest;
            $values["totalDays"] = $request->totalDays;
            $values["guest"] = json_encode($request->guestDetail);
            $values["bookDateDetail"] = json_encode(
                array(
                 "arrival" => $request->dateArrival,
                 "departure" => $request->dateDeparture
                )
            );
           
            try {
                $bookings = new Bookings();
                foreach($values as $key => $value){
                    $bookings->$key = $value;
                }
                $saved = $bookings->save();
                $error_message = "Successfully created post!";
                $error = false;
            } catch (\Exception $e) {
				$error = true;
				$error_message = $e->getMessage();
            }
            

        }

        return Response()->json([
            "id" => $saved,
            "message" => $error_message,
            "error" => $error
        ], 200);
        die();
        
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('bookings::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('bookings::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('bookings::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
