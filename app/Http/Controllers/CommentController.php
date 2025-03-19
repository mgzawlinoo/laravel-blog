<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Reply;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    //

    public function store(Request $request, Post $post)
    {
        $data = $request->validate([
            'content' => 'required',
        ]);

        Comment::create([
            'content' => $data['content'],
            'post_id' => $post->id,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->back()->with('success', 'Comment added successfully');
    }

    public function reply(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'content' => 'required'
        ]);

        Reply::create([
            'content' => $data['content'],
            'comment_id' => $comment->id,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->back()->with('success', 'Reply added successfully');
    }
}
