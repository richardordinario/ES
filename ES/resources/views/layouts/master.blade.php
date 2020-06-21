<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{URL::asset('/images/logo.ico')}}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    
    <link media="all" rel="stylesheet" href="{{URL::asset('/global/main.css')}}">
    <title>Evaluation System</title>
</head>
<body>
    <div id="nav-top">
        <a href="{{ URL('dashboard') }}"><img class="logo" src="{{URL::asset('/images/logo.png')}}" alt="" height="60" ></a>
        <div align="left" class="logout_btn"><a href="{{ url('/logout') }}" class="logout" style="font-size:14px;color: #999;margin-top:5px;"><span style="font-size: 14px;">|</span> &nbsp;&nbsp;Logout</a></div>       
        <div align="right">
            <span class="userlog"> <strong>Welcome</strong>&nbsp; {{ Auth::user()->name }}</span>
        </div>
        <div align="right"><span class="toggle-show glyphicon glyphicon-chevron-right"></span></div>
        <div align="right"><span class="toggle-hide glyphicon glyphicon-chevron-down"></span></div>
    </div>
    <div id="nav-side">
        @if(Auth::user()->utype == "Admin" || Auth::user()->utype == "Facilitator")
        <a href="{{ URL('dashboard') }}" id="dashboard" style="border-top: 1px solid #F5F5F5;"><span class="glyphicon glyphicon-stats"></span>&nbsp;&nbsp;&nbsp; Dashboard</a>
        <a href="{{ url('adminprofile') }}" id="adminprofile"><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;&nbsp; Profile</a>
        @endif
        
        @if(Auth::user()->utype == "Student")
        <a href="{{ url('profile') }}" id="profile_nav"><span class="glyphicon glyphicon-picture"></span>&nbsp;&nbsp;&nbsp; Profile</a>
        <a href="{{ url('evaluate') }}" id="evaluate_nav"><span class="glyphicon glyphicon-check"></span>&nbsp;&nbsp;&nbsp; Evaluate Faculty</a>
        @endif

        @if(Auth::user()->utype == "Admin" || Auth::user()->utype == "Facilitator")
        <a href="#" id="account"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;&nbsp; Account Management<span id="btn-caret" style="font-size: 13px;" class="account glyphicon glyphicon-chevron-left"></span><span style="font-size: 14px;" id="down-caret" class="account-hide glyphicon glyphicon-chevron-down"></span></a>
        <!-- account content -->
        <a href="{{URL('students')}}" id="content-stud" style="padding-left: 40px;display:none;"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;&nbsp; Student Management</a>
      
        <a href="{{URL('faculty')}}" id="content-prof" style="padding-left: 40px;display:none;border-bottom: 2px solid #dfe6e9;"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;&nbsp; Faculty Management</a>
        
        <a href="{{ url('subject') }}" id="subject_nav"><span class="glyphicon glyphicon-book"></span>&nbsp;&nbsp;&nbsp; Subject Management</a>
        <a href="{{ url('course') }}" id="course_nav"><span class="glyphicon glyphicon-education"></span>&nbsp;&nbsp;&nbsp; Course Management</a>
        <a href="{{ url('schedule') }}" id="schedule_nav"><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;&nbsp; Schedule Management</a>
        @endif
        @if(Auth::user()->utype == "Admin")
            <a href="{{ url('report') }}" id="report"><span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp;&nbsp; Report Management</a>
            <a href="{{URL('setting')}}" id="system"><span class="glyphicon glyphicon-cog"></span>&nbsp;&nbsp;&nbsp; System Setting</a>
        @endif
        <a href="{{ url('/logout') }}" id="log_out"><span></span>&nbsp;&nbsp;&nbsp; Logout</a>
    </div>
    <div class="main-container">
        <div id="main">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- navigation script -->
    <script src="{{asset('js/nav.js')}}"></script>

</body>
</html>