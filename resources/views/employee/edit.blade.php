<!DOCTYPE html>
<html lang="en">
<head>
    <title>UPDATE EMPLOYEE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript">

        function Redirect() {
            window.location="{{url('/')}}";
        }

    </script>
</head>
<body>
<div class="container">
    <div class="page-header">
        <h3>Update Empployee</h3>

    </div>
    <div class="row">
        <div class="col-sm-4"><button type="button" onclick="Redirect();" class="btn btn-default">SHOW DETAILS</button></div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <fieldset><legend> Fill The Employee Details</legend>
                @foreach ($employees as $employee)
                <form method="post" action="{{url('employee/'.$employee->id)}}" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    {{--?*/ $id = $employee->id /*?--}}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Name:</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" value="{{ $employee->name }}" id="name" name="name" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="job_title">Job_Title:</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="job_title"value="{{$employee->job_title}}" name="job_title" placeholder="Enter job_title">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="email">Email:</label>
                        <div class="col-sm-2">
                            <input type="email" class="form-control" id="email" value="{{$employee->email}}" name="email" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="salary">Salary:</label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control" id="salary" value="{{$employee->salary}}" name="salary" placeholder="Enter Salary">
                        </div>
                    </div>
                    @foreach($errors -> all() as $error )
                        <div class="form-group">
                            <div style="text-transform: uppercase;color: #C20000" class="col-sm-offset-2 col-sm-10">
                                {{ $error }}<br/>
                            </div>
                        </div>
                    @endforeach
                    <div  class="form-group">
                        <div id="abc"style="text-transform: uppercase;color: #C20000" class="col-sm-offset-2 col-sm-10">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                           <!-- <button type="submit" name="addemp" class="btn btn-success">UpdteEmployee</button>-->
                            <!--ajax request-->
                            <button type="button" name="addemp" id="updtemp" class="btn btn-success">UpdteEmployee</button>
                        </div>
                    </div>
                </form>
                    @endforeach
            </fieldset>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    $("#updtemp").click(function(){
        //alert (data['name']);

        var token = $('[name=_token]').val();
        //alert(token);return false;
        $.ajax({
            type: 'POST',
            url: '{{url('ajaxemployee/'.$id)}}',
            headers: {'X-CSRF-TOKEN': token},
            data: {'name' :$('input[name=name]').val(),'job_title':$('input[name=job_title]').val(),
                'email' :$('input[name=email]').val(),'salary' :$('input[name=salary]').val()},
            success: function (response) {

                $("#abc").html('Proccessing................');
                if(response=='success'){
                    $( location ).attr("href",'{{url('/')}}');
                    $("#abc").html('success');
                }
                if(response=='fail') {
                    $("#abc").html('Fail SomeThing Goes wrong');
                }
            }

        });

        //alert($('input[name=email]').val()+$('input[name=password]').val());
    });


</script>
