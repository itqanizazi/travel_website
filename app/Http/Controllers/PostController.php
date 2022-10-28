<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StorePostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::get();

        return view('admin.posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('admin.posts.create');
    }

    public function store(Request $request): RedirectResponse
    {
       $data = $request->all();
       $data['slug'] = Str::slug($request->title);
       $data['image'] = $request->file('image')->store(
           'assets/post', 'public'
        );
       
        Post::create($data);

        Session::flash('flash_message', 'Task successfully added!');

        return redirect()->route('admin.posts.index');
    }

    public function edit(Post $post): View
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        if($request->image){
            File::delete('storage/' . $post->image);
        }

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['image'] = $request->image ? $request->file('image')->store(
            'assets/post', 'public'
        ) : $post->image;

        $post->update($data);
        return redirect()->route('admin.posts.index')->with('message', 'Updated Successfully !');
    }

    public function destroy(Post $post)
    {
        if($post->image){
            File::delete('storage/' . $post->image);
        }

        $post->delete();
    

        return redirect()->route('admin.posts.index')->with('message', 'Deleted  Successfully !');
    }
}
