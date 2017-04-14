<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
</head>
<body>
<fieldset>
    <legend><h1>Register</h1>
    </legend>
    <form method="POST" action="{{ url('regisuser')}}">
        {{ csrf_field() }}
        <p><label name="name">Name:</label><input type="text" name="name" placeholder="enter your name"  value="{{ old('name') }}" /></p>
        <p><label name="mobile_no">Mobile_No:</label><input type="text" name="mobile_no" placeholder="enter your mobile no" value="{{ old('mobile_no') }}" /></p>
        <p><label name="email"></label>Email:<input type="text" name="email" placeholder="enter your email" value="{{ old('email') }}" /></p>
        <p><label name="password">CREATE PASSWORD:</label><input type="password" placeholder="enter your password" name="password"  /> </p>
        <p><label name="cpassword">COMFIRM PASSWORD:</label><input type="password" placeholder="Reenter your password" name="cpassword" /> </p>
        <p><input type="submit" name="submit" value="register"/> </p>
        <p>
        <?php
           /* if(isset($errors) && count($errors) > 0)
           {
               $a= $errors->all();
               echo $errors->all()[0];
           }*/
        ?>
        @if(isset($errors) && count($errors) > 0)
            <ul>
                @foreach($errors -> all() as $error )
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </p>

        @endif

    </form>
</fieldset>
</body>
</html>