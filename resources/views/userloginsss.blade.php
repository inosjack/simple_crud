<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">

</head>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript">


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
</script>
<style>

</style>
<body>

    <center>
        <h3>LOGIN PAGE</h3>
        <hr/>
        <h4 align="right"><a href="{{url('newuser')}}">NEW USER</a></h4>
    <form   >
        {{ csrf_field() }}
        <table frame="box" cellpadding="2" cellspacing="3">
            <tr>
                <th colspan="2" id="abc" align="center">


                    @if (session()->has('data'))
                        {{ session('data')}}
                    @endif


                </th>
            </tr>
            <tr>
                <td>
                    USER ID:
                </td>
                <td>
                    <input type="text" id="email" name="email" value="{{old('id')}}" />
                </td>
            </tr>
            <tr>
                <td>
                    PASSWORD:
                </td>
                <td>
                    <input type="password" name="password" />
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    @if(isset($errors) && count($errors) > 0)
                        <ul>
                            @foreach($errors -> all() as $error )
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="button" id="sub" value="submit"/>
                </td>
            </tr>
        </table>
    </form>
    </center>
</body>
</html>

<script type="text/javascript">
    var printableObjects=[];
    $("#sub").click(function(){
        //var data={'email' :$('input[name=email]').val(),'password':$('input[name=password]').val()};
        //alert (data);

        var token = $('[name=_token]').val();
        //alert(token);return false;
            $.ajax({
            url: '{{url('ajaxreq')}}',
            headers: {'X-CSRF-TOKEN': token},
            type: 'POST',
            data: {'email' :$('input[name=email]').val(),'password':$('input[name=password]').val()},
                success: function (response) {

                    $("#abc").html(response);
                   if(response=='success'){
                       $( location ).attr("href", '{{url('welcome')}}');
                   }
                }

        });

        //alert($('input[name=email]').val()+$('input[name=password]').val());
    });


</script>
