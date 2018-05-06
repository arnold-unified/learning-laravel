<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\PostRepositoryInterface as PostRepository;
use App\Http\Requests\Posts\StorePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Post;

class AuthorsPostsController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->all(['author', 'author.profile']);
        $is_superadmin = auth()->user()->hasRole('superadmin');

        return view('posts.index', compact('posts', 'is_superadmin'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $this->authorize('create', Post::class);
        
        $request->merge(['user_id' => $request->user()->id]);

        $this->postRepository->create($request->all());

        return redirect()->route('posts.list');
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post, UpdatePostRequest $request)
    {
        $this->authorize('update', $post);

        $this->postRepository->update($post->id, $request->all());

        return redirect()->route('posts.list');
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $this->postRepository->delete($post->id);

        return response()->json([
            'success' => true,
            'message' => 'Post successfully deleted.'
        ]);
    }
}
