@extends('layout')
@section('content')
    <div class="content-container">
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="form-ttl">
                <h3 class="text-center mb-5">Create Post</h3>
            </div>
            <div class="form-group p-2">
                <input type="hidden" value="{{ $user_id }}" name="user_id" id="user_id" class="form-control">
            </div>
            <div class="form-group p-2">
                <label for="title">Title</label><br>
                <input name="title" id="title" value="{{ old('title') }}" class="form-control">
                @if ($errors->has('title'))
                    <div class="text-danger">
                        <p>{{ $errors->first('title') }}</p>
                    </div>
                @endif
            </div>
            <div class="form-group p-2">
                <label for="description">Description</label><br>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                    <div class="text-danger">
                        <p>{{ $errors->first('description') }}</p>
                    </div>
                @endif
            </div>
            <div>
                <button class="btn btn-primary mt-3">Submit</button>
            </div>
        </form>
    </div>
@endsection
