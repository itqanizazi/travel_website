<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\TravelPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\Category;

class TravelPackageController extends Controller
{

    public function index() : View
    {
        $travelPackages = TravelPackage::get();
        

        return view('admin.travel-packages.index', compact('travelPackages'));
    }

    public function create(): View
    {
        $categories = Category::get();

        return view('admin.travel-packages.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        //dd(" hello ");
        //$slug = Str::slug($request->name);        
        //TravelPackage::create($request->validated() + ["slug" => $slug]);

        $this->validate($request, [
            'name' => 'required',
            'location' => 'required',
            'duration' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'category_id' => 'required'
          ]);
        
          $input = $request->all();
        
          TravelPackage::create($input);
        
          Session::flash('flash_message', 'Task successfully added!');
        
          return redirect()->back();
        
    }

    public function edit(Request $request): View
    {
        $categories = Category::get();

        return view('admin.travel-packages.edit', compact('travelPackage', 'categories'));
    }

    public function update(Request $request, TravelPackage $travelPackage): RedirectResponse
    {
        //$slug = Str::slug($request->name);
        //$travelPackage->update($request->validated() + ["slug" => $slug]);

        $travelPackage = TravelPackage::find($id);

        $this->validate($request, [
            'name' => 'required',
            'location' => 'required',
            'duration' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'category_id' => 'required'
          ]);
        
          $input = $request->all();
        
          TravelPackage::create($input);
        
          Session::flash('flash_message', 'Task successfully added!');
        
          return redirect()->back();

        return redirect()->route('admin.travel-packages.index')->with('message', 'Updated Successfully !');
    }

    public function destroy(TravelPackage $travelPackage): RedirectResponse
    {
        $travelPackage->delete();

        return redirect()->route('admin.travel-packages.index')->with('message', 'Deleted Successfully');
    }
}
