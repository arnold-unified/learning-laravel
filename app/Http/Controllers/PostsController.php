<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::with(['author', 'author.profile'])->get();
        $is_superadmin = auth()->user()->hasRole('superadmin');

        return view('posts.index', compact('posts', 'is_superadmin'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts|max:255',
            'content' => 'required|min:20'
        ]);

        $post = new Post();
        $post->user_id = $request->user()->id;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->published_at = $request->has('publish') ? Carbon::now() : null;
        $post->save();

        return redirect()->route('posts.list')->with('status', 'Post successfully created.');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts|max:255',
            'content' => 'required|min:20'
        ]);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->published_at = $request->has('publish') ? Carbon::now() : null;
        $post->save();

        return redirect()->route('posts.list')->with('status', 'Post successfully updated.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Post successfully deleted.'
        ]);
    }
}
