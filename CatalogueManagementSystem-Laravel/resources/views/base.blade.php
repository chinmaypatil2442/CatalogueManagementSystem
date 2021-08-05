<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue Management System</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <header class="header">
        <div class="header_top_section" id="header_top_section">
            @if (Session::get('user')=='' || Session::get('user')==null)
            <a class="button {{ Request::is('login') ? 'active' : '' }}" href="{{ url('/login') }}" id="login">Login</a>
            <a class="button {{ Request::is('signup') ? 'active' : '' }}" href="{{ url('/signup') }}" id="signup">Sign Up</a>
            @else
            <span style="color: white;margin: 7px;float: left;">Welcome, {{ json_decode(Session::get('user'))->Name }}</span>
            <a class="button {{ Request::is('logout') ? 'active' : '' }}" href="{{ route('authoff') }}" id="logout">Logout</a>
            @endif
        </div>

        <div class="header_bottom_section">
            <a class="button {{ Request::is('index') ? 'active' : '' }}" href="{{ url('/index') }}">Home</a>
            <a class="button {{ Request::is('about') ? 'active' : '' }}" href="{{ url('/about') }}">About</a>
            <a class="button {{ Request::is('blog') ? 'active' : '' }}" href="{{ url('/blog') }}">Forum</a>

            @if (Session::get('user')!=null && json_decode(Session::get('user'))->RoleId==1)
            <a class="button {{ Request::is('courseterm') ? 'active' : '' }}" href="{{ url('/courseterm') }}" id="courses">List of Courses</a>
            <a class="button {{ Request::is('feedback') ? 'active' : '' }}" href="{{ url('/feedback') }}" id="feedback">Feedback</a>
            <!-- <a class="button {{ Request::is('chat') ? 'active' : '' }}" href="{{ url('/chat') }}" id="chat">Chat</a> -->
            @endif

            @if (Session::get('user')!=null && json_decode(Session::get('user'))->RoleId==2)
            <a class="button {{ Request::is('upcoming_courses') ? 'active' : '' }}" href="{{ url('/upcoming_courses') }}" id="upcoming_courses">Upcoming Courses</a>
            <a class="button {{ Request::is('view_courses') ? 'active' : '' }}" href="{{ url('/view_courses') }}" id="view_courses">View Courses</a>
            <a class="button {{ Request::is('view_feedback') ? 'active' : '' }}" href="{{ url('/view_feedback') }}" id="view_feedback">View Feedback</a>
            @endif

            @if (Session::get('user')!=null && json_decode(Session::get('user'))->RoleId==3)
            <a class="button {{ Request::is('users') ? 'active' : '' }}" href="{{ url('/view_users') }}" id="users">Users</a>
            @endif
        </div>
    </header>
    <div class="container">
        @yield('main')
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>

</html>
