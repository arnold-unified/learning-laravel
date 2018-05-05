@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('permissions.create') }}" class="btn btn-success btn-sm float-right"><i class="fa fa-plus"></i> Add Permission</a>
                    Permissions
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
                            @if (count($permissions) > 0)
                                @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->description }}</td>
                                        <td class="text-center">{{ $permission->created }}</td>
                                        <td class="text-center">{{ $permission->updated }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('permissions.edit', ['id' => $permission->id]) }}" class="btn btn-secondary btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-center">No permissions available</td>
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
