@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('roles.create') }}" class="btn btn-success btn-sm float-right"><i class="fa fa-plus"></i> Add Role</a>
                    Roles
                </div>

                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Created</th>
                                <th class="text-center">Updated</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($roles) > 0)
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td class="text-center">{{ $role->created }}</td>
                                        <td class="text-center">{{ $role->updated }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('roles.edit', ['id' => $role->id]) }}" class="btn btn-secondary btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">No roles available</td>
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
