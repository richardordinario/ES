@extends('layouts.master')

@section('content')
@if(Auth::user()->utype == "Admin")
@else
    <script>window.location="/404"</script>
@endif

<br>
<h1 class="content-title"><span class="title-logo glyphicon glyphicon-cog"></span>&nbsp;&nbsp;SYSTEM SETTING</h1>
<br>
<div class="row">
    <div class="col-md-0"></div>
    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#admin" style="color:#777;" onclick="allDestroy();">Admin Management</a></li>
            <li><a href="#question" style="color:#777;" onclick="getQuestion();">Question Management</a></li>
            <li><a href="#position" style="color:#777;" onclick="getPosition();">Position Management</a></li>
            <li><a href="#menu4" style="color:#777;">User Management</a></li>
        </ul>
    </div>
    <div class="col-md-0"></div>
</div>
    <div class="tab-content">
        <div id="admin" class="tab-pane fade in active">
            <div class="row" style="padding:10px">
                <div class="col-md-10">
                    <h3 style="color: #777;font-weight: 600;"><span class="title-logo glyphicon glyphicon-users"></span>&nbsp;&nbsp;Admin Management</h3>
                    <!-- <p>Setting / Admin Panel</p> -->
                </div>
                <div class="col-md-2">
                    <div align="right">
                        <button type="button" class="btn btn-primary btn-md" id="admin-btn" style="margin-top: 20px">New Admin</button>
                    </div>
                </div>
            </div>

            <div class="row" style="padding: 10px">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="admin-table" class="table">
                            <thead>
                                <tr>
                                    <th width="1%" class="table-header">Image</th>
                                    <th width="10%" class="table-header">User Type</th>
                                    <th class="table-header">Full Name</th>
                                    <!-- <th class="table-header">Full Name</th>
                                    <th class="table-header">Full Name</th> -->
                                    <th width="15%"class="table-header">Contact Number</th>
                                    <th width="10%"class="table-header">Status</th>
                                    <th class="table-header" width="1%"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Question Tab -->
        <div id="question" class="tab-pane fade">
            <div class="row" style="padding:10px">
                <div class="col-md-8">
                    <h3 style="color: #777;font-weight: 600;"><span class="title-logo glyphicon glyphicon-postion"></span>&nbsp;&nbsp;Question Management</h3>
                </div>
                <div class="col-md-4">
                    <div align="right">
                        <button type="button" class="btn btn-primary btn-md" id="question-btn" style="margin-top: 20px">New Question</button>
                        <button type="button" class="btn btn-secondary btn-md" id="active-btn" style="margin-top: 20px">Active Question</button>
                    </div>
                </div>
            </div>
            <div class="row" style="padding: 10px">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="question-table" class="table">
                            <thead>
                                <tr>
                                    <th class="table-header" width="10%">Action</th>
                                    <th class="table-header" width="0%">Number</th>
                                    <th class="table-header" >Question Description</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Position Tab -->
        <div id="position" class="tab-pane fade">
            <div class="row" style="padding:10px">
                <div class="col-md-10">
                    <h3 style="color: #777;font-weight: 600;"><span class="title-logo glyphicon glyphicon-postion"></span>&nbsp;&nbsp;Position Management</h3>
                </div>
                <div class="col-md-2">
                    <div align="right">
                        <button type="button" class="btn btn-primary btn-md" id="position-btn" style="margin-top: 20px">New Position</button>
                    </div>
                </div>
            </div>
            <div class="row" style="padding: 10px">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="position-table" class="table">
                            <thead>
                                <tr>
                                    <th class="table-header" width="0%">Action</th>
                                    <th class="table-header">Faculty Position</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="admin-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
            <span id="form-result"></span>
            <form method="POST" id="admin-form" enctype="multipart/form-data">
            @csrf 
                <div class="form-group row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                        <p style="font-size: 15px;color: #777;font-weight: 600;">Usertype:<span class="required-logo" style="font-weight: 500">&#42;</span></p>
                        <label class="radio-inline" style="font-size: 14px;color: #777; font-weight: 600;">
                            <input type="radio" name="utype" value="Admin" id="radio_admin" required>Admin
                        </label>
                        &nbsp;&nbsp;&nbsp;
                        <label class="radio-inline" style="font-size: 14px;color: #777; font-weight: 600;">
                            <input type="radio" name="utype" value="Facilitator" id="radio_faci" required>Facilitator
                        </label>
                    </div>
                    <div class="col-sm-4"></div>
                </div>
                <center><span class="account_err" style="font-size:12px;color:#c0392b;font-weight: 600;"></span></center>
                <hr>
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
                <div class="form-group">
                    <label for="" class="labels">Contact Number:</label><span class="required-logo">&#42;</span>
                    <input type="text" name="contact" id="contact" class="form-control form-control-md" placeholder="Contact number" autocomplete="off" required>    
                    <span class="contact_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="" class="labels">Username:</label><span class="required-logo">&#42;</span>
                        <input type="text" name="user" id="user" class="form-control form-control-md" placeholder="Username" autocomplete="off" required>
                        <span class="user_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                    </div>
                    <div class="col-sm-6">
                        <label for="" class="labels">Password:</label><span class="required-logo">&#42;</span>
                        <input type="password" name="pass" id="pass" class="form-control form-control-md" placeholder="Password" required>
                        <span class="pass_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="labels">Picture:</label><span class="required-logo">&#42;</span>
                    <input type="file" name="image" id="image" class="btn-type" required>
                    <span class="image_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                </div>
                <div class="form-group">
                    <span id="store-image" style="margin-top: 10px"></span>
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

