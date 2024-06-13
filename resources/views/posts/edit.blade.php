@extends('layout')
@section('content')
    <div class="content-container">
        <form action="{{ route('posts.update') }}" method="POST">
            @csrf
            <div class="form-ttl">
                <h3 class="text-center mb-5">Edit Post</h3>
            </div>
            <div>
                <input type="hidden" value="{{ $post->id }}" name="id" id="id">
            </div>
            <div class="form-group p-2">
                <label for="title">Title</label><br>
                <input id="title" name="title" value="{{ $errors->any() ? old('post') : $post->title }}"
                    class="form-control">
            </div>
            @if ($errors->has('title'))
                <div>
                    <p>{{ $errors->first('title') }}</p>
                </div>
            @endif
            <div class="form-group p-2">
                <label for="description">Description</label><br>
                <textarea id="description" name="description" class="form-control">{{ $errors->any() ? old('description') : $post->description }}</textarea>
            </div>
            @if ($errors->has('description'))
                <div>
                    <p>
                        {{ $errors->first('description') }}
                    </p>
                </div>
            @endif
            <div><button type="submit" class="btn btn-primary mt-3">Submit</button></div>
        </form>
    </div>
@endsection
