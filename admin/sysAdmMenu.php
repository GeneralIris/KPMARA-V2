<?php 

  session_start();
  
  if( !isset($_SESSION["login"])){

    header("Location: adminLogin.php");
    exit;
  }

  if(!($_SESSION["encounter"])==0){

    header("Location: Encounter.php");
    exit;

  }

  $_SESSION['popup'] = false;
  include '../database_connection.php';
            
  require '../functions.php';
  


  $StaffCode = $_SESSION['AdminCode'];
  $DipsUser = query("EXEC dbo.Admin_GetNameOnly @StaffCode=$StaffCode");

  if(count($DipsUser)!=0){
    $_SESSION['admin_name'] = $DipsUser[0]['staff_name'];
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
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">



  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body class="hold-transition sidebar-mini layout-fixed">


      


<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="sysAdmMenu.php" class="nav-link">Home</a>
      </li>
      
    </ul>

    

    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">

      <span class="brand-text font-weight-light"><?php echo $_SESSION['admin_name']  ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-header">Administrator Profiler</li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Admins
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if($_SESSION['access']==1){ ?>
              <li class="nav-item">
                <a href="adminUpd.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Admin Management</p>
                </a>
              </li>
            <?php } ?>
              <li class="nav-item">
                <a href="adminReg.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Register Admin</p>
                </a>
              </li>
              
            </ul>
          </li>
          
          <li class="nav-header">Clinic Profiler</li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Clinic Panel MARA
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
                <ul class="nav nav-treeview">
                  
                  <li class="nav-item">
                    <a href="alterClinic.php"class="nav-link ">
                      <i class="far fa-circle nav-icon"></i>
                      <p> Alter Clinic </p>
                    </a>
                  </li>
                  
                  
                </ul>
          </li>

                
        <!-- Here lies a forgoten funtion ... R.I.P-->


          <!--





                <ul class="nav nav-treeview">
                  
                  <li class="nav-item">
                    <a href=""class="nav-link ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Alter  State / City</p>
                    </a>
                  </li>
                  
                  
                </ul>
          </li>
          

          <li class="nav-header">Comments</li>
          <li class="nav-item">
            <a href="../calendar.html" class="nav-link">
              <i class="nav-icon fas fa-comment-dots"></i>
              <p>
                View Comment
              </p>
            </a>
          </li>
          
          -->
          
          <li class="nav-header">System</li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menu Sistem</h1>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <?php





    ?>






    <!-- Main content -->
     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12"> 
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Status Klinik</h3>
              </div>

              
              <!-- /.card-header -->
              <div class="card-body">
                
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Negeri</th>
                    <th>Bilangan Bandar</th>
                    <th>Lulus</th>
                    <th>Baru</th>
                    <th>Batal</th>
                    
                  </tr>
                  </thead>



                  <tbody>

                  <?php
                      $klinik = query("EXEC dbo.AdminMenu_ListParticularDetails;");
                      foreach($klinik as $row)  {             
                  ?>
                    <tr>
                      <td><?php echo $row['State'] ?></td>
                      <td><?php  echo $row['Total City']?></td>
                      <td><?php  echo $row['Approved']?></td>
                      <td><?php  echo $row['Disapproved']?></td>
                      <td><?php  echo $row['InQuery']?></td>
                    </tr>
                  <?php

                      }

                  ?>


                  </tbody>



                </table>
              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>









  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 9999999
    </div>
    <strong>Copyright &copy; 2091 IRIS.</strong> All rights
    reserved.
    
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</div>
<div class="loader-wrapper">
      <span class="loader"><span class="loader-inner"></span></span>
</div>

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>



<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script>
        $(window).on("load",function(){
          $(".loader-wrapper").fadeOut("slow");
        });
</script>


</body>
</html>
