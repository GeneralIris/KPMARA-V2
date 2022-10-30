<?php
  
  session_start();
  require '../functions.php';
  
  include '../database_connection.php';

  $CantLogin = false;
  $WrongPass = false;
  $error=false;
  $tidaksah=false;

  if(isset($_SESSION["login"])){

    if($_SESSION["encounter"]==0)
     header("Location: sysAdmMenu.php");
    
    elseif($_SESSION["encounter"]==1)
      header("Location: Encounter.php");


     exit;
  }
        
  
        


  if(isset($_POST["login"])){

    $staffcode = $_POST["staffcode"];
    $password = $_POST["password"];
      
    if((isset($_POST["staffcode"])) && (!empty($_POST["password"]))){
     
        //encounter,admin_password,admin_status_id,admin_type_id
        $Query = "EXEC dbo.LoginProcess_GetData @user =:user" ;
        $Statement = $conn->prepare($Query);
        $Statement->bindValue(':user',$staffcode ,PDO::PARAM_STR);

        $Statement->execute();
        $ActualResult = $Statement->fetchAll(PDO::FETCH_ASSOC);

        $row = count($ActualResult);

      if($row == 1){

        if($ActualResult[0]['encounter']==0){
          $uppercase = preg_match('@[A-Z]@', $password);  //Use REGEX check ATLEAST 1 Caps
          $lowercase = preg_match('@[a-z]@', $password);  // Atleast 1 small letter
          $number    = preg_match('@[0-9]@', $password);  //Atleast 1 digit
          $specialChars = preg_match('@[^\w]@', $password); //Atleast 1 special char

          if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
              $WrongPass = true;
          }
        }
        

          $WrongPass = false;

          if(password_verify($password, $ActualResult[0]['admin_password'])){

            if($ActualResult[0]['admin_status_id']==1){
              //set session
              $CantLogin = false;
              $_SESSION["AdminCode"] = $staffcode;
              $_SESSION["login"] = true;
              $_SESSION["encounter"] =$ActualResult[0]['encounter'];
              $_SESSION["access"]=$ActualResult[0]['admin_type_id'];
              
              header("Location: Encounter.php"); 
              exit;
            }

            else{

              $CantLogin = true;


            }


          }
          
          else{

            $error=true;

          }

        }

      


      else{

        $tidaksah=true;

      }

    } 

  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Admin Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.2.0/dist/jBox.all.min.js"></script>
  <link href="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.2.0/dist/jBox.all.min.css" rel="stylesheet">
  <style type="text/css">
    .dot {
      height: 7px;
      width: 7px;
      background-color: #bbb;
      border-radius: 50%;
      display: inline-block;
    }
  </style>
  
</head>
<body class="hold-transition login-page">
  

      <?php
      if($error == true) : ?>
            <div class="alert alert-danger" role="alert">
            Oops! You have entered wrong {Code} or {Password} Try again.
          </div>
      <?php endif; ?>

      <?php 
      if($tidaksah==true) : ?>
            <div class="alert alert-danger" role="alert">
            Please ensure every data inputed is correct.
            </div>
      <?php endif; ?>
      <?php 
      if($CantLogin==true) : ?>
            <div class="alert alert-danger" role="alert">
            Please ask the Super Admin to change online status to true.
            </div>
      <?php endif; ?>
      <?php 
      if($WrongPass==true) : ?>
            <div class="alert alert-danger" role="alert">
            Hover to the Lock Symbol for password format
            </div>
      <?php endif; ?>




<div class="login-box">
  <div class="login-logo">
    <b>KLINIK PANEL MARA</b>
  </div>

  


  <!-- /.login-logo -->
  <div class="card">

    <div class="card-body login-card-body">
      <p class="login-box-msg">Login to  enter the system</p>

      <form action="" method="post">
        <div class="input-group mb-3">

          <input type="text" name="staffcode" id="staffcode"  class="form-control" autocomplete="off" required placeholder="Code">
          <div class="input-group-append">
            <div class="input-group-text">
              <i class="far fa-user"></i>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" name="password" id="password" class="form-control"  autocomplete="off" required placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock " id="demo-tooltip-right" title=
              "&nbsp&nbspPassword must contains : <br/> 
              <span class='dot'></span>&nbsp&nbspAtleast 8 characters.<br/> 
              <span class='dot'></span>&nbsp&nbspCombination of upper and lower case.<br/> 
              <span class='dot'></span>&nbsp&nbspContains atleast 1 number.<br/> 
              <span class='dot'></span>&nbsp&nbspContains atleast 1 special characters.<br/> 
              "></span>
            </div>
          </div>
          
        </div>
        <br/>
        <div class="row">
          <div class="col-5">
            <button type="button" id="headout" class="btn btn-primary btn-block">Main Page&nbsp<i class="fas fa-undo-alt"></i></button>
          </div>
          <div class="col-3">
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="login" class="btn btn-primary btn-block">Login In</button>
          </div>
          <!-- /.col -->
        </div>
        
      </form>

      
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="forgot-password.php"><br/><br/>I forgot my password</a>
      </p>

      <p><h6 class="footer" style="text-align: center"><b>Hakcipta &copy; 2020 Majlis Amanah Rakyat</b></h6></p>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->



<!-- jQuery -->

<!-- Bootstrap 4 -->

<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>


<script>
$(document).ready(function() {

  new jBox('Tooltip', {
    attach: '#demo-tooltip-right',

    position: {
      x: 'right',
      y: 'center'
    },
    outside: 'x' // Horizontal Tooltips need to change their outside position
  });

  $('#headout').click(function(){

    self.location='../index.php';


  })



    
    
  



  });
</script>


</body>
</html>
