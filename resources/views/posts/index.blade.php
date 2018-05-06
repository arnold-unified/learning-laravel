@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm float-right"><i class="fa fa-plus"></i> Add Post</a>
                    Posts
                </div>

                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">Title</th>
                                <th class="text-center">Content</th>
                                @if ($is_superadmin)
                                    <th class="text-center">Author</th>
                                @endif
                                <th class="text-center">Published</th>
                                <th class="text-center">Last Moderator</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($posts) > 0)
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ str_limit($post->content, 20) }}</td>
                                        @if ($is_superadmin)
                                            <td>{{ $post->author->profile ? $post->author->profile->full_name : '' }}</td>
                                        @endif
                                        <td class="text-center">{{ $post->published }}</td>
                                        <td>{{ $post->moderator && $post->moderator->profile ? $post->moderator->profile->full_name : '' }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('posts.edit', ['id' => $post->id]) }}" class="btn btn-secondary btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="text-center">No posts available</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
