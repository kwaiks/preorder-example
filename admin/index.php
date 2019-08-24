<?php
include('../conne.php');


session_start();
if( isset($_SESSION['userid']) ){
    header('Location: home.php');
    exit;
   }else if( isset($_COOKIE['rememberme'] )){
    
    // Decrypt cookie variable value
    $userid = decryptCookie($_COOKIE['rememberme']);
    
    $sql_query = "select count(*) as cntUser,id from users where id='".$userid."'";
    $result = mysqli_query($dblink,$sql_query);
    $row = mysqli_fetch_array($result);
   
    $count = $row['cntUser'];
   
    if( $count > 0 ){
     $_SESSION['userid'] = $userid; 
     header('Location: home.php');
     exit;
    }
   }
   
   // Encrypt cookie
   function encryptCookie( $value ) {
    $key = 'youkey';
    $newvalue = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $key ), $value, MCRYPT_MODE_CBC, md5( md5( $key ) ) ) );
    return( $newvalue );
   }
   
   // Decrypt cookie
   function decryptCookie( $value ) {
    $key = 'youkey';
    $newvalue = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $key ), base64_decode( $value ), MCRYPT_MODE_CBC, md5( md5( $key ) ) ), "\0");
    return( $newvalue );
   }
   
   // On submit
   if(isset($_POST['btn_submit'])){
   
    $uname = mysqli_real_escape_string($dblink,$_POST['txt_uname']);
    $password = md5(mysqli_real_escape_string($dblink,$_POST['txt_pwd']));
    
    if ($uname != "" && $password != ""){
   
     $sql_query = "select count(*) as cntUser,id,username from users where username='".$uname."' and password='".$password."'";
     $result = mysqli_query($dblink,$sql_query);
     $row = mysqli_fetch_array($result);
   
     $count = $row['cntUser'];
   
     if($count > 0){
      $userid = $row['username'];
      if( isset($_POST['rememberme']) ){
   
       // Set cookie variables
       $days = 30;
       $value = encryptCookie($userid);
       setcookie ("rememberme",$value,time()+ ($days * 24 * 60 * 60 * 1000));
      }
    
      $_SESSION['userid'] = $userid; 
      header('Location: home.php');
      exit;
     }else{
      echo "Invalid username and password";
     }
   
    }
   
   }


?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Login</title>

  <!-- Custom fonts for this template-->
  <link href="../assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5 log">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user" method="post" action="">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="txt_uname" placeholder="Enter Username...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="txt_pwd" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" name="rememberme">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <input type="submit" value="Login" name="btn_submit" class="btn btn-primary btn-user btn-block">
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../assets/js/jquery-3.4.1.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../assets/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../assets/js/sb-admin-2.min.js"></script>

</body>

</html>
