<?php

namespace App\Http\Controllers;

use App\Models\imagepost;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'caption' => 'required|string|max:255',
        ]);
        $post = new Post();
        $data['slug'] = \Str::random(10); 
        $data['user_id'] = auth()->id();
        $data['caption'] = $request->caption;
        $post->fill($data);
        $post->save();
        foreach ($request->file('image') as $image) {
            $name = rand(100000, 999999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/posts'), $name); 
            $simag = new imagepost();
            $simag->image_path = $name;
            $simag->post_id = $post->id;
            $simag->save();
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $images = $post->imagepost;
        
        return view('posts.show', compact('post', 'images'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $images = $post->imagepost;
        return view('posts.edit', compact('post', 'images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'image' => 'nullable',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg' ,
            'caption' => 'required|string|max:255',
        ]);
        if(request()->hasFile('image')){
            foreach ($request->file('image') as $image) {
                $name = rand(100000, 999999) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/posts'), $name); 
                $simag = new imagepost();
                $simag->image_path = $name;
                $simag->post_id = $post->id;
                $simag->save();
            }
        }
        $post->caption = $data['caption'];
        $post->save();
    return redirect()->back()->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
