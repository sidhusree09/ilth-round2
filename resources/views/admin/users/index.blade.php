<!-- Admin Panel - Users Index -->

@extends('layouts.admin')

@section('content')

@if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
<div class="container-fluid">
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <h4>Users</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-2">Create User</a>

            <table class="table table-bordered table-striped table-bordered bg-light">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Course</th>
                        <th>Enrollments</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td><img src="{{ $user->getProfilePicture() }}" width="50" height="50"/></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->courseCount() }}</td>
                            <td>{{ $user->enrollments()->count() }}</td>   
                            <td>{{ $user->getRoleNames()->implode(', ')  }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end">
            {{ $users->links() }}
        </div>
        
    </div>
</div>

@endsection
