@extends('layout')

@section('content')
    <div class="content-container">
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <p class="alert alert-warning">{{ $error }}</p>
            @endforeach
        @endif
        <div>
            <p class="post-title">Title: {{ $post->title }}</p>
        </div><br />
        <div>
            <p class="post-desc">Description: {{ $post->description }}</p>
        </div><br />
        <div>
            <h8 class="post-user">Post by: {{ $post->user->name }}</h8>
        </div><br />
        <div class="form-group p-2">
            <a href="{{ route('posts.index') }}" class="btn btn-primary mt-3">Back</a>
            @if (auth()->check() && $post->user_id == auth()->user()->id)
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-secondary mt-3">Edit</a>
                <a href="{{ route('posts.delete', $post->id) }}" class="btn btn-danger mt-3">Delete</a>
            @endif

        </div>
    </div>
@endsection
