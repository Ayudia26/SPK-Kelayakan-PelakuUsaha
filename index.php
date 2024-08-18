<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dinas Perikanan Kab. Kotabaru</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="app/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="app/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="app/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="app/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  
  <!-- Custom styles -->
  <style>
    .custom-title {
      font-size: 28px; /* Adjust the font size as needed */
    }
    .login-page-custom {
      background-image: url('app/dist/img/1.jpg');
      background-size: cover;
      background-position: center;
    }
    .logo {
      width: 100px; /* Adjust the width as needed */
      height: auto;
      display: block;
      margin: 0 auto 20px auto; /* Center the logo and add margin */
    }
    .card-outline {
      background-color: #e3f2fd; /* Light blue background color */
    }
    .login-box {
      width: 400px; /* Adjust the width as needed */
      margin: auto; /* Center the login box horizontally */
      margin-top: 100px; /* Adjust top margin as needed */
    }
    .card {
      border-radius: 10px; /* Optional: Add border radius */
    }
  </style>
</head>
<body class="hold-transition login-page login-page-custom">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <img src="app/dist/img/R.png" alt="Logo" class="logo">
      <a href="../../index2.html" class="h1 custom-title"><b>SISTEM PENDUKUNG KEPUTUSAN KELAYAKAN PELAKU USAHA PADA DINAS PERIKANAN KABUPATEN KOTABARU</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">LOGIN</p>

      <form action="conf/autentikasi.php" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Log In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- SweetAlert2 -->
<script src="app/plugins/sweetalert2/sweetalert2.min.js"></script>
</body>
<?php
if(isset ($_GET['error'])){
$x = ($_GET['error']);
if($x==1){
  echo "
  <script>
  var Toast = Swal.mixin({
    toast: true,
    position: 'center-top',
    showConfirmButton: false,
    timer: 3000
  });
  Toast.fire({
    icon: 'error',
    title: 'Login Gagal'
  })
  </script>";
}
else if($x==2){
  echo "
  <script>
  var Toast = Swal.mixin({
    toast: true,
    position: 'center-top',
    showConfirmButton: false,
    timer: 3000
  });
  Toast.fire({
    icon: 'warning',
    title: 'Silakan Input Username & Password'
  })
  </script>";
}
else{
  echo '';
}
}
?>
</html>
