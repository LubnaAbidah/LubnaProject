<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin | Log in</title>
  <link rel="shortcut icon" type="text/css" href="image/logo-polinela.png"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/iCheck/square/blue.css">
  <link href="./menu/framework/bootstrap/bootstrap.css" rel="stylesheet">
	<link href="./menu/framework/bootstrap/docs.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	
	 <link rel="stylesheet" href="./menu/framework/bootstrap/AdminLTE.min.css">
	 <link rel="stylesheet" href="./menu/framework/bootstrap/style.css">
	<link rel="shortcut icon" type="text/css" href="image/logo-polinela.png"/>
	  <style>
  .r-text {
    color: white;
  }
</style>
</head>
   

<!--  <body class="hold-transition login-page">-->
 <body class="login-img3-body">

<div class="login-box">
<div class="r-text">
  <div class="login-logo">
   <center> <h1><b>Admin</b></h1><h3>SIAKAD POLINELA</h3> </center>
  </div>
 
  <!-- /.login-logo -->
  
  <!--  <div class="login-box-body">-->
    <p class="login-box-msg">Sign in to start your session</p>

   <form action="sistem.php?op=in" method="post">

      <div class="form-group has-feedback">
        <input type="text" name="nmuser" class="form-control" placeholder="Username">

      </div>
      <div class="form-group has-feedback">
        <input type="password" name="psw" class="form-control" placeholder="Password">
     
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
         
		  <input type="submit"   class="btn btn-primary btn-block btn-flat" value="Login">
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!-- 
    <a href="register.html" class="text-center">Register a new membership</a>
	 -->
  </div>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script src="./menu/framework/bootstrap.js"></script>
<script src="./menu/framework/icheck.min.js"></script>
<script src="./menu/framework/jquery-2.2.3.min.js"></script>
<script src="./menu/framework/jquery-1.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
