@extends('layout')

@section('content')
    <div class="content-container">
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <p class="alert alert-warning">{{ $error }}</p>
            @endforeach
        @endif
        <div>
            <p class="post-title">Title: {{ $comment->post->title }}</p>
        </div><br />
        <div>
            <p class="post-desc">Description: {{ $comment->post->description }}</p>
        </div><br />
        <div>
            <h8 class="post-user">Post by: {{ $comment->user->name }}</h8>
        </div><br />
        <div class="form-group p-2">
            <form action="{{ route('comments.update') }}" method="POST">
                @csrf
                <div class="form-ttl">
                    <h5 class="text-center mb-5">Edit Comment</h5>
                </div>
                <div>
                    <input type="hidden" value="{{ $comment->id }}" name="id" id="id">
                </div>
                <div class="form-group p-2">
                    <label for="comment">Title</label><br>
                    <input id="comment" name="comment" value="{{ $errors->any() ? old('comment') : $comment->comment }}"
                        class="form-control">
                </div>
                @if ($errors->has('comment'))
                    <div>
                        <p>{{ $errors->first('comment') }}</p>
                    </div>
                @endif
                <div>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
