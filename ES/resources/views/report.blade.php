@extends('layouts.master')

@section('content')

@if(Auth::user()->utype == "Admin")
@else
    <script>window.location="/404"</script>
@endif

<style>
    #prev-container {
        display: none;
        padding:10px;
        margin-bottom: 5px;
    }
    .close {
        float: right;
        margin-top: -40px;
        color: #000;
    }
    /* table#preview-table {
        background-color: #f3f3f3;
        padding: 10px;
    } */
    #preview-table td, th {
       text-align: center;
    }
    .td1 {
        /* background-color:#786fa6; */
        background-color:#fff;
        color: #999;
        font-size: 14px;
        width:15%;
    }
    .td2 {
        /* background-color:#ff5252; */
        background-color:#fff;
        color: #999;
        font-size: 14px;
        width:15%;
    }
    .td3 {
        /* background-color:#ff793f; */
        background-color:#fff;
        color: #999;
        font-size: 14px;
        width:15%;
    }
    .td4 {
        /* background-color:#1abc9c; */
        background-color:#fff;
        color: #999;
        font-size: 14px;
        width:15%;
    }
    .td5 {
        /* background-color:#2ecc71; */
        background-color:#fff;
        color: #999;
        font-size: 14px;
        width:15%;
    }
    .sth {
        background-color:#34495e;
        color: #f3f3f3;
        font-weight: 500;
        font-size: 14px;
    }
    .btmTh {
        background-color:#34495e;
        color: #f3f3f3;
        font-weight: 500;
        font-size: 12px;
        height: 2%;
    }
</style>
<br>
    <h1 class="content-title"><span class="title-logo glyphicon glyphicon-print"></span>&nbsp;&nbsp;REPORT MANAGEMENT</h1>
    <hr>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading" style="color:#777;font-weight:600;font-size: 14px">FILTER OPTION</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="" class="labels">Semester</label><span class="required-logo">&#42;</span>
                            <select name="sem" id="sem" class="form-control form-control-md" required style="color:#888">
                                <option  value="" >Semester</option>
                                <option value="1st Semester">1st Semester</option>
                                <option value="2nd Semester">2nd Semester</option>            
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <label for="" class="labels">School Year</label><span class="required-logo">&#42;</span>
                            <select name="sy" id="sy" class="form-control form-control-md" required style="color:#888">
                                <option value="">School Year</option>
                                @foreach($sys as $sy)
                                    <option value="{{ $sy->sy }}">{{ $sy->sy }}</option>
                                @endforeach          
                            </select>
                        </div>
                      
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-success btn-sm" id="filter-btn" style="margin-top: 30px;margin-right: 5px;">
                                Search
                            </button> 
                            <button type="button" class="btn btn-primary btn-sm" id="refresh-btn" style="margin-top: 30px;">
                                Refresh
                            </button> 
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
        <div class="col-sm-3"></div>
    </div>

    <div class="row" style="padding: 10px">
        <div class="col-md-12">
        <span id="rate-result"></span>
            <div class="table-responsive">
                <table id="schedule-table" class="table" style="text-align:center;">
                    <thead>
                        <tr>
                            <!-- <th class="table-header" width="1%">Status</th> -->
                            <th class="table-header" width="1%"></th>
                            <th class="table-header">Name</th>
                            <th class="table-header">Semester</th>
                            <th class="table-header">School Year</th>
                            <th class="table-header">Year Level</th>
                            <th class="table-header" width="1%">Section</th>
                            <th class="table-header">Subject</th>
                            <th class="table-header">Course</th>
                            
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="row" id="prev-container">
        <div class="col-md-10">
            <h1 style="color: #666;font-size: 30px;font-weight:600;">Preview</h1>
            <button type="button" class="close">&times;</button>
            <br>
           <span id="preview-table"></span>
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
    
    report();
    function report() {
        document.getElementById("report").style.fontWeight="600";  
        document.getElementById("report").style.color="#777";         
    }
  
    $(document).ready(function() {
        let prev = 0;

        $("#schedule-table").DataTable().destroy();
        load_data();

        function load_data(sem = '', sy = '')
        {
            $("#schedule-table").DataTable({
                processing: true,
                serverSide: true,
                paging:   false,
                ordering: false,
                info:     false,
                searching: false,
                scrollY: 265,
                scrollCollapse: true,
                ajax: {
                    url:'{{ route("report.index") }}',
                    data:{sem:sem, sy:sy}
                },
                columns: [
                    // {data:'status', name:'status',orderable: false},
                    {data:'action', name:'action', orderable: false}, 
                    {data:'name', name:'name',orderable: false},
                    {data:'sem', name:'sem', orderable: false},
                    {data:'sy', name:'sy', orderable: false},
                    {data:'ylevel', name:'ylevel', orderable: false},
                    {data:'section', name:'section', orderable: false},
                    {data:'scode', name:'scode', orderable: false},
                    {data:'ccode', name:'ccode', orderable: false},
                ],
            })
        }

        $("#filter-btn").click( function() {
            let = sem = $("#sem").val();
            let = sy = $("#sy").val();

            if(sem != "" && sy != "")
            {
                $("#schedule-table").DataTable().destroy();
                load_data(sem,sy);
            }
            else
            {
                alert('Please complete the field');
            }
        });

        $("#refresh-btn").click( function() {
            $("#sem").val('');
            $("#sy").val('');
            
            $('#prev-container').hide();
            $('.preview').css('cursor','pointer');
            $('#main').css('height','100%');
            prev = 0;

            $("#schedule-table").DataTable().destroy();
            load_data();
            
        });

        s
        $(document).on('click','.preview', function() {
            
            if(prev == 0) {
                $('.preview').css('cursor','no-drop');
                prev = 1;

                let pid = $(this).attr('id');
                
                $.ajax({
                    url:"{{ route('report.preview') }}",
                    method:'GET',
                    data:{pid:pid},
                    dataType:'json',
                    success:function(data)
                    {
                        if(data.table_data)
                        {
                            $('#prev-container').toggle();
                            $('#main').css('height','auto');
                            $('#preview-table').html(data.table_data);
                            $('html, body').animate({
                                scrollTop: $('#preview-table').offset().top
                            },1000);
                        }
                        if(data.error)
                        {
                            alert('No record found.');
                            $('#main').css('height','100%');
                            $('.preview').css('cursor','pointer');
                            prev = 0;
                        }   
                    }
                })
            }
        });
        
        $('.close').click(function() {
            $('#prev-container').toggle();
            $('.preview').css('cursor','pointer');
            $('#main').css('height','100%');
            prev = 0;
        });


    }); 

</script>
@endsection