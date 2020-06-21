@extends('layouts.master')

@section('content')
<style>
    #stud {
        background-color:#16a085;
    }
    #sub {
        background-color:#27ae60;
    }
    #cor {
        background-color: #e67e22;
    }
    #prof {
        background-color: #8e44ad;
    }
    .p-top {
        color: #F5F5F5;
        margin-top: -10px;
        font-size: 12px;
    }
    .count {
        color: #f5f5f5;
        font-size: 45px;
        font-weight: 600;
        margin-top: -10px;
    }
    .p-bottom {
        color: #F5F5F5;
        margin-top: -10px;
        margin-bottom: -10px;
        font-size: 12px;
    }
</style>
<br>
    <h1 class="content-title"><span class="title-logo glyphicon glyphicon-stats"></span>&nbsp;&nbsp;DASHBOARD</h1>
    <hr>
    <div class="row">
        <div class="col-md-3">
            <div class="well" id="stud">
                <p align="center" class="p-top">NUMBER OF STUDENTS</p>
                <p align="center" class="count">{{ $studentCount }}</p>
                <p align="center" class="p-bottom">TOTAL COUNT IN THE SYSTEM</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="well" id="sub">
                <p align="center" class="p-top">NUMBER OF SUBJECTS</p>
                <p align="center" class="count">{{ $subjectCount }}</p>
                <p align="center" class="p-bottom">TOTAL COUNT IN THE SYSTEM</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="well" id="cor">
                <p align="center" class="p-top">NUMBER OF COURSES</p>
                <p align="center" class="count">{{ $courseCount }}</p>
                <p align="center" class="p-bottom">TOTAL COUNT IN THE SYSTEM</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="well" id="prof">
                <p align="center" class="p-top">NUMBER OF FACULTYS</p>
                <p align="center" class="count">{{ $facultyCount }}</p>
                <p align="center" class="p-bottom">TOTAL COUNT IN THE SYSTEM</p>
            </div>
        </div>
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
    
    idleTimer();
    
    dashboard();
    
    function dashboard() {
        
        document.getElementById("dashboard").style.fontWeight="600";  
        document.getElementById("dashboard").style.color="#777";         
    }

    

</script>
@endsection