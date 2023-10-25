<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->get('search');
            $posts = Post::where('title', 'like', '%' . $search . '%')->get();
        } else {
            $posts = Post::all();
        }

        return view('posts.index', ['posts' => $posts]);
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::id();
        $post->save();

        return redirect()->route('posts.index');
    }
    public function edit(Post $post)
    {
        if (Auth::id() != $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized Access');
        }

        return view('posts.edit', ['post' => $post]);
    }
    public function update(Request $request, Post $post)
    {
        if (Auth::id() != $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized Access');
        }

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();

        return redirect()->route('posts.index');
    }
    public function destroy(Post $post)
    {
        if (Auth::id() != $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized Access');
        }

        $post->delete();
        return redirect()->route('posts.index');
    }
}
