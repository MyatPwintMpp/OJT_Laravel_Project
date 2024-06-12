<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" />

</head>

<body>
    <div class="header container">
        <span>
            <span><a href="#" rel="home" class="header-nav-home">Home</a></span>
            <span><a href="{{ route('users.index') }}" rel="users" class="header-nav-home">Users</a></span>
            <span><a href="#" rel="create" class="header-nav-home">Create</a></span>
        </span>
        <span>
            <span><a href="#" class="btn btn-outline-primary">Logout</a></span>
            <span><a href="#" class="btn btn-outline-primary">Login</a></span>
            <span><a href="{{ route('users.create') }}" class="btn btn-outline-primary">Register</a></span>
        </span>
    </div>
    <div class="container content">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('js/common.js') }}"></script>
</body>

</html>
