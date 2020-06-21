<!DOCTYPE html>
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
    <title>Evaluation System</title>
</head>
<style>
    .row { margin-top: 100px; }
    body {background-color: #f1f2f6}
    * {font-family: 'Source Sans Pro', sans-serif;color:#888;}
    .login-title h1{
        font-family: 'Arial', sans-serif;
        font-size: 20px;
        font-weight: 500;
        margin-bottom:20px;
        color: #777;
    }
    .logo-2{
        position: absolute;
        margin-top: 28px;
        float: left;
    }
    .logo-3{
        display:none;
        position: absolute;

    }
   
    /* @media screen and (max-width:768px) {
        .logo-2{display:none}
        .logo-3{display:block; margin-left: 15px;}
        .form-container{margin-left: 0px;padding-right:15px;}
        form{margin-top: 10px;}
        .login-title h1{text-align: center;font-size: 45px; margin-left: 65px;}
    } */
</style>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <!-- <div class="logo-2"><img src="{{URL::asset('/images/logo-2.png')}}" alt="logo"></div> -->
            <div class="form-container">
                <div class="login-title">
                    <!-- <span class="logo-3"><img src="{{URL::asset('/images/logo-2.png')}}" alt="logo" height="100"></span> -->
                    <h1>EVALUATION  SYSTEM</h1>
                </div>
                @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <form method="POST" action="{{ url('/login/checklogin') }}">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="usr" style="font-weight:500">Username</label>
                        <input type="text" class="form-control" id="user" name="user" placeholder="Username" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label style="font-weight:500" for="pwd">Password</label>
                        <input type="password" class="form-control" id="pwd" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <div align="left">
                            <input type="submit" class="btn btn-primary" id="btn_submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>

</body>
</html>
