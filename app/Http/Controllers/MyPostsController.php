<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class MyPostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $is_superadmin = true;

        return view('posts.index', compact('posts', 'is_superadmin'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $post = new Post();

        $post->user_id = $request->user()->id;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->published_at = $request->has('publish') ? date('Y-m-d H:i:s') : null;
        $post->save();

        return redirect()->route('posts.list');
    }

    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.edit', compact('post'));
    }

    public function update($id, Request $request)
    {
        $post = Post::find($id);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->published_at = $request->has('publish') ? date('Y-m-d H:i:s') : null;
        $post->save();

        return redirect()->route('posts.list');
    }

    public function delete($id)
    {
        $post = Post::find($id);

        $post->delete();

        return redirect()->route('posts.list');
    }
}
