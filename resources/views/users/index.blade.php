@extends('layout')
@section('title', 'Index | User')
@section('content')
    <div class="content-container">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @elseif($message = Session::get('failed'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <p class="alert alert-warning">{{ $error }}</p>
            @endforeach
        @endif
        <div class="form-ttl">
            <h3 class="text-center mb-5">All Users List</h3>
        </div>
        <div>
            <a href="{{ route('users.create') }}" alt="create user" class="btn btn-primary mb-3">Create User</a>
        </div>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>User ID</th>
                    <th>User Email</th>
                    <th>User Name</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->name }}</td>
                    <td><a href="{{ route('users.detail', $user->id) }}" class="btn btn-outline-success"
                            rel="User Detail">Details
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-success"
                                rel="Edit User">Edit</a>
                            <form action="{{ route('users.delete', $user->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-danger" rel="Delete User">Delete</button>
                            </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <!-- Pagination links -->
        {{ $users->links() }}
    </div>
@endsection
