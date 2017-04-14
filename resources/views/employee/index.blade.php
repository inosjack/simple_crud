<!DOCTYPE html>
<html lang="en">
<head>
    <title>INDEX PAGE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/dt/dt-1.10.10/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/s/dt/dt-1.10.10/datatables.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
    <script type="text/javascript">

        function Redirect() {
            window.location="{{url('employee')}}";
        }

    </script>
    <style>

    </style>
</head>
<body>
{{ csrf_field() }}
{{--?*/ $no = 1 /*?--}}
<div class="container">
    <div class="page-header">
        <h3>Employee Details</h3>
    </div>
    <div class="row">
        <div class="col-sm-4"><button type="button" onclick="Redirect();" class="btn btn-default">ADD EMPLOYEE</button></div>
    </div>
    @if (session()->has('msg'))
        <div class="row">
            <div class=" col-sm-4">
                {{ session('msg')}}
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
        <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Sno</th>
                <th>Name</th>
                <th>Job Titles</th>
                <th>Email</th>
                <th>Salary</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Sno</th>
                <th>Name</th>
                <th>Job Titles</th>
                <th>Email</th>
                <th>Salary</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach ($employees as $employee)
            <tr id="emp_{{$employee->id}}">
                <td>{{  $no++ }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->job_title }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->salary }}</td>
                <td>
                    <form action="{{ url('employee/'.$employee->id) }}" method="GET">
                        <button name="emp{{$employee->id}}" type="submit" class="btn btn-success">
                            <i  class="fa fa-trash">Edit</i>
                        </button>
                    </form>
                </td>
                <td>
                   <!-- <form action="{{ url('employee/'.$employee->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button name="del{{$employee->id}}" type="submit" class="btn btn-danger">

                            <i class="fa fa-trash">Delete</i>
                        </button>
                    </form>-->
                    <button id="del" onclick="del({{$employee->id}})"type="submit" class="btn btn-danger">
                        <i  class="fa fa-trash">DELETE</i>
                    </button>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    function del(id){
        var token = $('[name=_token]').val();
        $.ajax({
            type: 'POST',
            url: '{{url('/delete')}}',
            headers: {'X-CSRF-TOKEN': token},
            data: {'id' : id},
            success: function (response) {

                $("#abc").html('Proccessing................');
                if(response=='success'){
                    //alert('#emp_'+id);
                    $('#emp_'+id).remove();
                }

                if(response=='fail') {
                }
            }

        });
    }



</script>
