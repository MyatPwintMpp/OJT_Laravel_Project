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

            @if (auth()->check() && $post->user_id == auth()->user()->id)
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-secondary mt-3">Edit</a>
                <form action="{{ route('posts.delete', $post->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger mt-3" rel="Delete Post">Delete</button>
                </form>
            @endif
            <div>

                @if (Auth::check())
                    <form action="{{ route('comment.store') }}" method="POST">
                        @csrf
                        <div class="form-group p-2">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" id="user_id">
                            <input type="hidden" name="post_id" value="{{ $post->id }}" id="post_id">
                        </div>
                        <div class="form-group p-2">
                            <textarea placeholder="Comment" id="user_comment" name="comment" rows="2" class="form-control"></textarea>
                            @if ($errors->has('comment'))
                                <div class="text-danger">
                                    <p>{{ $errors->first('comment') }}</p>
                                </div>
                            @endif
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary mt-3">Comment</button>
                            <a href="{{ route('posts.index') }}" class="btn btn-secondary mt-3">Back</a>
                        </div>
                    </form>
                @else
                    <div>Please Login to comment.</div>
                @endif
                <div class="mt-5">
                    @foreach ($post->comments as $comment)
                        <div>{{ $comment->user->name }}</div>
                        <div class="border border-dark-subtle rounded-4 p-2 mb-2">
                            {{ $comment->comment }}
                            <div class="text-end">
                                @if (auth()->check())
                                    @if (auth()->user()->id == $comment->user->id || auth()->user()->role == 1)
                                        <a href="{{ route('comments.edit', $comment->id) }}" rel="show post"
                                            class="btn btn-primary mt-3">Edit</a>

                                            <form action="{{ route('comments.delete', $comment->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-danger" rel="Delete User">Delete</button>
                                            </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
