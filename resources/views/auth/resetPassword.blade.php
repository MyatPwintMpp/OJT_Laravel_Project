@extends('layout')
@section('content')
<div class="content-container">
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <div class="form-ttl">
            <h3 class="text-center mb-5">Update Password</h3>
        </div>
        <div>
            <input type="hidden" value="{{$token}}" name="token" id="token">
        </div>
        <div class="form-group p-2">
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
        </div>
        <div class="form-group p-2">
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="form-group p-2">
            <label for="password_confirmation">Password Confirmation</label><br>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
        <div class="form-group p-2">
            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
        </div>
    </form>
</div>
@endsection
