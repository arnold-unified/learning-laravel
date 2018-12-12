<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::get();

        return view('posts.index', compact('posts'));
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
        if ($request->has('publish')) {
            $post->published_at = Carbon::now();
        }
        $post->save();

        return redirect('/posts');
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
        $post->published_at = $request->has('publish') ? Carbon::now() : null;
        $post->save();

        return redirect('/posts');
    }

    public function delete($id)
    {
        $post = Post::find($id);

        $post->delete();

        return redirect('/posts');
    }
}
