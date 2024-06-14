@extends('layout')
@section('content')
    <div class="content-container">

        @if (Session::has('error'))
            <div class="alert alert-danger">{{ Session::get('error') }}</div>
        @elseif(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <p class="alert alert-warning">{{ $error }}</p>
            @endforeach
        @endif
        <div class="form-ttl">
            <h3 class="text-center mb-5">All Posts</h3>
        </div>
        @foreach ($posts as $post)
            <div class="post-container">
                <h6>Title : {{ $post->title }}</h6><br />
                <h6>Description</h6>
                <p>{{ $post->description }}</p>
                <h8>Post Created By : {{ $post->user->name }}</h8><br />
                <div>
                    @if (count($post->comments))
                        <br>
                        <div>Comments : </div>
                        @foreach ($post->comments->take(1) as $comment)
                            <div>{{ $comment->user->name }}</div>
                            <div class="border border-dark-subtle rounded-4 p-2 mb-2">{{ $comment->comment }}</div>
                        @endforeach
                    @endif

                </div>
                <a href="{{ route('posts.show', $post->id) }}" rel="show post" class="btn btn-outline-primary mt-3">More</a>
            </div>
        @endforeach
        <!-- Pagination links -->
        {{ $posts->links() }}
    </div>
@endsection
