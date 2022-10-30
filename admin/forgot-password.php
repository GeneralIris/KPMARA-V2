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

  if(isset($_POST["passreset"])){

    $email = htmlspecialchars($_POST["email"]);

    if((isset($_POST['email'])) && ($_POST['email']!="")){

      if(filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL)){
          
        /*

        $Query = "EXEC dbo.LoginProcess_GetData @user =:user" ;
        $Statement = $conn->prepare($Query);
        $Statement->bindValue('user',$username ,PDO::PARAM_STR);

        $Statement->execute();
        $ActualResult = $Statement->fetchAll(PDO::FETCH_ASSOC);


        */



        $result = query(" EXEC dbo.ForgotPassword_GetDetailsToSendEmail @email = '$email' ");


        if (count($result)==1) {
          date_default_timezone_set('Etc/UTC');
          $name=$result[0]['staff_name'];
          $token = time().'-';

          $token.= bin2hex(random_bytes(100));
          $Now =  date("Y/m/d h:i:sa",time()).'</br>';
          



          require '../PHPMailer/PHPMailerAutoload.php';

          $mail = new PHPMailer;

          //$mail->SMTPDebug = 4;                               // Enable verbose debug output

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

          $mail->Subject =  '[@No Reply] Password Reset Request : Sistem Klinik Panel MARA';
          $mail->Body = 'You have requested a password reset <a href="localhost/Test/admin/recover-password.php?token='.$token.'"><br/>Click Here To Reset </a> 
            <br/> 
            <br/>
            Please ensure you perform the password reset within 15 minutes
            <br/>
            <br/>If you didn\'t request any password recovery,
            <br/>Do not go to the link

            <br/>
            <br/>
            Server Time Requested : '.$Now.'
            <br/>';

          $mail->AltBody = 'This is a plain-text message body';
          $mail->send();
      






        ?>

        <!-- Script for duration countdown-->
        <script>

          setTimeout(function(){
            
          }, 3000);

          var timeleft = 30;
          var downloadTimer = setInterval(function(){
            if(timeleft <= 0){
              clearInterval(downloadTimer);
              document.getElementById("done").disabled = false;
              document.getElementById("email").disabled = false;
              document.getElementById("done").innerHTML = "Request new password";
              $("#email").val("");

            } else {
              document.getElementById("done").innerHTML = "Please wait   " + timeleft + " seconds before resubmmit";
              document.getElementById("done").disabled = true;
              document.getElementById("email").disabled = true;
            }
            timeleft -= 1;
            
          }, 1000);

        </script>


        <?php

          
          $temp = ("EXEC dbo.ForgotPassword_UpdateToken @email='$email',@token='$token'");
          $s = $conn->prepare($temp);
          $s -> execute();
        
          $success = true;
          
        }

        else {
          $error = true;
        }

      }
      else{
        $emError = true;
      }

    }

  } 


?>











<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Recover</title>
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
</head>
<body class="hold-transition login-page">
<div class="login-box">


      <?php if( isset($error)) : ?>
            <div class="alert alert-danger" role="alert">
            The email entered is not exist in the system. Try again
          </div>
      <?php endif; ?>
      <?php if( isset($success)) : ?>
            <div class="alert alert-success" role="success">
            A reset password has been sent, check the link provided to reset the password.
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
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" id="email" autocomplete="off" required class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" name="passreset" id="done"class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="adminLogin.php">Relogin</a>
      </p>
      
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<h6 class="footer" style="text-align: center"><b>Hakcipta &copy; 2019 Majlis Amanah Rakyat</b></h6>
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
</body>
</html>


