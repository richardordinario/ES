@extends('layouts.master')

@section('content')

<br>
<div class="row">
    <div class="col-md-8">
        <h1 class="content-title"><span class="title-logo glyphicon glyphicon-book"></span>&nbsp;&nbsp;SUBJECT MANAGEMENT</h1>
    </div>
    <div class="col-md-4">
        <div align="right">
            <button type="button" class="btn btn-primary btn-md" id="subject-btn" style="margin-top: 25px">New Subject</button>
        </div>
    </div>
</div>
<hr>
<div class="row" style="padding: 10px">
    <div class="col-md-12">
        <div class="table-responsive">
            <table id="subject-table" class="table">
                <thead>
                    <tr>
                        <th class="table-header">Subject Code</th>
                        <th class="table-header">Subject Description</th>
                        <th class="table-header" width="1%"></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div id="subject-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
            <span id="form-result"></span>
            <form method="POST" id="subject-form" enctype="multipart/form-data">
            @csrf 
                <div class="form-group">
                    <label for="" class="labels">Subject Code:</label><span class="required-logo">&#42;</span>
                    <input type="text" name="scode" id="scode" class="form-control form-control-md" placeholder="Subject Code" autocomplete="off" required>
                    <span class="scode_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
                </div>
                <div class="form-group">
                    <label for="" class="labels">Subject Description:</label><span class="required-logo">&#42;</span>
                    <input type="text" name="sdesc" id="sdesc" class="form-control form-control-md" placeholder="Subject Description" autocomplete="off" required>
                    <span class="sdesc_err" style="font-size:12px;color:#c0392b;padding-left: 5px;font-weight: 600;"></span>
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
        document.getElementById("subject_nav").style.fontWeight="600";  
        document.getElementById("subject_nav").style.color="#777";         
    }

    $(document).ready(function() {

        $("#subject-table").DataTable({
            processing: true,
            serverSide: true,
            ajax:{
                url: "{{ route('subject.index') }}",
            },
            columns: [
                {data:'subject_code', name:'subject_code',orderable: false},
                {data:'subject_desc', name:'subject_desc', orderable: false},
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

        $("#subject-btn").click(function() {
            $(".modal-title").html("NEW SUBJECT");
            $("#form-result").html("");
            $("#action").val("Save");
       
            $("#subject-form")[0].reset();
            $("#scode").prop('readonly', false);
            $("#subject-modal").modal({backdrop: 'static', keyboard: false});
        });

        $("#subject-form").on('submit', function(e) {
            e.preventDefault();
            if($("#action").val() == "Save")
            {
                $.ajax({
                    url: "{{ route('subject.store') }}",
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
                                if(data.errors[count] == "Invalid subject code.")
                                {
                                    $("#scode").css('border-color', '#c0392b');
                                    $(".scode_err").html('Invalid subject code.');
                                }
                                if(data.errors[count] == "Subject code already used.")
                                {
                                    $("#scode").css('border-color', '#c0392b');
                                    $(".scode_err").html(data.errors[count]);
                                }

                                if(data.errors[count] == "code")
                                {
                                    $("#scode").css('border-color', '#c0392b');
                                    $(".scode_err").html('Invalid subject code.');
                                }
                                if(data.errors[count] == "sdesc")
                                {
                                    $("#sdesc").css('border-color', '#c0392b');
                                    $(".sdesc_err").html('Invalid subject description.');
                                }
                            }
                        }
                        if(data.success)
                        {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                            $("#subject-form")[0].reset();
                            $("#subject-table").DataTable().ajax.reload();
                            $("#form-result").html(html);
                        }
                        $("#action").val('Save');
                    
                        setTimeout( function() {
                            $("#scode").css('border-color', '#ccc');
                            $(".scode_err").html('');
                            $("#sdesc").css('border-color', '#ccc');
                            $(".sdesc_err").html('');
                            $("#form-result").html('');
                        }, 2000);
                    }
                });
            }
            if($("#action").val() == "Update")
            {
                $.ajax({
                    url: "{{ route('subject.update') }}",
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
                                if(data.errors[count] == "sdesc")
                                {
                                    $("#sdesc").css('border-color', '#c0392b');
                                    $(".sdesc_err").html('Invalid subject description.');
                                }
                            }
                            setTimeout( function() {
                                $("#scode").css('border-color', '#ccc');
                                $(".scode_err").html('');
                                $("#sdesc").css('border-color', '#ccc');
                                $(".sdesc_err").html('');
                                $("#form-result").html('');
                                $("#action").val('Update');
                            }, 2000);
                        }
                        if(data.success)
                        {
                            $("#form-result").html('<div class="alert alert-success">' + data.success + '</div>');
                            $("#subject-form")[0].reset();
                            $("#subject-table").DataTable().ajax.reload();
                            $("#action").val('Updated');
                            setTimeout(function(){
                                $("#subject-modal").modal('hide');
                            },1000);
                        }    
                    }
                });
            }
        });

        $(document).on("click", ".edit", function(){
            var id = $(this).attr('id');
            $("#form-result").html("");
            $(".modal-title").text("UPDATE SUBJECT");
            $("#subject-form")[0].reset();
            $.ajax({
                url:"/subject/edit/"+id,
                dataType:"json",
                success:function(html)
                {
                    $("#hidden_id").val(html.data.id);
                    $("#scode").val(html.data.subject_code);
                    $("#scode").prop('readonly', true);
                    $("#sdesc").val(html.data.subject_desc);
                    
                    $("#action").val("Update");
                    $("#subject-modal").modal({backdrop: 'static', keyboard: false});
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
                url:"subject/destroy/"+user_id,
                beforeSend:function(){
                    $("#btn_ok").text('Deleting...');
                },
                success:function(data)
                {   
                    $("#btn_ok").text('Deleted');
                    setTimeout(function(){
                        $("#confirmedModal").modal('hide');
                        $("#subject-table").DataTable().ajax.reload();
                    },1000);
                }
            });
        })
    
    });

</script>
@endsection