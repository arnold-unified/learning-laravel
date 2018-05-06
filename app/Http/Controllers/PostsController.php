<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::with(['author', 'author.profile'])->get();
        $is_superadmin = auth()->user()->hasRole('superadmin');

        return view('posts.index', compact('posts', 'is_superadmin'));
    }
}
