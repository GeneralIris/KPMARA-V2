<?php
	
	session_start();
	require '../functions.php';
  
  	include '../database_connection.php';


  	if(($_SESSION["encounter"]==0)){
  		
  		header("Location: sysAdmMenu.php");
  		exit;
  	}

  
  $LetsGo = false; //Prepare Auto Redirect
  $SamePass=false;//Check if sneky breki user use the same pass as default
  $NotSame=false;//Check if  both password aint the same
  $req = false;//Checks if password met required formats

    if(isset($_POST['submit'])){
        
        $uppercase = preg_match('@[A-Z]@', $_POST['password1']);  //Use REGEX check ATLEAST 1 Caps
        $lowercase = preg_match('@[a-z]@', $_POST['password1']);  // Atleast 1 small letter
        $number    = preg_match('@[0-9]@', $_POST['password1']);  //Atleast 1 digit
        $specialChars = preg_match('@[^\w]@', $_POST['password1']); //Atleast 1 special char

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($_POST['password1']) < 8) {
          $req = true;
        }
        else{


          $password1 = $_POST['password1'];
          $password2 = $_POST['password2'];


          if($password1===$password2){


            if(($password1 === $_SESSION['AdminCode'])||(strtolower($password1)===strtolower($_SESSION['AdminCode']))){
              //Say OIP same damn thing
              $SamePass=true;
              
              
            }

            else{
              $val = $_SESSION['AdminCode']; //Admin Code is staff code        
              $password = password_hash($password1,  PASSWORD_DEFAULT);


               
               $Statement = $conn -> prepare("EXEC dbo.Encounter_Update1stTimeUserAccess @staffCode=:staffcode, @pass=:pass");
               $Statement->bindParam(':staffcode',$val,PDO::PARAM_STR);
               $Statement->bindParam(':pass',$password,PDO::PARAM_STR);
               $Statement ->execute();

               $LetsGo =true;
               $_SESSION['encounter'] = 0;

            }
          


          }
          else{
            $NotSame = true;
          }
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

  <script type="text/javascript">
  
 

  
  </script>

<!--input type="button" onclick="confirmation()" value="finish">< -->

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>[First Time User Only]</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-10">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Enter a new password to secure your new account</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action=""role="form" id="quickForm" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="">Password </label>
                    <input type="password" name="password1" autocomplete="off" required class="form-control" id="password1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword2">Retype Password</label>
                    <input type="password" name="password2" autocomplete="off"class="form-control" required id="password2" placeholder="Retype Password ">
                  </div>
                  
                </div>
                <!-- /.card-body -->
                
                <div class="card-footer">
                  <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
              <?php if($LetsGo==true){ ?>
                <script>
                   setTimeout(function(){
                      self.location = 'sysAdmMenu.php';
                    }, 7000);

                    var timeleft = 5;
                    var downloadTimer = setInterval(function(){
                      if(timeleft <= 0){
                        clearInterval(downloadTimer);
                        document.getElementById("countdown").innerHTML = "Redirecting ..... ";
                      } else {
                        document.getElementById("countdown").innerHTML = "You will be redirected to the system Menu in  " + timeleft + " seconds";
                      }
                      timeleft -= 1;
                    }, 1000);
                    

                </script>
                  
                </div>
                    <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert-success" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-check"></i> Alert!</h5>
                       Password Changed , Please Wait..<div id="countdown"></div>
                    </div>
                    
                  <?php } ?>
                </div>

                
                
              
               

                <?php if(($SamePass)) :?>
                  <div class="form-group">
                      <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                        Password detected to be the same as the old one, Please change the password fully.
                  </div>
                <?php endif;  ?>
                <?php if(($NotSame)) :?>
                  <div class="form-group">
                      <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                        Password aren't the same, Ensure password are typed correctly.
                  </div>
                <?php endif;  ?>
                <?php if(($req)) :?>
                  <div class="form-group">
                      <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-exclamation-triangle"></i> Warning!</h5>
                        Please enter the required password requirements: <br/>
                      <span class="dot"></span>&nbsp&nbspPassword must contains : <br/> 
                      <span class='dot'></span>&nbsp&nbspAtleast 8 characters.<br/> 
                      <span class='dot'></span>&nbsp&nbspCombination of upper and lower case.<br/> 
                      <span class='dot'></span>&nbsp&nbspContains atleast 1 number.<br/> 
                      <span class='dot'></span>&nbsp&nbspContains atleast 1 special characters.<br/> 
                    

                  </div>
                <?php endif;  ?>
                

              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-4">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong><b>Hakcipta &copy; 2020 Majlis Amanah Rakyat</b></strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script type="text/javascript">
$(document).ready(function () {
  
  $('#quickForm').validate({
    rules: {
      password1: {
        required: true,
        minlength: 1
      },
      password: {
        required: true,
        minlength: 1
      },
      terms: {
        required: true
      },
    },
    messages: {
      password1: {
        required: "Please provide a password",
        minlength: "Your password must have mix characters  and  at least 5 characters long"
      },
      password: {
        required: "Please retype the password",
        minlength: ""
      },
      terms: "Please accept our terms"
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
</body>
</html>
