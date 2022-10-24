<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class PlaceController extends Controller
{
    public function index()
    {
        $places = Place::all();
        return view('admin.places.index', compact('places'));
    }

    public function create()
    {
        return view('admin.places.create');
    }

    public function store(Request $request)
    {
        Place::create($request->all());

        Session::flash('flash_message', 'Place successfully added!');
        
        return redirect()->route('admin.places.index');  
    }

    public function show($id)
    {
    $place = Place::find($id);
    return view('admin.places.show')->with('place',$place);
}

public function edit($id)
    {
        $place = Place::find($id);
        return view('admin.places.edit')->with('place',$place);
    }

    public function update(Request $request, $id)
    {
        $place = Place::find($id);

    $this->validate($request, [
        'places' => 'required'
        
    ]);

    $input = $request->all();

    $place->fill($input)->save();

    Session::flash('flash_message', 'Place successfully updated!');

    return redirect()->route('admin.places.index');
    }
    public function destroy($id)
    {
        $place = Place::find($id);

        $place->delete();
    
        Session::flash('flash_message', 'Place successfully deleted!');
    
        return redirect()->route('admin.places.index');
    }

}
