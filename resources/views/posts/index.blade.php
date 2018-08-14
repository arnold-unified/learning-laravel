@extends('layouts.app')

@section('content')
<post-list inline-template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <a href="/posts/create" class="btn btn-success btn-sm float-right"><i class="fa fa-plus"></i> Add Post</a>
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
                                                <form action="/posts/{{ $post->id }}" method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a href="/posts/{{ $post->id }}" class="btn btn-secondary btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
                                                {{-- <a href="#" @click.stop.prevent="deleteModel('/posts/' + {{ $post->id }}, '{{ $post->title }}')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> --}}
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

                <delete-model :data-url="url" :data-title="title"/>
            </div>
        </div>
    </div>
</post-list>
@endsection
