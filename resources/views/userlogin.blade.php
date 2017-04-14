<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
  <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript"></script>
  <style>
  	.container-fluid
  	{
  		background: #6666ff;

  	}
  </style>
</head>
<body>

<div class="container-fluid">
  <h3 class="col-sm-8">LOGIN HERE..........</h3>
</div>
<hr/>
 <form class="form-horizontal" action="{{url('userlogin')}}" method="post" role="form">
 {{ csrf_field() }}
  <div class="form-group">
    <label class="control-label col-sm-4" for="email">Email:</label>
    <div class="col-sm-3">
      <input type="email" class="form-control" value="{{old('email')}}" name="email" id="email" placeholder="Enter email">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-4" for="pwd">Password:</label>
    <div class="col-sm-3"> 
      <input type="password" class="form-control" name='password' id="pwd" placeholder="Enter password">
    </div>
  </div>

  @if (session()->has('data'))
  <div class="form-group"> 
    <div class="col-sm-offset-4 col-sm-3">
      <div clas="msg">
			
			{{ session('data')}}
			
      </div>
    </div>
  </div>
  @endif
  @if(isset($errors) && count($errors) > 0)
  <div class="form-group"> 
    <div class="col-sm-offset-4 col-sm-3">
      <div clas="msg">
			 <ul>
                @foreach($errors -> all() as $error )
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
       </div>
    </div>
  </div>
  @endif
  <div class="form-group"> 
    <div class="col-sm-offset-4 col-sm-3">
      <div class="checkbox">
        <label><input type="checkbox"> Remember me</label>
      </div>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-4 col-sm-3">
      <button type="submit" id="sub" name="login" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>  


</body>
</html>
