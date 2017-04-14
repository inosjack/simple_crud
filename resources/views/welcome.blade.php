<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h4 align="right"><a href="{{url('logout')}}">LOGOUT</a></h4>
            <div class="content">
                <div class="title">Laravel 5</div>
                <div class="title">WELCOME
                    @if (Session::has('uid'))
                    {{Session::get('uid')}}
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>