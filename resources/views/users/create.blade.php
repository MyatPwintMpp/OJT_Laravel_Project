@extends('layout')
@section('title', 'Create | User')
@section('content')
    <div class="content-container">
        <form enctype="multipart/form-data" action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="form-ttl">
                <h3 class="text-center mb-5">Add New User</h3>
            </div>
            <div class="form-group p-2">
                <label for="img">Profile Picture</label><input type="file" name="img" id="img"
                    accept="image/*" class="form-control">
                @if ($errors->has('img'))
                    <div class="text-danger">
                        <p>{{ $errors->first('img') }}</p>
                    </div>
                @endif
            </div>

            <div class="form-group p-2">
                <label for="email">Email</label><input type="email" name="email" id="email"
                    value="{{ old('email') }}" class="form-control">
                @if ($errors->has('email'))
                    <div class="text-danger">
                        <p>{{ $errors->first('email') }}</p>
                    </div>
                @endif
            </div>

            <div class="form-group p-2">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                @if ($errors->has('name'))
                    <div class="text-danger">
                        <p>{{ $errors->first('name') }}</p>
                    </div>
                @endif
            </div>

            <div class="form-group p-2">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                @if ($errors->has('password'))
                    <div class="text-danger">
                        <p>{{ $errors->first('password') }}</p>
                    </div>
                @endif
            </div>

            <div class="form-group p-2">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                @if ($errors->has('password_confirmation'))
                    <div class="text-danger">
                        <p>{{ $errors->first('password_confirmation') }}</p>
                    </div>
                @endif
            </div>

            @if ($message = Session::get('error'))
                <div class="text-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="form-group p-2">
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </form>
    </div>
@endsection
