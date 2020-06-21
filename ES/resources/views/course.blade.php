@extends('layouts.master')

@section('content')

<br>
<div class="row">
    <div class="col-md-8">
        <h1 class="content-title"><span class="title-logo glyphicon glyphicon-education"></span>&nbsp;&nbsp;COURSE MANAGEMENT</h1>
    </div>
    <div class="col-md-4">
        <div align="right">
            <button type="button" class="btn btn-primary btn-md" id="course-btn" style="margin-top: 25px">New Course</button>
        </div>
    </div>
</div>
<hr>
<div class="row" style="padding: 10px">
    <div class="col-md-12">
        <div class="table-responsive">
            <table id="course-table" class="table">
                <thead>
                    <tr>
                        <th class="table-header">Course Code</th>
                        <th class="table-header">Course Description</th>
                        <th class="table-header" width="1%"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div id="course-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
            <span id="form-result"></span>
            <form method="POST" id="course-form" enctype="multipart/form-data">
            @csrf 
                <div class="form-group">
                    <label for="" class="labels">Course Code:</label><span class="required-logo">&#42;</span>
                    <input type="text" name="ccode" id="ccode" class="form-control form-control-md" placeholder="Course Code" autocomplete="off" required>
                    <span class="ccode_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                </div>
                <div class="form-group">
                    <label for="" class="labels">Course Description:</label><span class="required-logo">&#42;</span>
                    <input type="text" name="cdesc" id="cdesc" class="form-control form-control-md" placeholder="Course Description" autocomplete="off" required>
                    <span class="cdesc_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="hidden_id" id="hidden_id">
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

    idleTimer();

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
        
    course();
    
    function course() {
        
        document.getElementById("course_nav").style.fontWeight="600";  
        document.getElementById("course_nav").style.color="#777";         
    }

    $(document).ready(function(){

        $("#course-table").DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "{{ route('course.index') }}",
            },
            columns: [
                {data:'course_code', name:'course_code',orderable: false},
                {data:'course_desc', name:'course_desc', orderable: false},
                {data:'action', name:'action', orderable: false}, 
            ],
            columnDefs: [{
                "targets": 0,
                "createdCell": function(td, cellData, rowData, row, col)
                {
                    $(td).css('color','#666')
                    $(td).css('font-size','14px')
                    $(td).css('font-style','italic')
                },
            }],
        });

        $("#course-btn").click( function() {
            $(".modal-title").html("NEW COURSE");
            $("#form-result").html("");
            $("#action").val("Save");
            //$("#store-image").html('');
            //$("#studid").prop('readonly', false);
            $("#course-form")[0].reset();
            $("#ccode").prop('readonly', false);
            $("#course-modal").modal({backdrop: 'static', keyboard: false});
        });

        $("#course-form").on('submit', function(e) {
            e.preventDefault();
            if($("#action").val() == "Save")
            {
                $.ajax({
                    url: "{{ route('course.store') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    beforeSend:function(){
                        $("#action").val('Saving...');
                    },
                    success:function(data){
                        var html='';
                        if(data.errors)
                        {
                            for(var count = 0; count < data.errors.length; count++)
                            {
                                if(data.errors[count] == "Invalid id course code.")
                                {
                                    $("#ccode").css('border-color', '#c0392b');
                                    $(".ccode_err").html('Invalid course code.');
                                }
                                if(data.errors[count] == "Course code already used.")
                                {
                                    $("#ccode").css('border-color', '#c0392b');
                                    $(".ccode_err").html(data.errors[count]);
                                }

                                if(data.errors[count] == "code")
                                {
                                    $("#ccode").css('border-color', '#c0392b');
                                    $(".ccode_err").html('Invalid course code.');
                                }
                                if(data.errors[count] == "cdesc")
                                {
                                    $("#cdesc").css('border-color', '#c0392b');
                                    $(".cdesc_err").html('Invalid course description.');
                                }
                            }
                        }
                        if(data.success)
                        {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $("#course-form")[0].reset();
                            $("#course-table").DataTable().ajax.reload();
                            $("#form-result").html(html);
                        }
                        $("#action").val('Save');
                    
                        setTimeout( function() {
                            $("#ccode").css('border-color', '#ccc');
                            $(".ccode_err").html('');
                            $("#cdesc").css('border-color', '#ccc');
                            $(".cdesc_err").html('');
                            $("#form-result").html('');
                        }, 2000);
                    }
                });
            }
            if($("#action").val() == "Update")
            {
                $.ajax({
                    url: "{{ route('course.update') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    beforeSend:function(){
                        $("#action").val('Updating...');
                    },
                    success:function(data){
                        var html='';
                        if(data.errors)
                        {
                            for(var count = 0; count < data.errors.length; count++)
                            {
                                if(data.errors[count] == "cdesc")
                                {
                                    $("#cdesc").css('border-color', '#c0392b');
                                    $(".cdesc_err").html('Invalid course description.');
                                }
                            }
                            setTimeout( function() {
                                $("#ccode").css('border-color', '#ccc');
                                $(".ccode_err").html('');
                                $("#cdesc").css('border-color', '#ccc');
                                $(".cdesc_err").html('');
                                $("#form-result").html('');
                                $("#action").val('Update');
                            }, 2000);
                        }
                        if(data.success)
                        {
                            $("#form-result").html('<div class="alert alert-success">' + data.success + '</div>');
                            $("#course-form")[0].reset();
                            $("#course-table").DataTable().ajax.reload();
                            $("#action").val('Updated');
                            setTimeout(function(){
                                $("#course-modal").modal('hide');
                            },1000);
                        }    
                    }
                });
            }
        })
    $(document).on("click", ".edit", function(){
        var id = $(this).attr('id');
        $("#form-result").html("");
        $(".modal-title").text("UPDATE COURSE");
        $("#course-form")[0].reset();
        $.ajax({
            url:"/course/edit/"+id,
            dataType:"json",
            success:function(html)
            {
                $("#hidden_id").val(html.data.id);
                $("#ccode").val(html.data.course_code);
                $("#ccode").prop('readonly', true);
                $("#cdesc").val(html.data.course_desc);
                
                $("#action").val("Update");
                $("#course-modal").modal({backdrop: 'static', keyboard: false});
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
            url:"course/destroy/"+user_id,
            beforeSend:function(){
                $("#btn_ok").text('Deleting...');
            },
            success:function(data)
            {   
                $("#btn_ok").text('Deleted');
                setTimeout(function(){
                    $("#confirmedModal").modal('hide');
                    $("#course-table").DataTable().ajax.reload();
                },1000);
            }
        });
    })

    });
</script>
@endsection