<!-- Position Form -->
<div id="position-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
            <span id="position-result"></span>
            <form method="POST" id="position-form" enctype="multipart/form-data">
            @csrf 
                <div class="form-group">
                    <label for="" class="labels">Faculty Position:</label><span class="required-logo">&#42;</span>
                    <input type="text" name="position" id="position" class="form-control form-control-md" placeholder="Position" autocomplete="off" required>
                    <span class="position_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="position_id" id="position_id">
            <input type="submit" class="btn btn-success" value="Save" name="btn_position" id="position_action">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
        </form>
    </div>
    </div>
</div>

<!-- Question Form -->
<div id="question-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
            <span id="question-result"></span>
            <form method="POST" id="question-form" enctype="multipart/form-data">
            @csrf 
                <div class="form-group">
                    <label for="" class="labels">Question Description:</label><span class="required-logo">&#42;</span>
                    <textarea name="qdesc" id="qdesc" cols="30" rows="10" class="form-control" required></textarea>
                    <span class="qdesc_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="question_id" id="question_id">
            <input type="submit" class="btn btn-success" value="Save" name="btn_position" id="question_action">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
        </form>
    </div>
    </div>
</div>


<!-- Confirmation  -->
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

<!-- Actived form  -->
<div id="active-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ACTIVE QUESTIONS</h4>
      </div>
      <div class="modal-body">
        <div class="row" style="padding: 10px;">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="active-table" class="table">
                        <thead>
                            <tr>
                                <th class="table-header" width="0%">Number</th>
                                <th class="table-header">Question Description</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
  </div>
</div>

<!-- Set Numvber -->
<div id="set-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
            <span id="set-result"></span>
            <form method="POST" id="set-form" enctype="multipart/form-data">
            @csrf 
            <div class="form-group">
                <label for="" class="labels">Input Number:</label><span class="required-logo">&#42;</span>
                <input type="text" name="num" id="num" class="form-control form-control-md" placeholder="Number 1 - 10" autocomplete="off" required>
                
            </div>
            <div class="form-group">
                <label for="" class="labels">Description</label><span class="required-logo" style="color:#fff;">&#42;</span>
                <br>
                <span id="qdesc-display"></span>
            </div>
        </div>
        <div class="modal-footer">
            <input type="hidden" name="hidden_qdesc" id="hidden_qdesc">
            <input type="hidden" name="hidden_num" id="hidden_num">
            <span class="num_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
            <input type="submit" class="btn btn-success" value="Save" name="btn_action" id="set_action">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
        </form>
    </div>
    </div>
