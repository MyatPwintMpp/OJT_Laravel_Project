@extends('layout')
@section('content')
    <div class="content-container">
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="form-ttl">
                <h3 class="text-center mb-5">Reset Password</h3>
            </div>
            <div class="text-danger text-center">
                @if (count($errors) > 0)
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
                <button type="submit" class="btn btn-secondary btn-lg">Submit</button>
            </div>
        </form>

        @if (Session::has('status'))
            <p>{{ Session::get('status') }}</p>
        @endif
    </div>
@endsection
