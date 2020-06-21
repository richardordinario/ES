@extends('layouts.master')
@section('content')
<style>
    .img{align-items: center}
</style>
<br>
<div class="row">
    <div class="col-md-8">
        <h1 class="content-title"><span class="title-logo glyphicon glyphicon-user"></span>&nbsp;&nbsp;STUDENT MANAGEMENT</h1>
    </div>
    <div class="col-md-4">
        <div align="right">
            <button type="button" class="btn btn-primary btn-md" id="student-btn" style="margin-top: 25px">New Student</button>
            <a href="{{ url('studentPdf/pdf') }}" class="btn btn-default btn-md" id="none" style="margin-top: 25px;margin-right: 10px">PDF</a>
        </div>
    </div>
</div>
<hr>

<div class="row" style="padding: 10px">
    <div class="col-md-12">
        <div class="table-responsive">
            <table id="student-table" class="table">
                <thead>
                    <tr>
                        <th width="1%" class="table-header">Image</th>
                        <th width="10%" class="table-header">Student ID</th>
                        <th class="table-header">First Name</th>
                        <th class="table-header">Last Name</th>
                        <th class="table-header">Middle Name</th>
                        <th class="table-header">Course</th>
                        <th class="table-header">Major</th>
                        <th class="table-header" width="1%"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div id="student-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
            <span id="form-result"></span>
            <form method="POST" id="student-form" enctype="multipart/form-data">
            @csrf 
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="" class="labels">Student Number:</label><span class="required-logo">&#42;</span>
                        <input type="text" name="studid" id="studid" class="form-control form-control-md" placeholder="Student number" autocomplete="off" required>
                        <span class="id_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                    </div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"></div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                        <label for="" class="labels">First Name:</label><span class="required-logo">&#42;</span>
                        <input type="text" name="fname" id="fname" class="form-control form-control-md" placeholder="First name" autocomplete="off" required>
                        <span class="fname_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                    </div>
                    <div class="col-sm-4">
                        <label for="" class="labels">Last Name:</label><span class="required-logo">&#42;</span>
                        <input type="text" name="lname" id="lname" class="form-control form-control-md" placeholder="Last name" autocomplete="off" required>
                        <span class="lname_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                    </div>
                    <div class="col-sm-4">
                        <label for="" class="labels">Middle Name:</label><span class="required-logo" style="color:#fff;">&#42;</span>
                        <input type="text" name="mname" id="mname" class="form-control form-control-md" placeholder="Middle name" autocomplete="off">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="" class="labels">Course:</label><span class="required-logo">&#42;</span>
                        <select name="course" id="course" class="form-control form-control-md" required>
                        <option value="">Course code</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->course_code }}">{{ $course->course_code }}</option>
                            @endforeach
                            
                        </select>
                        <span class="course_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="labels">Major:</label><span class="required-logo">&#42;</span>
                        <input type="text" name="major" id="major" class="form-control form-control-md" placeholder="Major" autocomplete="off" required>
                        <span class="major_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="" class="labels">Picture:</label><span class="required-logo">&#42;</span>
                        <input type="file" name="image" id="image" class="btn-type">
                        <span class="image_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                    </div>
                    <div class="col-md-6" align="right">
                        <span id="store-image" style="margin-top: 10px"></span>
                    </div>
                    
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
        <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
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
student();
function student() {
    document.getElementById("btn-caret").style.display="none";
    document.getElementById("down-caret").style.display="block";
    document.getElementById("content-stud").style.display="block";
    document.getElementById("content-stud").style.fontWeight="600";
    document.getElementById("content-stud").style.color="#777";  
    document.getElementById("content-prof").style.display="block";           
}

function preventNumberInput(e){
    var keyCode = (e.keyCode ? e.keyCode : e.which);
    if (keyCode > 47 && keyCode < 58){
        e.preventDefault();
    }
}

