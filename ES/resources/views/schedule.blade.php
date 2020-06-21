@extends('layouts.master')

@section('content')
<br>
<div class="row">
    <div class="col-md-8">
        <h1 class="content-title"><span class="title-logo glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;SCHEDULE MANAGEMENT</h1>
    </div>
    <div class="col-md-4">
        <div align="right">
            <button type="button" class="btn btn-primary btn-md" id="schedule-btn" style="margin-top: 25px;margin-right: 10px">New Schedule</button> 
        </div>
    </div>
</div>
<hr>

<div class="row" style="padding: 10px">
    <div class="col-md-12">
        <div class="table-responsive">
            <table id="schedule-table" class="table">
                <thead>
                    <tr>
                        <th class="table-header" width="1%">Status</th>
                        <th class="table-header">Name</th>
                        <th class="table-header">Semester</th>
                        <th class="table-header">School Year</th>
                        <th class="table-header">Year Level</th>
                        <th class="table-header" width="1%">Section</th>
                        <th class="table-header">Subject</th>
                        <th class="table-header">Course</th>
                        <th class="table-header" width="1%"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div id="schedule-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
            <span id="form-result"></span>
            <form method="POST" id="schedule-form" enctype="multipart/form-data">
            @csrf 
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="" class="labels">Faculty Name:</label><span class="required-logo">&#42;</span>
                        <select name="uid" id="uid" class="form-control form-control-md" required>
                            <option value="">Faculty</option>
                            @foreach($facultys as $faculty)
                                @if($faculty->mname != "")
                                    <option value="{{ $faculty->id }}">{{ $faculty->fname . " " . $faculty->mname . " " . $faculty->lname}}</option>
                                @else
                                    <option value="{{ $faculty->id }}">{{ $faculty->fname .  " " . $faculty->lname}}</option>
                                @endif
                            @endforeach
                        </select>
                        <span class="scode_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                    </div>
                    <div class="col-sm-6"></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="" class="labels">School Year</label><span class="required-logo">&#42;</span>
                        
                        <input type="text" name="sy" id="sy" class="form-control form-control-md" value="{{ $sy }}" placeholder="School Year" autocomplete="off" required readonly>
                        <span class="sy_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                        
                    </div>
                    <div class="col-sm-6">
                        <label for="" class="labels">Semester</label><span class="required-logo">&#42;</span>
                        <select name="sem" id="sem" class="form-control form-control-md" required>
                            <option value="">Semester</option>
                            <option value="1st Semester">1st Semester</option>
                            <option value="2nd Semester">2nd Semester</option>            
                        </select>
                        <span class="sem_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="" class="labels">Subject:</label><span class="required-logo">&#42;</span>
                        <select name="scode" id="scode" class="form-control form-control-md" required>
                            <option value="">Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->subject_code }}">{{ $subject->subject_desc }}</option>
                            @endforeach
                        </select>
                        <span class="scode_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                    </div>
                    <div class="col-sm-6">
                        <label for="" class="labels">Course:</label><span class="required-logo">&#42;</span>
                        <select name="ccode" id="ccode" class="form-control form-control-md" required>
                            <option value="">Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->course_code }}">{{ $course->course_desc }}</option>
                            @endforeach
                        </select>
                        <span class="ccode_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="" class="labels">Year Level</label><span class="required-logo">&#42;</span>
                        <select name="ylevel" id="ylevel" class="form-control form-control-md" required>
                            <option value="">Year Level</option>
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>  
                            <option value="3rd Year">3rd Year</option>  
                            <option value="4th Year">4th Year</option>            
                        </select>
                        <span class="ylevel_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                    </div>
                    <div class="col-sm-6">
                        <label for="" class="labels">Section</label><span class="required-logo">&#42;</span>
                        <input type="text" name="section" id="section" class="form-control form-control-md" placeholder="Section" autocomplete="off" required>
                        <span class="section_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="hidden_id" id="hidden_id">
            <span class="sched_err" style="font-size:12px;color:#c0392b;padding-right: 10px;font-weight: 600;"></span>
            <input type="submit" class="btn btn-success" value="Save" name="btn_action" id="action">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
        </form>
    </div>
    </div>
</div>

