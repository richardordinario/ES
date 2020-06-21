@extends('layouts.master')

@section('content')
<br>
    <h1 class="content-title"><span class="title-logo glyphicon glyphicon-picture"></span>&nbsp;&nbsp;ADMIN PROFILE</h1>
    <hr>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
        </div>
        <div class="col-md-1"></div>
    </div>

<script>
    function idleTimer() {
        var t;
        window.onmousemove = resetTimer;
        window.onmousedown = resetTimer;
        window.onclick = resetTimer;
        window.onscroll = resetTimer;
        window.onkeypress= resetTimer;

        function logout() {
            alert("Your are automatically logout from the session.");
            window.location.href = "/logout";
        }
        
        function resetTimer() {
            clearTimeout(t);
            t=setTimeout(logout, 60000);
        }
    }
    
    //idleTimer();
    
    // dashboard();
    
    // function dashboard() {
        
    //     document.getElementById("dashboard").style.fontWeight="600";  
    //     document.getElementById("dashboard").style.color="#777";         
    // }
</script>
@endsection