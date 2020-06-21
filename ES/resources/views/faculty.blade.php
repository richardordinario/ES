@extends('layouts.master')

@section('content')
<br>
<div class="row">
    <div class="col-md-8">
        <h1 class="content-title"><span class="title-logo glyphicon glyphicon-user"></span>&nbsp;&nbsp;FACULTY MANAGEMENT</h1>
    </div>
    <div class="col-md-4">
        <div align="right">
            <button type="button" class="btn btn-primary btn-md" id="faculty-btn" style="margin-top: 25px;margin-right: 10px">New Faculty</button> 
        </div>
    </div>
</div>
<hr>

<div class="row" style="padding: 10px">
    <div class="col-md-12">
        <div class="table-responsive">
            <table id="faculty-table" class="table">
                <thead>
                    <tr>
                        <th width="1%" class="table-header">Image</th>
                        <th width="10%" class="table-header">Position</th>
                        <th class="table-header">Firstname</th>
                        <th class="table-header">Lastname</th>
                        <th class="table-header">Middlename</th>
                        <th width="15%"class="table-header">Contact Number</th>
                        <th class="table-header" width="1%"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div id="faculty-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
            <span id="form-result"></span>
            <form method="POST" id="faculty-form" enctype="multipart/form-data">
            @csrf 
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="" class="labels">Position:</label><span class="required-logo">&#42;</span>
                        <select name="position" id="position" class="form-control form-control-md" required>
                        <option value="">Position</option>
                            @foreach($positions as $position)
                                <option value="{{ $position->position }}">{{ $position->position }}</option>
                            @endforeach
                        </select>
                        <span class="position_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="labels">Contact Number:</label><span class="required-logo">&#42;</span>
                        <input type="text" name="contact" id="contact" class="form-control form-control-md" placeholder="Contact number" autocomplete="off" required>
                        <span class="contact_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                    </div>
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
            <span class="acc_err" style="font-size:12px;color:#c0392b;font-weight: 600;padding-right: 10px;"></span>
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
    faculty();
    function faculty() {
        document.getElementById("btn-caret").style.display="none";
        document.getElementById("down-caret").style.display="block";
        document.getElementById("content-stud").style.display="block";
        document.getElementById("content-prof").style.display="block";   
        document.getElementById("content-prof").style.fontWeight="600";
        document.getElementById("content-prof").style.color="#777"; 
    }
    $(document).ready(function() {

        $("#faculty-btn").click( function() {
            $(".modal-title").html("REGISTER FACULTY");
            $("#form-result").html("");
            $("#action").val("Save");
            $("#store-image").html('');
            $("#faculty-form")[0].reset();
            $("#faculty-modal").modal({backdrop: 'static', keyboard: false});
        });

        $("#faculty-table").DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "{{ route('faculty.index') }}",
            },
            columns: [
                {   data:'image', name:'image', orderable: false, 
                    render: function(data, type, full, meta) { return "<img src={{ URL::to('/') }}/images/" + data + " width= '20' class='img-circle' />"; }, 
                },
                {data:'position', name:'position',orderable: false},
                {data:'fname', name:'fname', orderable: false},
                {data:'lname', name:'lname', orderable: false},
                {data:'mname', name:'mname', orderable: false},
            
                {data:'contact', name:'contact',orderable: false},
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
                        if(cellData != ""){ }
                        else
                        {
                            $(td).text('Null')
                            $(td).css('color','#999')
                            $(td).css('font-size','14px')
                            $(td).css('font-style','italic')
                        }
                    },
                }
            ],
        });

        $("#faculty-form").on("submit", function(event){
            event.preventDefault();
            if($("#action").val()=="Save")
            {
                $.ajax({
                    url: "{{ route('faculty.store') }}",
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
                                if(data.errors[count] == "Account already used.")
                                {
                                    //$("#fname").css('border-color', '#c0392b');
                                    $(".acc_err").html("Account already used.");
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
                                if(data.errors[count]=="contact")
                                {
                                    $("#contact").css('border-color', '#c0392b');
                                    $(".contact_err").html('Invalid major.');
                                }
                                if(data.errors[count]=="img")
                                {
                                    $(".image_err").html('Invalid file size.');
                                }
                                if(data.errors[count]=="img-req")
                                {
                                    $(".image_err").html('Picture is required.');
                                }
                            }
                        }
                        if(data.success)
                        {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $("#faculty-form")[0].reset();
                            $("#faculty-table").DataTable().ajax.reload();
                            $("#form-result").html(html);
                        }
                        
                        $("#action").val('Save');
                        
                        setTimeout( function() {
                            $("#fname").css('border-color', '#ccc');
                            $(".fname_err").html('');
                            $("#lname").css('border-color', '#ccc');
                            $(".lname_err").html('');
                            $("#contact").css('border-color', '#ccc');
                            $(".contact_err").html('');
                            $(".image_err").html('');
                            $("#form-result").html('');
                            $(".acc_err").html('');
                        }, 2000);
                    }
                })
            }
            if($("#action").val()=="Update")
            {
                $.ajax({
                    url: "{{ route('faculty.update') }}",
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
                                if(data.errors[count] == "Account already used.")
                                {
                                    //$("#fname").css('border-color', '#c0392b');
                                    $(".acc_err").html("Account already used.");
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
                                if(data.errors[count]=="contact")
                                {
                                    $("#contact").css('border-color', '#c0392b');
                                    $(".contact_err").html('Invalid major.');
                                }
                                if(data.errors[count]=="img")
                                {
                                    $(".image_err").html('Invalid file size.');
                                }
                                if(data.errors[count]=="img-req")
                                {
                                    $(".image_err").html('Picture is required.');
                                }
                            }
                            setTimeout( function() {
                                $("#fname").css('border-color', '#ccc');
                                $(".fname_err").html('');
                                $("#lname").css('border-color', '#ccc');
                                $(".lname_err").html('');
                                $("#contact").css('border-color', '#ccc');
                                $(".contact_err").html('');
                                $(".image_err").html('');
                                $("#form-result").html('');
                                $(".acc_err").html('');
                                $("#action").val('Update');
                            }, 2000);
                        }
                        if(data.success)
                        {
                            $("#form-result").html('<div class="alert alert-success">' + data.success + '</div>');
                            $("#faculty-form")[0].reset();
                            $("#store-image").html('');
                            $("#faculty-table").DataTable().ajax.reload();
                            $("#action").val('Updated');
                            //$("#student-modal").modal('hide');
                            setTimeout(function(){
                                $("#faculty-modal").modal('hide');
                            },1000);
                        }
                    }
                })
            }
        });

        $(document).on("click", ".edit", function(){
            var id = $(this).attr('id');
            $("#form-result").html("");
            $(".modal-title").text("UPDATE FACULTY");
            $("#faculty-form")[0].reset();
            $.ajax({
                url:"/faculty/edit/"+id,
                dataType:"json",
                success:function(html)
                {
                    $("#hidden_id").val(html.data.id);
                    $("#position").val(html.data.position);
                    $("#contact").val(html.data.contact);
                    $("#fname").val(html.data.fname);
                    $("#lname").val(html.data.lname);
                    $("#mname").val(html.data.mname);
                    
                    $("#store-image").html("<img src={{ URL::to('/') }}/images/"+html.data.image+" width='150' class='img-thumbnail'/>");
                    $("#store-image").append("<input type='hidden' name='hidden_image' value='"+html.data.image+"'/>");
                    $("#action").val("Update");
                    $("#faculty-modal").modal({backdrop: 'static', keyboard: false});
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
                url:"faculty/destroy/"+user_id,
                beforeSend:function(){
                    $("#btn_ok").text('Deleting...');
                },
                success:function(data)
                {   
                    $("#btn_ok").text('Deleted');
                    setTimeout(function(){
                        $("#confirmedModal").modal('hide');
                        $("#faculty-table").DataTable().ajax.reload();
                    },1000);
                }
            })
        });
    });
</script>
@endsection