<div id="confirmedModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirmation</h4>
      </div>
      <div class="modal-body">
        <h4 align="center" style="margin:0;" id="confirm-text"></h4>
        <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" name="btn_ok" id="btn_ok">Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
      </div>
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
    
    dashboard();
    
    function dashboard() {
        
        document.getElementById("schedule_nav").style.fontWeight="600";  
        document.getElementById("schedule_nav").style.color="#777";         
    }

    $(document).ready(function() {
        $("#schedule-table").DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "{{ route('schedule.index') }}",
            },
            columns: [
                {data:'status', name:'status',orderable: false},
                {data:'name', name:'name',orderable: false},
                {data:'sem', name:'sem', orderable: false},
                {data:'sy', name:'sy', orderable: false},
                {data:'ylevel', name:'ylevel', orderable: false},
                {data:'section', name:'section', orderable: false},
                {data:'scode', name:'scode', orderable: false},
                {data:'ccode', name:'ccode', orderable: false},
                {data:'action', name:'action', orderable: false}, 
            ],
            columnDefs: [

                {
                    "targets": 0,
                    "createdCell": function(td, cellData, rowData, row, col)
                    {
                        if(cellData == "Active"){
                            $(td).css('color','#27ae60')
                            //$(td).css('text-decoration','underline')
                            // $(td).css('padding', '20px')
                            //$(td).css('background-color','#27ae60')
                            $(td).css('font-size','14px')
                            $(td).css('font-weight','500')

                            // $(td).css('font-style','italic')
                        }else{
                
                            $(td).css('color','#c0392b')
                            //$(td).css('text-decoration','underline')
                            // $(td).css('padding', '20px')
                            //$(td).css('background-color','#27ae60')
                            $(td).css('font-size','14px')
                            $(td).css('font-weight','500')
                            // $(td).css('font-style','italic')
                        }
                    },
                },
                
                {
                    "targets": 1,
                    "createdCell": function(td, cellData, rowData, row, col)
                    {
                        $(td).css('color','#666')
                        $(td).css('font-size','14px')
                        $(td).css('font-style','italic')
                    },
                },
                {
                    "targets": 6,
                    "createdCell": function(td, cellData, rowData, row, col)
                    {
                        $(td).css('color','#666')
                        $(td).css('font-size','14px')
                        $(td).css('font-style','italic')
                    },
                },
                {
                    "targets": 7,
                    "createdCell": function(td, cellData, rowData, row, col)
                    {
                        $(td).css('color','#666')
                        $(td).css('font-size','14px')
                        $(td).css('font-style','italic')
                    },
                },
            ],
            "rowCallback": function( row, data, index) {
                if(data["status"] == "Active"){
                    $('td', row).css('background-color', '#fff !important');
                }else {
                    //$('td', row).css('border-bottom', '1px solid rgba(192, 57, 43, 0.9)');
                    $('td', row).css('color', '#999');
                }
            }
        });

        $("#schedule-btn").click(function() {
            $(".modal-title").html("NEW SCHEDULE");
            $("#form-result").html("");
            $("#action").val("Save");
       
            $("#schedule-form")[0].reset();
            //$("#scode").prop('readonly', false);
            $("#schedule-modal").modal({backdrop: 'static', keyboard: false});
        });

        $("#schedule-form").on('submit', function(e) {
            e.preventDefault();
            if($("#action").val()=="Save")
            {
                $.ajax({
                    url: "{{ route('schedule.store') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    beforeSend:function(){
                        $("#action").val('Saving...');
                    },
                    success:function(data)
                    {
                        var html='';
                        if(data.errors)
                        {
                            for(var count = 0; count < data.errors.length; count++)
                            {
                                if(data.errors[count] == "Schedule already exist.")
                                {
                                    $(".sched_err").html(data.errors[count]);
                                }
                            }
                        }
                        if(data.success)
                        {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $("#schedule-form")[0].reset();
                            $("#schedule-table").DataTable().ajax.reload();
                            $("#form-result").html(html);
                        }

                        $("#action").val('Save');
                    
                        setTimeout( function() {
                            $(".sched_err").html('');
                            $("#form-result").html('');
                        }, 2000);

                    }
                });
            }

            if($("#action").val()=="Update")
            {
                $.ajax({
                    url: "{{ route('schedule.update') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    beforeSend:function(){
                        $("#action").val('Updating...');
                    },
                    success:function(data)
                    {
                        var html='';
                        if(data.errors)
                        {
                            for(var count = 0; count < data.errors.length; count++)
                            {
                                if(data.errors[count] == "Schedule already exist.")
                                {
                                    $(".sched_err").html(data.errors[count]);
                                }
                            }
                            $("#action").val('Update');
                            setTimeout( function() {
                                $(".sched_err").html('');
                                $("#form-result").html('');
                            }, 2000);
                        }
                        if(data.success)
                        {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $("#schedule-form")[0].reset();
                            $("#schedule-table").DataTable().ajax.reload();
                            $("#form-result").html(html);
                            $("#action").val('Updated');
                            setTimeout( function() {
                                $(".sched_err").html('');
                                $("#form-result").html('');
                                $("#schedule-modal").modal('hide');
                            }, 2000);
                        }
                    }
                });
            }
        });

        $(document).on("click", ".edit", function(){
            var id = $(this).attr('id');
            $("#form-result").html("");
            $(".modal-title").text("UPDATE SCHEDULE");
            $("#schedule-form")[0].reset();
            $.ajax({
                url:"/schedule/edit/"+id,    
                dataType:"json",
                success:function(html)
                {
                    $("#hidden_id").val(html.data.id);
                    $("#uid").val(html.data.uid);
                    $("#sem").val(html.data.sem);
                    $("#sy").val(html.data.sy);
                    $("#ylevel").val(html.data.ylevel);
                    $("#section").val(html.data.section);
                    $("#scode").val(html.data.scode);
                    $("#ccode").val(html.data.ccode);
                    $("#action").val("Update");
                    $("#schedule-modal").modal({backdrop: 'static', keyboard: false});
                }
            })
        });

        var user_id;
        $(document).on('click','.delete', function(){
            user_id = $(this).attr('id');
            $('.modal-title').html("Confirmation");
            $("#confirm-text").text("Are you sure you want to remove this data?");
            $("#btn_ok").text("Yes");
            $("#confirmedModal").modal({backdrop: 'static', keyboard: false});
        });
        
        $("#btn_ok").click(function(){
            $.ajax({
                url:"schedule/destroy/"+user_id,
                beforeSend:function(){
                    $("#btn_ok").text('Deleting...');
                },
                success:function(data)
                {   
                    $("#btn_ok").text('Deleted');
                    setTimeout(function(){
                        $("#confirmedModal").modal('hide');
                        $("#schedule-table").DataTable().ajax.reload();
                    },1000);
                }
            });
        });

    });

</script>
@endsection