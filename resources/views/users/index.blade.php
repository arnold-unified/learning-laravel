@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('users.create') }}" class="btn btn-success btn-sm float-right"><i class="fa fa-plus"></i> Add User</a>
                    Users
                </div>

                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Mobile</th>
                                <th class="text-center">Address</th>
                                <th class="text-center">Roles</th>
                                {{--<th class="text-center">Created</th>--}}
                                <th class="text-center">Updated</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($users) > 0)
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->profile ? $user->profile->full_name : '' }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->profile ? $user->profile->mobile : '' }}</td>
                                        <td>{{ $user->profile ? $user->profile->address : '' }}</td>
                                        <td>{{ $user->roles_list }}</td>
                                        {{--<td class="text-center">{{ $user->created }}</td>--}}
                                        <td class="text-center">{{ $user->updated }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('users.edit', ['id' => $user->id]) }}" class="btn btn-secondary btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">No users available</td>
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
