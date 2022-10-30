<?php
  
  session_start();
  require '../functions.php';
  include '../database_connection.php';

 if(isset($_SESSION["login"])){

    if($_SESSION["encounter"]==0)
     header("Location: sysAdmMenu.php");
    
    elseif($_SESSION["encounter"]==1)
      header("Location: Encounter.php");


     exit;
  }

  //Set token as null if link has being expired
  function UpdateTokens($conn,$email){
    $Statement = $conn->prepare("EXEC dbo.ForgotPassword_UpdateToken @email=:email,@token=:token ");
    $Statement->bindValue(':email',$email,PDO::PARAM_STR);
    $Statement->bindValue(':token',null,PDO::PARAM_STR);
    $Statement->execute();
  }

  $token = $_GET['token'];

  if(isset($token)){


    $s = $conn->prepare("EXEC dbo.ForgotPassword_GetAdminInfoBasedOnTaken @token=:token");
    $s->bindValue(':token',$token,PDO::PARAM_STR);
    $s->execute();
    $a = $s->fetchAll(PDO::FETCH_ASSOC);

    if(count($a)==1){

      $email=$a[0]['staff_email'];
      $name = $a[0]['staff_name'];

      //Check if the link is still alive within 5 minutes after email had sent
      $TokensPart = explode("-",$token);
      $date = reset($TokensPart);
      $currentDate = time();

      $Now =  date("Y/m/d h:i:sa",$currentDate).'</br>';
      $Limit =  date("Y/m/d h:i:sa",strtotime('+15 minutes',$date));

      //Still allow them to change if...didnt reach 5 minute yet!
      if($Now < $Limit){
  
        if(isset($_POST["newPass"])){

          $email = htmlspecialchars($_POST["emailreset"]);
          
          

          if(isset($_POST['email'])){

            


            if(filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL)){

              $uppercase = preg_match('@[A-Z]@', $_POST["password_1"]);  //Use REGEX check ATLEAST 1 Caps
              $lowercase = preg_match('@[a-z]@', $_POST["password_1"]);  // Atleast 1 small letter
              $number    = preg_match('@[0-9]@', $_POST["password_1"]);  //Atleast 1 digit
              $specialChars = preg_match('@[^\w]@', $_POST["password_1"]); //Atleast 1 special char

              if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST["password_1"]) < 8) {
                  $req = true;
              }
              else{
                $req =false;
                $password_1 = $_POST["password_1"];
                $password_2 = $_POST["password_2"];


                if( $password_1 !== $password_2 ){
                  $error = true;  
                } 

                else {

                  $applyDate = date("Y/m/d h:i:sa",$date);  //Just want to tell user when the password reset actually been done


                  //password encryption         
                  $password = password_hash($password_1,  PASSWORD_DEFAULT);
                  //$password = $password_1;


                  $s = $conn->prepare("EXEC dbo.RecoveryPassword_UpdatePassword @password=:pass , @email=:email");
                  $s->bindParam(':pass',$password,PDO::PARAM_STR);
                  $s->bindParam(':email',$email,PDO::PARAM_STR);
                  $s -> execute();
                  


                  
                  date_default_timezone_set('Etc/UTC');

                  require '../PHPMailer/PHPMailerAutoload.php';

                  $mail = new PHPMailer;

                  // $mail->SMTPDebug = 4;                               // Enable verbose debug output

                  $mail->isSMTP();                                      // Set mailer to use SMTP
                  $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                  $mail->SMTPAuth = true;                               // Enable SMTP authentication
                  $mail->Username = "Mara.sims.system@gmail.com";  // SMTP username
                  $mail->Password = "happybirthday3767070";                           // SMTP password
                  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                  $mail->Port = 587;                                    // TCP port to connect to

                  $mail->setFrom('noReply@example.com', 'Admin BSM');
                  $mail->addAddress($email,$name);     // Add a recipient
                  // print_r($_FILES['file']); exit;
                  /*
                  for ($i=0; $i < count($_FILES['file']['tmp_name']) ; $i++) { 
                    $mail->addAttachment($_FILES['file']['tmp_name'][$i], $_FILES['file']['name'][$i]);    // Optional name
                  }*/
                  $mail->isHTML(true);                                  // Set email format to HTML

                  $mail->Subject = '[@No Reply] Password Reset Successfully : Sistem Klinik Panel MARA';
                  $mail->Body = 'You have changed your password at <br/> ServerTime : '.$Now.'<br/><br/> Requested at <br/>Current Server Time : '.$applyDate.' <br/><br/> Didn"t perform any password change? Please contact System Admin [] immediately to temperary close your access';
                  $mail->AltBody = 'This is a plain-text message body';
                  $mail->send();
                  
                  UpdateTokens($conn,$email);
                  
                  
                  ?>
                  <script>
                    alert('Password has been successfully updated');
                    setTimeout(function(){
                      
                    }, 5000);

                    var timeleft = 5;
                    var downloadTimer = setInterval(function(){
                      if(timeleft <= 0){
                        clearInterval(downloadTimer);
                        self.location = 'adminLogin.php';

                      } else {
                        document.getElementById("newPass").innerHTML = "Please wait, You will redirect back to login in " + timeleft + " seconds";
                        document.getElementById("password_1").disabled = true;
                        document.getElementById("password_2").disabled = true;
                        document.getElementById("newPass").disabled = true;
                      }
                      timeleft -= 1;
                      
                    }, 1000);

                  </script>

                  <?php
                }

              }
            }
            else{
              $emError = true;
            }
          }

        }
      }
      else{

        UpdateTokens($conn,$email);
        echo "<script>alert('Warning! The link has expired, Let me help you'); window.location='adminLogin.php'</script>";
        
      }
///////////////////////////
    }
//////////////////////////////////////
    else{
      echo "<script>alert('Warning! The link has expired, Let me help you'); window.location='adminLogin.php'</script>";  
       // Redirect to login page

    }






  }

 
  


 ?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KLINIK PANEL MARA- URUSAN PENTADBIRAN KLINIK PANEL MARA</title>
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
<div class="login-box">



      <?php if( isset($error) && $error == true) : ?>
            <div class="alert alert-danger" role="alert">
            Password entered didnt match.
          </div>
      <?php endif; ?>
      <?php if( isset($req) && $req == true) : ?>
            <div class="alert alert-danger" role="alert">
            Hover to the Lock Symbol for password format
          </div>
      <?php endif; ?>

      <?php if( isset($emError)) : ?>
            <div class="alert alert-danger" role="alert">
            <b>Invalid Email Detected</b> 
             Please enter a valid email .....
          </div>
      <?php endif; ?>


  <div class="login-logo">
    <b>KLINIK PANEL MARA</b>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" name="email" id="email" autocomplete="off" class="form-control" placeholder="Email" value="<?php echo $email?>" readonly>
          <input type="hidden" name="emailreset" value="<?php echo $email?>">

          <div class="input-group-append">
            <div class="input-group-text">
              
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password_1" id="password_1" autocomplete="off" class="form-control" placeholder="Password">
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
        <div class="input-group mb-3">
          <input type="password" name="password_2" id="password_2" autocomplete="off" class="form-control" placeholder="Confirm Password">
          <div class="input-group-append">
            <div class="input-group-text">
              
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="newPass" id="newPass" class="btn btn-primary btn-block">Change password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.2.0/dist/jBox.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/gh/StephanWagner/jBox@v1.2.0/dist/jBox.all.min.css" rel="stylesheet">
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



  });
</script>

</body>
</html>
