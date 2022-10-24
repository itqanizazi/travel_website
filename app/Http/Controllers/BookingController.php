<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\Place;

class BookingController extends Controller
{

    public function index() : View
    {
        $bookings = Booking::get();
        

        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $places = Place::all();

        return view('admin.bookings.create', compact('places'));
    }

    public function store(Request $request): RedirectResponse
    {
        //dd(" hello ");
        //$slug = Str::slug($request->name);        
        //TravelPackage::create($request->validated() + ["slug" => $slug]);

        $this->validate($request, [
            'place_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
          ]);
        
          $input = $request->all();
        
          Booking::create($input);
        
          Session::flash('flash_message', 'Booking successfully added!');
        
          return redirect()->back();
        
    }

    public function edit(Request $request): View
    {
        $places = Place::get();

        return view('admin.bookings.edit', compact('bookings', 'places'));
    }

    public function update(Request $request, Booking $booking): RedirectResponse
    {
        //$slug = Str::slug($request->name);
        //$travelPackage->update($request->validated() + ["slug" => $slug]);

        $booking = Booking::find($id);

        $this->validate($request, [
            'place_id' => 'required',
            'start-date' => 'required',
            'end_date' => 'required'
          ]);
        
          $input = $request->all();
        
          TravelPackage::create($input);
        
          Session::flash('flash_message', 'Booking successfully added!');
        
          return redirect()->back();

        return redirect()->route('admin.bookings.index')->with('message', 'Updated Successfully !');
    }

    public function destroy(Booking $booking): RedirectResponse
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index')->with('message', 'Deleted Successfully');
    }
}
