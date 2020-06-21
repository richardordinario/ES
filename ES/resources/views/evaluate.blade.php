@extends('layouts.master')

@section('content')
<style>
@media screen and (max-width:768px) {
    #td{
        width:70%;
    }
}
</style>
<br>
    <h1 class="content-title"><span class="title-logo glyphicon glyphicon-check"></span>&nbsp;&nbsp;EVALUATE FACULTY</h1>
    <hr>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading" style="color:#777;font-weight:600;font-size: 14px">FILTER OPTION</div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <label for="" class="labels">Semester</label><span class="required-logo">&#42;</span>
                            <select name="sem" id="sem" class="form-control form-control-md" required style="color:#888">
                                <option  value="" >Semester</option>
                                <option value="1st Semester">1st Semester</option>
                                <option value="2nd Semester">2nd Semester</option>            
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="" class="labels">Year Level</label><span class="required-logo">&#42;</span>
                            <select name="ylevel" id="ylevel" class="form-control form-control-md" required style="color:#888">
                                <option value="">Year Level</option>
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year">2nd Year</option>  
                                <option value="3rd Year">3rd Year</option>  
                                <option value="4th Year">4th Year</option>            
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label for="" class="labels">Section</label><span class="required-logo">&#42;</span>
                            <input type="text" name="section" id="section" class="form-control form-control-md" placeholder="Section" autocomplete="off" required>
                        </div>
                      
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-success btn-md" id="filter-btn" style="margin-top: 37px;">
                                <span class="glyphicon glyphicon-search"></span>
                            </button> 
                            <button type="button" class="btn btn-primary btn-md" id="refresh-btn" style="margin-top: 37px;">
                                <span class="glyphicon glyphicon-refresh"></span>
                            </button> 
                        </div>
                    </div>
                </div>
            </div>
           
        </div>
        <div class="col-sm-2"></div>
    </div>
    <div class="row" style="padding: 10px">
        <div class="col-md-12">
        <span id="rate-result"></span>
            <div class="table-responsive">
                <table id="schedule-table" class="table">
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

    <div id="rate-modal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">RATER FORM</h4>
            </div>
            <div class="modal-body">
                <div class="row" style="padding: 10px;">
                    <div class="col-md-12">
                    <form method="GET" id="score-form">
                    @csrf
                            <p style="font-size:14px;color:#888;">Faculty Name</p>
                            <p id="fn" style="font-size:16px;color:#666;padding-left:10px;font-weight:600;"></p>
                   
                            <table class="table table-bordered">
                            </table>
                            <table id="active-table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="table-header">#</th>
                                        <th class="table-header" width="79%" id="qtd">Question Description</th>
                                        <th class="table-header">Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                            
                                    @foreach($questions as $question)
                                    <tr>
                                        <td><strong>{{$question->qnum}} . </strong></td>
                                        <td>{{$question->qdesc}}</td>
                                        <td id="td">
                                            <select name="score" style="padding: 5px;width:100%;border-radius:5px;background-color:#fff;border-color:#ccc;" class="score" required>
                                                <option value=""></option>
                                                <option value="5">5</option>   
                                                <option value="4">4</option> 
                                                <option value="3">3</option>  
                                                <option value="2">2</option> 
                                                <option value="1">1</option> 
                                            </select>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3">
                                            <label for="" class="labels">Comment:</label><span class="required-logo">&#42;</span>
                                            <textarea name="comment" id="comment" cols="10" rows="5" class="form-control" required></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="hidden" name="sid" id="sid">
                            <input type="hidden" name="sscore[]" id="sscore">
                            <button class="btn btn-primary" id="sub">Submit</button>
                    </form>
                    </div>
                </div>
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
    
    evaluate();
    
    function evaluate() {
        
        document.getElementById("evaluate_nav").style.fontWeight="600";  
        document.getElementById("evaluate_nav").style.color="#777";         
    }

    $(document).ready(function() {

        load_data();
        $("#schedule-table").DataTable().destroy();
        function load_data(sem = '', ylevel = '', section = '')
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
                    url:'{{ route("evaluate.index") }}',
                    data:{sem:sem, ylevel:ylevel, section:section}
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
            let = ylevel = $("#ylevel").val();
            let = section = $("#section").val();
          
            if(sem != "" && ylevel != "" && section != "")
            {
                $("#schedule-table").DataTable().destroy();
                load_data(sem,ylevel,section);
            }
            else
            {
                alert('Please complete the field');
            }
        });

        $("#refresh-btn").click( function() {
            $("#sem").val('');
            $("#ylevel").val('');
            $("#section").val('');
           
            $("#schedule-table").DataTable().destroy();
            load_data();
        });

        $(document).on('click', '.rate', function() {
            var id = $(this).attr('id');
            $.ajax({
                url:"/evaluate/rate/"+id,
                dataType:"json",
                success:function(html)
                {
                    if(html.errors)
                    {
                        for(var count = 0; count < html.errors.length; count++)
                        {
                            if(html.errors[count] == "fail")
                            {
                                alert('Faculty already evaluated.');
                            }
                        }
                        
                    }
                    else
                    {
                        $("#score-form")[0].reset();
                        $("#sid").val(html.data.id);
                        $("#fn").text(html.data.name);
                        $("#rate-modal").modal({backdrop: 'static', keyboard: false});
                    }   
                }
            })
        });

        $("#score-form").on('submit', function(e) {
            e.preventDefault();
            let score = [];
            let sid = $("#sid").val();
            let comment = $("#comment").val();

            $('.score').each(function(){
                score.push($(this).val());
            });


            $.ajax({
                url:'{{ route("evaluate.score") }}',

                data:{score:score,sid:sid,comment:comment},
                success:function(data)
                {
                    if(data.success)
                    {   
                        $("#rate-modal").modal('hide');
                        $("#rate-result").html('<div class="alert alert-success">' + data.success + '</div>');   
                        setTimeout( function() {
                            $("#rate-result").html('');
                        }, 2000);
                    }
                }
            });
        });
    });
</script>
@endsection