$(document).ready(function(){

    $("#student-table").DataTable({
        processing: true,
        serverSide: true,
        ajax:{
            url: "{{ route('students.index') }}",
        },
        columns: [
            {   data:'image', name:'image', orderable: false, 
                render: function(data, type, full, meta) { return "<img src={{ URL::to('/') }}/images/" + data + " width= '20' class='img-circle' />"; }, 
            },
            {data:'student_id', name:'student_id',orderable: false},
            {data:'fname', name:'fname', orderable: false},
            {data:'lname', name:'lname', orderable: false},
            {data:'mname', name:'mname', orderable: false},
            {data:'course', name:'course',orderable: false},
            {data:'major', name:'major', orderable: false},
            {data:'action', name:'action', orderable: false}, 
        ],
        columnDefs: [
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
                "targets": 4,
                "createdCell": function(td, cellData, rowData, row, col)
                {
                    if(cellData!=""){}
                    else{
                        $(td).text('Null')
                        $(td).css('color','#999')
                        $(td).css('font-size','14px')
                        $(td).css('font-style','italic')
                    }
                },
            },
        ],
    });
    
    $("#student-btn").click( function() {
        $(".modal-title").html("REGISTER STUDENT");
        $("#form-result").html("");
        $("#action").val("Save");
        $("#store-image").html('');
        $("#studid").prop('readonly', false);
        $("#student-form")[0].reset();
        $("#student-modal").modal({backdrop: 'static', keyboard: false});
    });

    $("#student-form").on("submit", function(event){
        event.preventDefault();
        if($("#action").val()=="Save")
        {
            $.ajax({
                url: "{{ route('students.store') }}",
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
                            if(data.errors[count] == "Student number already used.")
                            {
                                $("#studid").css('border-color', '#c0392b');
                                $(".id_err").html(data.errors[count]);
                            }
                            if(data.errors[count] == "Invalid id number.")
                            {
                                $("#studid").css('border-color', '#c0392b');
                                $(".id_err").html(data.errors[count]);
                            }
                            if(data.errors[count] == "firstname")
                            {
                                $("#fname").css('border-color', '#c0392b');
                                $(".fname_err").html('Invalid firstname.');
                            }
                            if(data.errors[count]=="lname")
                            {
                                $("#lname").css('border-color', '#c0392b');
                                $(".lname_err").html('Invalid lastname.');
                            }
                            if(data.errors[count]=="course")
                            {
                                $("#course").css('border-color', '#c0392b');
                                $(".course_err").html('Course is required.');
                            }
                            if(data.errors[count]=="major")
                            {
                                $("#major").css('border-color', '#c0392b');
                                $(".major_err").html('Invalid major.');
                            }
                            if(data.errors[count]=="img")
                            {
                                // $("#image").css('border-color', '#c0392b');
                                $(".image_err").html('Invalid file size.');
                            }
                            if(data.errors[count]=="img-req")
                            {
                                // $("#image").css('border-color', '#c0392b');
                                $(".image_err").html('Picture is required.');
                            }
                        }
                    }
                    if(data.success)
                    {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $("#student-form")[0].reset();
                        $("#student-table").DataTable().ajax.reload();
                        $("#form-result").html(html);
                    }
                    
                    $("#action").val('Save');
                    
                    setTimeout( function() {
                        $("#studid").css('border-color', '#ccc');
                        $(".id_err").html('');
                        $("#fname").css('border-color', '#ccc');
                        $(".fname_err").html('');
                        $("#lname").css('border-color', '#ccc');
                        $(".lname_err").html('');
                        $("#course").css('border-color', '#ccc');
                        $(".course_err").html('');
                        $("#major").css('border-color', '#ccc');
                        $(".major_err").html('');
                        
                        $(".image_err").html('');
                        $("#form-result").html('');
                    }, 2000);
                    
                    
                }
            })
        }
        if($("#action").val()=="Update")
        {
            $.ajax({
                url: "{{ route('students.update') }}",
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
                            if(data.errors[count] == "firstname")
                            {
                                $("#fname").css('border-color', '#c0392b');
                                $(".fname_err").html('Invalid input firstname.');
                            }
                            if(data.errors[count]=="lname")
                            {
                                $("#lname").css('border-color', '#c0392b');
                                $(".lname_err").html('Invalid input lastname.');
                            }
                            if(data.errors[count]=="course")
                            {
                                $("#course").css('border-color', '#c0392b');
                                $(".course_err").html('Course is required.');
                            }
                            if(data.errors[count]=="major")
                            {
                                $("#major").css('border-color', '#c0392b');
                                $(".major_err").html('Invalid input major.');
                            }
                            if(data.errors[count]=="img")
                            {
                                // $("#image").css('border-color', '#c0392b');
                                $(".image_err").html('Invalid file size.');
                            }
                        }
                        
                        setTimeout( function() {
                        $("#studid").css('border-color', '#ccc');
                        $(".id_err").html('');
                        $("#fname").css('border-color', '#ccc');
                        $(".fname_err").html('');
                        $("#lname").css('border-color', '#ccc');
                        $(".lname_err").html('');
                        $("#course").css('border-color', '#ccc');
                        $(".course_err").html('');
                        $("#major").css('border-color', '#ccc');
                        $(".major_err").html('');
                        
                        $(".image_err").html('');
                        $("#form-result").html('');
                        $("#action").val('Update');
                    }, 2000);
                    }
                    if(data.success)
                    {
                        $("#form-result").html('<div class="alert alert-success">' + data.success + '</div>');
                        $("#student-form")[0].reset();
                        $("#store-image").html('');
                        $("#student-table").DataTable().ajax.reload();
                        $("#action").val('Updated');
                        //$("#student-modal").modal('hide');
                        setTimeout(function(){
                            $("#student-modal").modal('hide');
                        },1000);
                    }
                }
            })
        }
    });

    $(document).on("click", ".edit", function(){
        var id = $(this).attr('id');
        $("#form-result").html("");
        $(".modal-title").text("UPDATE STUDENT");
        $("#student-form")[0].reset();
        $.ajax({
            url:"/students/"+id+"/edit",
            dataType:"json",
            success:function(html)
            {
                $("#hidden_id").val(html.data.id);
                $("#studid").val(html.data.student_id);
                $("#studid").prop('readonly', true);
                $("#fname").val(html.data.fname);
                $("#lname").val(html.data.lname);
                $("#mname").val(html.data.mname);
                $("#course").val(html.data.course);
                $("#major").val(html.data.major);
                // "<img src={{ URL::to('/') }}/ images/" + html.data.image + " width='70' class='img-thumbnail' />"
                
                $("#store-image").html("<img src={{ URL::to('/') }}/images/"+html.data.image+" width='150' class='img-thumbnail'/>");
                $("#store-image").append("<input type='hidden' name='hidden_image' value='"+html.data.image+"'/>");
                $("#action").val("Update");
                $("#student-modal").modal({backdrop: 'static', keyboard: false});
            }
        })
    });

    var user_id;
    $(document).on('click','.delete', function(){
        user_id = $(this).attr('id');
        $('.modal-title').html("Confirmation");
        $("#btn_ok").text("Yes");
        $("#confirmedModal").modal({backdrop: 'static', keyboard: false});
    });
    
    $("#btn_ok").click(function(){
        $.ajax({
            url:"students/destroy/"+user_id,
            beforeSend:function(){
                $("#btn_ok").text('Deleting...');
            },
            success:function(data)
            {   
                $("#btn_ok").text('Deleted');
                setTimeout(function(){
                    $("#confirmedModal").modal('hide');
                    $("#student-table").DataTable().ajax.reload();
                },1000);
            }
        })
    });

    $('#fname').keypress(function(e) { preventNumberInput(e); });
    $('#lname').keypress(function(e) { preventNumberInput(e); });
    $('#mname').keypress(function(e) { preventNumberInput(e); });
    $('#major').keypress(function(e) { preventNumberInput(e); });
});
</script>
@endsection