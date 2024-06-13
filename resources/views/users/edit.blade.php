@extends('layout')
@section('title', 'Edit | User')
@section('content')
    <div class="content-container">
        <form enctype="multipart/form-data" action="{{ route('users.update') }}" method="POST">
            @csrf
            @if (count($errors) > 0)
                @foreach ($errors->all() as $error)
                    <p class="alert alert-warning">{{ $error }}</p>
                @endforeach
            @endif
            <div class="form-ttl">
                <h3 class="text-center mb-5">Edit User</h3>
            </div>
            <div class="form-group p-2">
                <input name="id" name="id" id="id" type="hidden" class="form-control"
                    @if ($errors->any()) value="{{ old('id') }}" @else value="{{ $user->id }}" @endif>
            </div>

            <div class="form-group p-2">
                <label for="img">Profile Picture</label><br>
                <input type="file" name="img" id="img" accept="image/*" class="form-control">
            </div>
            @if ($errors->has('img'))
                <div>
                    <p>{{ $errors->first('img') }}</p>
                </div>
            @endif
            <div class="form-group p-2">
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" placeholder="Email" class="form-control"
                    @if ($errors->any()) value="{{ old('email') }}" @else value="{{ $user->email }}" @endif>
            </div>
            @if ($errors->has('email'))
                <div>
                    <p>{{ $errors->first('email') }}</p>
                </div>
            @endif
            <div class="form-group p-2">
                <label for="name">Name</label><br>
                <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                    @if ($errors->any()) value="{{ old('name') }}" @else value="{{ $user->name }}" @endif>
            </div>
            @if ($errors->has('name'))
                <div>
                    <p>{{ $errors->first('name') }}</p>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div>
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="form-group p-2">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                <a href="{{ route('users.index') }}" class="btn btn-secondary btn-lg">Back</a>
                <a href="{{ route('changePasswordScreen',$user->id ) }}" class="btn btn-outline-primary btn-lg">Change Password</a>
            </div>
        </form>
    </div>
@endsection
