@extends('layout')
@section('content')
<div class="content-container">
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <div class="form-ttl">
                <h3 class="text-center mb-5">Login Page</h3>
            </div>
            <div class="text-danger text-center">
            @if(count($errors)>0)
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
            @endif
            </div>
            <div class="form-group p-2">
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control">
            </div>
            <div class="form-group p-2">
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-submit-btn">
                <button type="submit" class="btn btn-primary btn-lg">Login</button>
                <a href="{{ route('password.request') }}" class="btn btn-secondary btn-lg">Forgot Password</a>
            </div>
        </div>
    </form>
</div>
@endsection
