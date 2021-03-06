@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <form action="/roles/{{ $role->id }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="card-header">
                        <button type="submit" class="btn btn-primary btn-sm float-right ml-1"><i class="fa fa-save"></i> Update</button>
                        <a href="{{ route('roles.list') }}" class="btn btn-secondary btn-sm float-right"><i class="fa fa-arrow-left"></i> Back</a>
                        {{ $role->name }}
                    </div>

                    <div class="card-body">
                        @include('roles._form')
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
