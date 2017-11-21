<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="views/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->



  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Escandalia</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Registro nuevo mienbro</p>

    <form action="/index.php" method="post">
     <!--  <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Nombre">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div> -->

      <!-- <div class="form-group has-error"> -->
        <!-- <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Campo obliatorio</label> -->
       <!--  <input type="text" class="form-control" id="inputError" name="ej_error" placeholder="Enter ...">
        <span class="help-block">Help block with error</span>
      </div> -->

      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" autofocus ="">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
         <span id="e_email" hidden=""><label class="control-label" for="inputError"></label></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span id="e_password" hidden=""><label class="control-label" for="inputError"></label></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="r_passsword" placeholder="Repita password">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        <span id="e_r_password" hidden=""><label class="control-label" for="inputError"></label></span>
      </div>


      <div class="row">
       <!--  <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div> -->
        <!-- /.col -->
       <!--  <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div> -->
        <!-- /.col -->
        <div class="col-xs-12">
          <a type="button" id="b_registrar" class="btn btn-primary btn-block btn-flat">Registrar</a>
        </div>
      </div>
    </form>

  <!--   <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div> -->

   <!--  <a href="login.html" class="text-center">I already have a membership</a> -->
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="views/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="views/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });


      $( "#b_registrar" ).click(function() {
        /*var parametros = $("form").serialize();*/
        var parametros = {
          "accion" : "registar_usuario",
          "parametros" : $("form").serialize(),
          "radon": Math.floor(Math.random() * 1000) + 1  
        };
        user_registrer(parametros);
        //return false;
      });


  });



  function user_registrer(parametros)
  {
    $.ajax({
    type: "POST",
    url: "action_access.php",
    data: parametros,
    beforeSend: function(response){     
     $('span[id^=e]').toggle(false);
     $('span[id^=e]').find('label').html('');
     $('span[id^=e]').closest('div').removeClass('has-error');
     $('span[id^=e]').closest('div').addClass('has-feedback');
    },
    success: function(response){

      var json_obj = JSON.parse(response);
      var url = json_obj['url'];
   

      if( json_obj['logado'] == 'no')
      {
        alert("error");
        $.each(json_obj,function(i, value){
          $('#'+i).toggle(true); 
          $('#'+i).find('label').html(value);

          $('#'+i).closest('div').removeClass('has-feedback');
          $('#'+i).closest('div').addClass('has-error');
        });

      }else{
        window.location.href = url;
      }



    }
  });
  }
</script>
</body>
</html>