</div>


<script>
setting();
function setting() {
    //dashboard option
    document.getElementById("system").style.fontWeight="600";  
    document.getElementById("system").style.color="#777";         
}
function allDestroy() {
    $('#position-table').DataTable().destroy();
}
function getPosition() {
    $('#position-table').DataTable().destroy();
    $("#position-table").DataTable({
        processing: true,
        serverSide: true,
        scrollY: 265,
        scrollCollapse: true,
        ajax:{
            url: "{{ route('setting.position') }}",
        },
        columns: [
            {data:'action', name:'action', orderable: false}, 
            {data:'position', name:'position',orderable: false},
        ],
        columnDefs: [{
            "targets": 0,
            "createdCell": function(td, cellData, rowData, row, col)
            {
                $(td).css('color','#555')
                $(td).css('font-size','14px')
            },
        }],
    });
}
function getActive() {
    $('#active-table').DataTable().destroy();
    $("#active-table").DataTable({
        processing: true,
        serverSide: true,
        paging:   false,
        ordering: false,
        info:     false,
        searching: false,
        scrollY: 350,
        scrollCollapse: true,
        ajax:{
            url: "{{ route('question.active') }}",
        },
        columns: [
            {data:'qnum', name:'qnum', orderable: false}, 
            {data:'qdesc', name:'qdesc',orderable: false},
        ],
        columnDefs: [{
            "targets": 0,
            "createdCell": function(td, cellData, rowData, row, col)
            {
                $(td).css('color','#555')
                $(td).css('font-size','14px')
            },
        }],
    });
}
function getQuestion() {
    $('#question-table').DataTable().destroy();
    $("#question-table").DataTable({
        processing: true,
        serverSide: true,
        scrollY: 260,
        scrollCollapse: true,
        ajax:{
            url: "{{ route('setting.question') }}",
        },
        columns: [
            {data:'action', name:'action', orderable: false}, 
            {data:'qnum', name:'qnum',orderable: false},
            {data:'qdesc', name:'qdesc',orderable: false},
        ],
        columnDefs: [
            {
                "targets": 1,
                "createdCell": function(td, cellData, rowData, row, col)
                {
                    if(cellData ==null){
                        $(td).text('Null')
                        $(td).css('color','#999')
                        $(td).css('font-size','14px')
                        $(td).css('font-style','italic')
                    } else {  } 
                },
            }
        ],
    });
}
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });

    $("#admin-table").DataTable({
        processing: true,
        serverSide: true,
        scrollY: 265,
        scrollCollapse: true,
        ajax:{
            url: "{{ route('setting.admin') }}",
        },
        columns: [
            {   data:'image', name:'image', orderable: false, 
                render: function(data, type, full, meta) { return "<img src={{ URL::to('/') }}/images/" + data + " width='20' class='img-circle' />"; }, 
            },
            {data:'utype', name:'utype', orderable: false},
            {
                data: null,
                orderable: false,
                render: function( data, type, row ) {
                    if (row.mname == null) { return row.fname + " " + row.lname; }
                    else { return row.fname + " " + row.mname + " " + row.lname; }
                },
                targets: 3,
                visible: true
            },
            {data:'contact', name:'contact', orderable: false},
            {data:'status', name:'status', orderable: false},
            {data:'action', name:'action', orderable: false}, 
        ],
        columnDefs: [{
            "targets": 1,
            "createdCell": function(td, cellData, rowData, row, col)
            {
                $(td).css('color','#666')
                $(td).css('font-size','14px')
                $(td).css('font-style','italic')
            },
        }],
        "rowCallback": function( row, data, index) {
            if(data["status"] == "Active"){
                $('td', row).css('background-color', '#fff !important');
            }else {
                $('td', row).css('background-color', 'rgba(192, 57, 43, 0.9)');
                $('td', row).css('color', '#f5f5f5');
            }
        }
    });

    $("#admin-btn").click(function() {
        $(".modal-title").html("REGISTER ADMIN");
        $("#form-result").html("");
        $("#action").val("Save");
        $("#store-image").html('');
        $("#user").prop('readonly', false);
        $("#pass").prop('readonly', false);
        $("#admin-form")[0].reset();
        $("#admin-modal").modal({backdrop: 'static', keyboard: false});
    });

    $("#position-btn").click(function() {
        $(".modal-title").html("NEW POSITION");
        $("#position-result").html("");
        $("#position_action").val("Save");
        $("#position-form")[0].reset();
        $("#position-modal").modal({backdrop: 'static', keyboard: false});
    });

    $("#question-btn").click(function() {
        $(".modal-title").html("NEW QUESTION");
        $("#question-result").html("");
        $("#question_action").val("Save");
        $("#question-form")[0].reset();
        $("#question-modal").modal({backdrop: 'static', keyboard: false});
    });

    $("#active-btn").click(function() {
        $(".modal-title").html("ACTIVE QUESTION");
        getActive();
        $("#active-modal").modal({backdrop: 'static', keyboard: false}); 
    });

    $("#admin-form").on("submit", function(event){
        event.preventDefault();
        if($("#action").val()=="Save")
        {
            $.ajax({
                url: "{{ route('admin.store') }}",
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
                            if(data.errors[count] == "Account already exists.")
                            {
                                $(".account_err").html(data.errors[count]);
                            }
                            if(data.errors[count] == "fn")
                            {
                                $("#fname").css('border-color', '#c0392b');
                                $(".fname_err").html('Invalid firstname.');
                            }
                            if(data.errors[count] == "ln")
                            {
                                $("#lname").css('border-color', '#c0392b');
                                $(".lname_err").html('Invalid lastname.');
                            }
                            if(data.errors[count] == "contact")
                            {
                                $("#contact").css('border-color', '#c0392b');
                                $(".contact_err").html('Invalid contact number.');
                            }
                            if(data.errors[count] == "user")
                            {
                                $("#user").css('border-color', '#c0392b');
                                $(".user_err").html('Invalid username.');
                            }
                            if(data.errors[count] == "pass")
                            {
                                $("#pass").css('border-color', '#c0392b');
                                $(".pass_err").html('Invalid password.');
                            }
                            if(data.errors[count] == "img")
                            {
                                //$("#fname").css('border-color', '#c0392b');
                                $(".image_err").html('Invalid file size.');
                            }
                        }
                    }
                    if(data.success)
                    {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $("#admin-form")[0].reset();
                        $("#admin-table").DataTable().ajax.reload();
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
                        $("#user").css('border-color', '#ccc');
                        $(".user_err").html('');
                        $("#pass").css('border-color', '#ccc');
                        $(".pass_err").html('');
                        $(".image_err").html('');
                        $(".account_err").html('');
                        $("#form-result").html('');
                    }, 2000);
                }
            })
        }
        if($("#action").val()=="Update")
        {
            $.ajax({
                url: "{{ route('admin.update') }}",
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
                            if(data.errors[count] == "fn")
                            {
                                $("#fname").css('border-color', '#c0392b');
                                $(".fname_err").html('Invalid firstname.');
                            }
                            if(data.errors[count] == "ln")
                            {
                                $("#lname").css('border-color', '#c0392b');
                                $(".lname_err").html('Invalid lastname.');
                            }
                            if(data.errors[count] == "contact")
                            {
                                $("#contact").css('border-color', '#c0392b');
                                $(".contact_err").html('Invalid contact number.');
                            }
                            // if(data.errors[count] == "user")
                            // {
                            //     $("#username").css('border-color', '#c0392b');
                            //     $(".user_err").html('Invalid username.');
                            // }
                            // if(data.errors[count] == "pass")
                            // {
                            //     $("#password").css('border-color', '#c0392b');
                            //     $(".pass_err").html('Invalid password.');
                            // }
                            if(data.errors[count] == "img")
                            {
                                //$("#fname").css('border-color', '#c0392b');
                                $(".image_err").html('Invalid file size.');
                            }
                        }
                        setTimeout( function() {
                            $("#fname").css('border-color', '#ccc');
                            $(".fname_err").html('');
                            $("#lname").css('border-color', '#ccc');
                            $(".lname_err").html('');
                            $("#contact").css('border-color', '#ccc');
                            $(".contact_err").html('');
                            $("#username").css('border-color', '#ccc');
                            $(".user_err").html('');
                            $("#password").css('border-color', '#ccc');
                            $(".pass_err").html('');
                            $(".image_err").html('');
                            $("#form-result").html('');
                            $("#action").val('Update');
                        }, 2000);
                    }
                    if(data.success)
                    {
                        $("#form-result").html('<div class="alert alert-success">' + data.success + '</div>');
                        $("#admin-form")[0].reset();
                        $("#store-image").html('');
                        $("#admin-table").DataTable().ajax.reload();
                        $("#action").val('Updated');
                        setTimeout(function(){
                            $("#admin-modal").modal('hide');
                        },1000);
                    }  
                }
            })
        }
    });
 
    $(document).on("click", ".edit", function(){
        var id = $(this).attr('id');
        $("#form-result").html("");
        $(".modal-title").html("UPDATE ADMIN");
        $("#admin-form")[0].reset();
        $.ajax({
            url:"/admin/edit/"+id,
            dataType:"json",
            success:function(html)
            {
             
                if (html.data.utype == "Admin"){ $("#radio_admin").prop('checked', true); }
                else { $("#radio_faci").prop('checked', true); }

                $("#fname").val(html.data.fname);
                $("#lname").val(html.data.lname);
                $("#mname").val(html.data.mname);
                $("#contact").val(html.data.contact);
                // "<img src={{ URL::to('/') }}/images/" + html.data.image + " width='70' class='img-thumbnail' />"
                $("#user").prop('readonly', true);
                $("#pass").prop('readonly', true);
                $("#store-image").html("<img src={{ URL::to('/') }}/images/"+html.data.image+" width='150' class='img-thumbnail'/>");
                $("#store-image").append("<input type='hidden' name='hidden_image' value='"+ html.data.image + "' />");
                $("#hidden_id").val(html.data.id);
                $("#action").val("Update");
                $("#admin-modal").modal({backdrop: 'static', keyboard: false});
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
    $(document).on('click','.delete_position', function(){
        user_id = $(this).attr('id');
        $('.modal-title').html("Confirmation");
        $("#confirm-text").text("Are you sure you want to delete this position?");
        $("#btn_ok").text("Delete position");
        $("#confirmedModal").modal({backdrop: 'static', keyboard: false});
    });
    $(document).on('click','.delete_question', function(){
        user_id = $(this).attr('id');
        $('.modal-title').html("Confirmation");
        $("#confirm-text").text("Are you sure you want to delete this question?");
        $("#btn_ok").text("Delete question");
        $("#confirmedModal").modal({backdrop: 'static', keyboard: false});
    });
    $(document).on('click', '.deactivate', function() {
        user_id = $(this).attr('id');
        $('.modal-title').html("Confirmation");
        $("#confirm-text").text("Are you sure you want to deactivate this data?");
        $("#btn_ok").text("Deactivate");
        $("#confirmedModal").modal({backdrop: 'static', keyboard: false});

    });
    $(document).on('click', '.activate', function() {
        user_id = $(this).attr('id');
        $('.modal-title').html("Confirmation");
        $("#confirm-text").text("Are you sure you want to Activate this data?");
        $("#btn_ok").text("Activate");
        $("#confirmedModal").modal({backdrop: 'static', keyboard: false});

    });
    $("#btn_ok").click(function(){
        if ($("#btn_ok").text() == "Yes")
        {
            $.ajax({
                url:"admin/destroy/"+user_id,
                beforeSend:function(){
                    $("#btn_ok").text('Deleting...');
                },
                success:function(data)
                {   
                    $("#btn_ok").text('Deleted');
                    setTimeout(function(){
                        $("#confirmedModal").modal('hide');
                        $("#admin-table").DataTable().ajax.reload();
                    },1000);
                }
            });
        }
        else if ($("#btn_ok").text() == "Deactivate")
        {
            $.ajax({
                url:"admin/deactivate/"+user_id,
                beforeSend:function(){
                    $("#btn_ok").text('Deactivating...');
                },
                success:function(data)
                {   
                    $("#btn_ok").text('Deactivated');
                    setTimeout(function(){
                        $("#confirmedModal").modal('hide');
                        $("#admin-table").DataTable().ajax.reload();
                    },1000);
                }
            });
        }
        else if ($("#btn_ok").text() == "Activate")
        {
            $.ajax({
                url:"admin/activate/"+user_id,
                beforeSend:function(){
                    $("#btn_ok").text('Activating...');
                },
                success:function(data)
                {   
                    $("#btn_ok").text('Activated');
                    setTimeout(function(){
                        $("#confirmedModal").modal('hide');
                        $("#admin-table").DataTable().ajax.reload();
                    },1000);
                }
            });
        }
        else if ($("#btn_ok").text() == "Delete position")
        {
            $.ajax({
                url:"setting/position/destroy/"+user_id,
                beforeSend:function(){
                    $("#btn_ok").text('Deleting...');
                },
                success:function(data)
                {   
                    $("#btn_ok").text('Deleted');
                    setTimeout(function(){
                        $("#confirmedModal").modal('hide');
                        $("#position-table").DataTable().ajax.reload();
                    },1000);
                }
            });
        }
        else if ($("#btn_ok").text() == "Delete question")
        {
            $.ajax({
                url:"setting/question/destroy/"+user_id,
                beforeSend:function(){
                    $("#btn_ok").text('Deleting...');
                },
                success:function(data)
                {   
                    $("#btn_ok").text('Deleted');
                    setTimeout(function(){
                        $("#confirmedModal").modal('hide');
                        $("#question-table").DataTable().ajax.reload();
                    },1000);
                }
            });
        }

    })

    $("#position-form").on('submit', function(e) {
        e.preventDefault();
        if($("#position_action").val() == "Save")
        {
            $.ajax({
                url: "{{ route('setting.storeposition') }}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend:function(){
                    $("#position_action").val('Saving...');
                },
                success:function(data){
                    var html='';
                    if(data.errors)
                    {
                        for(var count = 0; count < data.errors.length; count++)
                        {
                            if(data.errors[count] == "Invalid position.")
                            {
                                $("#position").css('border-color', '#c0392b');
                                $(".position_err").html('Invalid position.');
                            }
                        }
                    }
                    if(data.success)
                    {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $("#position-form")[0].reset();
                        $("#position-table").DataTable().ajax.reload();
                        $("#position-result").html(html);
                    }
                    $("#position_action").val('Save');
                
                    setTimeout( function() {
                        $("#position").css('border-color', '#ccc');
                        $(".position_err").html('');
                        $("#position-result").html('');
                    }, 2000);
                }
            });
        }
    })

    $("#question-form").on('submit', function(e) {
        e.preventDefault();
        if($("#question_action").val() == "Save")
        {
            $.ajax({
                url: "{{ route('setting.storequestion') }}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend:function(){
                    $("#question_action").val('Saving...');
                },
                success:function(data){
                    var html='';
                    if(data.errors)
                    {
                        for(var count = 0; count < data.errors.length; count++)
                        {
                            if(data.errors[count] == "Invalid question.")
                            {
                                $(".qdesc_err").html('Invalid question.');
                            }
                        }
                    }
                    if(data.success)
                    {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $("#question-form")[0].reset();
                        $("#question-table").DataTable().ajax.reload();
                        $("#question-result").html(html);
                    }
                    $("#question_action").val('Save');
                
                    setTimeout( function() {
                        $(".qdesc_err").html('');
                        $("#question-result").html('');
                    }, 2000);
                }
            });
        }
        if($("#question_action").val() == "Update")
        {
            $.ajax({
                url: "{{ route('setting.updatequestion') }}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend:function(){
                    $("#question_action").val('Updating...');
                },
                success:function(data){
                    var html='';
                    if(data.errors)
                    {
                        for(var count = 0; count < data.errors.length; count++)
                        {
                            if(data.errors[count] == "Invalid question.")
                            {
                                $(".qdesc_err").html('Invalid question.');
                            }
                        }
                        setTimeout( function() {
                            $(".qdesc_err").html('');
                            $("#question-result").html('');
                            $("#question_action").val('Update');
                        }, 2000);
                    }
                    if(data.success)
                    {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $("#question-form")[0].reset();
                        $("#question-table").DataTable().ajax.reload();
                        $("#question-result").html(html);

                        setTimeout( function() {
                            $(".qdesc_err").html('');
                            $("#question-result").html('');
                            $("#question_action").val('Updated');
                            $("#question-modal").modal('hide');
                        }, 1000);
                    }
                    
                }
            });
        }

    })
    $("#set-form").on('submit', function(e) {
        e.preventDefault();
        if($("#set_action").val() == "Set")
        {
            $.ajax({
                url: "{{ route('question.setnumber') }}",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend:function(){
                    $("#set_action").val('Setting...');
                },
                success:function(data){
                    var html='';
                    if(data.errors)
                    {
                        for(var count = 0; count < data.errors.length; count++)
                        {
                            if(data.errors[count] == "Invalid number.")
                            {
                                $(".num_err").html('Invalid number.');
                            }
                            if(data.errors[count] == "Number already used in question.")
                            {
                                $(".num_err").html(data.errors[count]);
                            }
                        }
                        $("#set_action").val('Set');
                        setTimeout( function() {
                            $(".num_err").html('');
                            $("#set-result").html('');
                            //$("#set-modal").modal('hide');
                            
                        }, 2000);
                    }
                    if(data.success)
                    {
                        $("#set_action").val('Success');
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $("#set-form")[0].reset();
                        $("#question-table").DataTable().ajax.reload();
                        $("#admin-table").DataTable().ajax.reload();
                        $("#set-result").html(html);
                        
                        setTimeout( function() {
                            $(".num_err").html('');
                            $("#set-result").html('');
                            $("#set-modal").modal('hide');
                        }, 1000);
                    }
                }
            });
        }
    })
    $(document).on("click", ".set", function(){
        var id = $(this).attr('id');
        $("#set-result").html("");
        $(".modal-title").text("SET NUMBER");
        $("#set-form")[0].reset();
        $.ajax({
            url:"/setting/question/set/"+id,
            dataType:"json",
            success:function(html)
            {
                $("#hidden_num").val(html.data.id);
                $("#qdesc-display").html(html.data.qdesc);
                $("#hidden_qdesc").html(html.data.qdesc);
                // $("#scode").prop('readonly', true);
                // $("#sdesc").val(html.data.subject_desc);
                
                $("#set_action").val("Set");
                $("#set-modal").modal({backdrop: 'static', keyboard: false});
            }
        })
    });

    $(document).on("click", ".edit_question", function(){
        var id = $(this).attr('id');
        $("#question-result").html("");
        $(".modal-title").text("UPDATE QUESTION");
        $("#question-form")[0].reset();
        $.ajax({
            url:"/setting/question/edit/"+id,
            dataType:"json",
            success:function(html)
            {
                $("#question_id").val(html.data.id);
                $("#qdesc").val(html.data.qdesc);
                $("#question_action").val("Update");
                $("#question-modal").modal({backdrop: 'static', keyboard: false});
            }
        })
    });
});
</script>
@endsection