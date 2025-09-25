<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'body' => 'required|string|max:1000|min:3',
        ]);

        $comment = $post->comments()->create([
            'body' => $data['body'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
