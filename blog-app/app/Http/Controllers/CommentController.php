<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewCommentNotification;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            'post_id' => 'required|exists:posts,id'
        ]);

        Comment::create([
            'body' => $request->body,
            'post_id' => $request->post_id,
            'user_id' => Auth::id()
        ]);
        $post->user->notify(new NewCommentNotification($comment, $post));
        return back()->with('success', 'Comment added successfully');
    }
}
