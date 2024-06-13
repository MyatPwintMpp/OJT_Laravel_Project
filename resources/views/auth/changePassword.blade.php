@extends('layout')
@section('content')
    <div class="content-container">
        <form action="{{ route('changePassword') }}" method="POST">
            @csrf
            <div class="form-ttl">
                <h3 class="text-center mb-5">Change Password</h3>
            </div>
            <div><input type="hidden" value="{{ $user->id }}"></div>
            <div class="text-danger text-center">
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                @endif
            </div>
            <div class="form-group p-2">
                <label for="current_password">Current Password</label><br>
                <input type="password" id="current_password" name="current_password" class="form-control">
            </div>
            <div class="form-group p-2">
                <label for="new_password">New Password</label><br>
                <input type="password" id="new_password" name="new_password" class="form-control">
            </div>
            <div class="form-group p-2">
                <label for="old_password">Confirm New Password</label><br>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control">
            </div>
            <div class="form-submit-btn">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-secondary btn-lg">back</a>
            </div>
        </form>
    </div>
@endsection
