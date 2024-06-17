@extends('layout')
@section('content')
    <div>
        @csrf
        <div class="mb-5">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @elseif($message = Session::get('failed'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <h3 class="text-center mb-5">Downloads</h3>
            <div>
                <form method="GET" action="{{ route('admin.file.csv.users.download') }}">
                    <label>User Table as CSV</label>
                    <button type="submit" class="btn btn-secondary mt-3">Download</button>
                </form>
                <form method="GET" action="{{ route('admin.file.csv.posts.download') }}">
                    <label>Post Table as CSV</label>
                    <button type="submit" class="btn btn-secondary mt-3">Download</button>
                </form>
            </div>
        </div>
        <div>
            <h3 class="text-center mb-5">Upload</h3>
            <div>
                <form method="POST" action="{{ route('admin.file.csv.users.upload') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group p-2">
                        <label for="users_csv">Users Csv file</label>
                        <input name="users_csv" id="users_csv" type="file" accept=".csv" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-secondary mt-3">Upload</button>
                </form>
                <form method="POST" action="{{ route('admin.file.csv.posts.upload') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group p-2">
                        <label for="posts_csv">Posts Csv file</label>
                        <input name="posts_csv" id="posts_csv" type="file" accept=".csv" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-secondary mt-3">Upload</button>
                </form>
            </div>
        </div>
    </div>
@endsection
