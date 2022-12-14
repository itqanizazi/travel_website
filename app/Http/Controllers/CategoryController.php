<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index() : View
    {
        $categories = Category::get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create() : View
    {
        return view('admin.categories.create');
    }

    public function store(Request $request) : RedirectResponse
    {
        Category::create($request->all());

        Session::flash('flash_message', 'Task successfully added!');
        
        return redirect()->route('admin.categories.index');
    }

    public function edit(Category $category) : View
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request,Category $category) : RedirectResponse
    {
        $category->update($request->validated());

        return redirect()->route('admin.categories.index')->with('message', 'Updated Successfully !');
    }

    public function destroy(Category $category) : RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('message', 'Deleted Successfully !');
    }
}
