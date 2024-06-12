@extends('layout')
@section('title', 'Detail | User')
@section('content')
    <div class="content-container">
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <p class="alert alert-warning">{{ $error }}</p>
            @endforeach
        @endif
				<div class="form-ttl">
					<h3 class="text-center mb-5">Detail User</h3>
			</div>
        @if ($user->img)
            <img src="{{ asset('/storage/UserImages/' . $user->img) }}" alt="User Image" width="150" height="150">
        @endif

        <div>User ID: {{ $user->id }}</div>
        <div>Name: {{ $user->name }}</div>
        <div>email: {{ $user->email }}</div>
        <div>
            Role: {{ $user->role == 1 ? 'Admin' : 'Member' }}
        </div>
        <div class="form-group p-2">
            <a href="{{ route('users.index') }}" class="btn btn-primary btn-lg">Back</a>
        </div>
    </div>
@endsection
