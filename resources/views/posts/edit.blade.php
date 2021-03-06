@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="/posts/{{ $post->id }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary btn-sm float-right ml-1"><i class="fa fa-save"></i> Save</button>
                        <a href="/posts" class="btn btn-secondary btn-sm float-right"><i class="fa fa-arrow-left"></i> Back</a>
                        {{ $post->title }}
                    </div>

                    <div class="card-body">
                        @include('posts._form')
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
