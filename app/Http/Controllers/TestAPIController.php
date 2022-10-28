<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Place;
use App\Models\Booking;
class TestAPIController extends Controller{
    //
    function test_data(){

        $list = [
            ['name'=>'Hello'],
            ['name'=>'Hello'],
            ['name'=>'Hello'],
            ['name'=>'Hello'],
            ['name'=>'Hello'],
        ];

        $places = Place::orderBy('id', 'asc')->get();

        return Response::json(
            ['places'=>$places]
        );

    }

    function bookings(){
       
    
            $bookings = Booking::orderBy('id', 'asc')->get();

            foreach ($bookings as $booking){
            
            $booking['title'] = $booking->place->name;
            $booking['start'] = $booking->start_date;
            $booking['end'] =$booking->end_date;
            $booking['allday'] =true;

            
            }

           
    
            return Response::json(
                ['bookings'=>$bookings]
            );
    }
}
