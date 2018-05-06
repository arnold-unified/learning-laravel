<?php

namespace App\Repositories;

use App\Repositories\Contracts\PostRepositoryInterface;
use Carbon\Carbon;
use App\Post;

class PostRepository implements PostRepositoryInterface
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function all($relationships = [])
    {
        return $this->post->with($relationships)->get();
    }

    public function published($relationships = [])
    {
        return $this->post->with($relationships)->published()->get();
    }

    public function find($id, $relationships = [])
    {
        return $this->post->with($relationships)->find($id);
    }

    public function create($data)
    {
        $post = $this->post;
        $post->user_id = $data['user_id'];
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->published_at = array_key_exists('publish', $data) ? Carbon::now() : null;
        $post->save();
    }

    public function update($id, $data)
    {
        $post = $this->find($id);
        $post->title = $data['title'];
        $post->content = $data['content'];
        $post->published_at = array_key_exists('publish', $data) ? Carbon::now() : null;
        $post->save();
    }

    public function delete($id)
    {
        $post = $this->find($id);
        $post->delete();
    }
}