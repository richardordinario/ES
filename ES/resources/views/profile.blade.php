@extends('layouts.master')

@section('content')
<style>
    .profile-data{
        font-size: 14px;
        font-weight:600;
        padding-left: 10px;
        margin-top: -5px;
        color: #666;
    }
    .table-header{
        font-size: 12px;
        font-weight:500;
        color: #888; 
        padding: 5px;
        text-align: center;
        background-color:#ccc;
        width:50px;
        border-radius: 40px;
    }
    .created {
        font-size: 11px;
        font-weight:500;
        color: #888;
        padding: 5px;
        background-color:#ccc;
        border-radius: 40px;
        width:120px;
        text-align: center;
    }
</style>
<br>
    <h1 class="content-title"><span class="title-logo glyphicon glyphicon-picture"></span>&nbsp;&nbsp;PROFILE</h1>
    <hr>
    <div class="row" style="padding:10px;">
        <div class="col-md-6">
           
            <div class="panel panel-default">
            @foreach($udatas as $udata)
                <div class="panel-heading" style="height: 50px;">
                    <h4 style="font-weight: 600;margin-top:5px;color:#777;font-size:14px;"><span class="title-logo glyphicon glyphicon-user"></span>&nbsp;&nbsp;STUDENT INFORMATION</h4>
                    <div align="right" style="margin-top:-31px;">
                        <p class="created"> Added {{ Carbon\Carbon::parse($udata->created_at)->diffForHumans() }}</p>
                    </div>
                </div>
                <div class="panel-body" style="padding: 20px;"> 
                    
                        <div class="row">
                            <div class="col-sm-5">
                                <center><img src="{{ URL::to('/') }}/images/{{$udata->image}}" class='img-circle' alt="" height="150" style="margin-bottom: 10px;opacity: 0.9;"></center>
                                <div align="center" style="margin-top: 10px;">
                                    
                                    <p class="table-header" style="width:100px;">
                                    <span style="font-size: 12px;font-weight:600;color: #888;">ID:</span>
                                        {{$udata->student_id}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-7">
         
                                
                                <div align="left" style="margin-top: 10px;">
                                    <p class="table-header">Name</p>
                                    @if($udata->mname != "")
                                        <p class="profile-data">{{$udata->fname . ' ' . $udata->mname  . ' ' . $udata->lname}}</p>
                                    @else
                                        <p  class="profile-data">{{$udata->fname . ' ' . $udata->lname}}</p>
                                    @endif
                                </div>
                                <div align="left" style="margin-top: 10px;">
                                    <p class="table-header">Course</p>
                                    <p class="profile-data">{{$course}}</p>
                                </div>
                                <div align="left" style="margin-top: 10px;">
                                    <p  class="table-header" style="width: auto;">Major in <span> {{$udata->major}}</span></p>
                                    <p class="profile-data"></p>
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
                <div class="panel-footer" style="height:10px;padding: 0"></div>
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
    
    //idleTimer();
    
    profile();
    
    function profile() {
        
        document.getElementById("profile_nav").style.fontWeight="600";  
        document.getElementById("profile_nav").style.color="#777";         
    }
</script>
@endsection