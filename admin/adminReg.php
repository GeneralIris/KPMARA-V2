<?php 

  session_start();










  
  if( !isset($_SESSION["login"])){

    header("Location: adminLogin.php");
    exit;
  }

    
  include '../database_connection.php';
            
  require '../functions.php';

  
  //OLD FASHION. Function : To decide where to display the datatable once we found a staff or not
  //Default dont display
  $GotCode =false ; 


  
  if(isset(($_POST["submit"])) && (($_POST["submit"])=="search")){

    $code = $_POST['code'];

    //Grab some data to check if staff exist or not
    $StaffDetails = query("EXEC dbo.AdminREG_CheckIfStaffEvenExist @code = $code "); 
    
    //Checks if a staff even exists
    if((count($StaffDetails))==1){ 

      $GotCode = true;

      //Just grab the particular Staff's admin type
      $GetTheChoosenAdmin_sType = query("EXEC dbo.AdminReg_GetTheChoosenAdmin_sType @code=$code ");

      //Grab all the admin types that exist in db
      $AdminType = query("EXEC dbo.AdminReg_GetAllAdminTypes;");

      //Later will display the current rights
      if((count($GetTheChoosenAdmin_sType))==1){
        $NoAddPlz = true;     
      }

      // Instead of current rights...it will display custom words
      else{
        $NoAddPlz = false;    
      }

    }

    //Produces error when no staff exists
    else{
      $NoCode = true;
      
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
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>

<srcipt>



</srcipt>



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
      <span class="brand-text font-weight-light"><?php echo $_SESSION['admin_name']; ?></span>
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
          <li class="nav-item has-treeview menu-open">
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
                <a href="" class="nav-link active">
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
                      <p>Alter Clinic </p>
                    </a>
                  </li>
                </ul>
                
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
            <h1>Admin Registration</h1>
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
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="form1" role="form" action="" method="POST">
                <div class="card-body">
                  <div class="form-group">

                    <label for="">Carian mengikut nombor gaji</label>
                    <input type="text" class="form-control" autocomplete="off" name="code" id="code" minlength="4" maxlength="49" required placeholder="Sila masukkan nombor gaji">
                  </div>

                  <?php if(isset($NoCode)) :?>
                  <div class="form-group">
                      <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                      Staff Unique Code isn't exists in the database.
                  </div>
                  <?php endif;  ?>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit"  value ="search" class="btn btn-primary">Cari</button>
                </div>
              </form>

            </div>

            <!-- /.card -->  
          </div>
        </div>

      <?php
        //This part happen when im not good at php that time.
        //But what it does is...from other page [SubmitApp] will declare this popup session as true when i click submit/daftar 

        if($_SESSION['popup']==true){ ?>
         
          <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Alert!</h5>
                  User Has Been Added As Admin
           </div>
      <?php
         }
      ?>

        <!-- Once we found a staff we going to display the tables : -->
        <?php if($GotCode) :?>
         <form id='form2' name='form2' method="POST">   
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>

                <div class="card-tools">
                  
                </div>
              </div>
              


              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nama anggota kerja</th>
                      <th>No. Telefon</th>
                      <th>Emel</th>
                      <th>No. Gaji</th>
                      <th>Tahap Capaian</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php foreach($StaffDetails as $row) { ?>

                      <td><?php echo $row['staff_id'] ?></td>
                      <td><?php echo $row['staff_name'] ?></td>
                      <td><?php echo $row['staff_ph'] ?></td>
                      <td><?php echo $row['staff_email'] ?></td>
                      <td><?php echo $row['staff_code'];?></td>
                      <input type="hidden" name="StaffID" id="StaffID" value="<?php echo $row['staff_id'] ?>" />
                      <input type="hidden" name="StaffCode" id="StaffCode" value="<?php echo $row['staff_code'] ?>" />
                      <td>


                        <?php 

                          //This part is just to display [No rights Given] when a staff is not an admin 
                          //else we just show the admin types [Super/Regular] to user
                          if($NoAddPlz){
                            
                            foreach($AdminType as $Types){
                              
                               if($GetTheChoosenAdmin_sType[0]["admin_type_id"]==$Types['admin_type_id']){
                                  echo $Types['admin_type_name'];
                                  break;
                               }

                            }

                          }
                          else{
                            //This is custom word i decide to choose when staff is not even exist in admin db
                             echo "Tiada tahap capaian";
                          }
                          //echo $row[''] 
                        ?>
                        
                      </td>

                      <?php } ?>
                    </tr>
                   
                  </tbody>
                </table>
                
                <div class="col-sm-10">
                     
                      <div class="form-group">
                        <label>Assign Rights</label>

                        <!-- As I said before this one when we found an admin we are going to disable use 
                             from Re-register another admin-->
                        <?php if($NoAddPlz) { ?>

                        <select class="form-control" disabled="">
                          <option value='Null'> Pengguna adalah admin</option>


                        <!-- Okay this one is a nested else{ if()else() }-->
                        <?php } else { ?>
                        <select id="rights" class="form-control" required >
                          <option selected="" value='' disabled="">Pilih Jenis Admin </option>

                        <?php } 
                         //AHA! Wut is this then?...
                         //Well this method is to stop Regular Admin from assign other staff as Super Admin
                         if($_SESSION['access']==1){


                          foreach ($AdminType as $NewRow) {
                            ?>
                              <option value='<?php echo $NewRow['admin_type_id']?>'><?php echo $NewRow['admin_type_name']?></option>
                            <?php
                            
                            }
                           
                         }

                         else { 

                          foreach ($AdminType as $NewRow) {

                            if($NewRow['admin_type_id'] == 1){
                              continue;
                            }
                            else{
                              /*
                              $randNumber = bin2hex(random_bytes(100))."a";
                              $one = substr($randNumber,0,100);
                              $two = substr($randNumber,100);
                              echo $randNumber*/
                            ?>  
                              <option value='<?php echo $NewRow['admin_type_id']?>'><?php echo $NewRow['admin_type_name']?></option>
                            <?php
                            
                            }
                           
                          }

                        }
                          

                         ?>
                          
                          
                        </select>
                      </div>
                    </div>
                <div class="card-footer">
                
                  <!--Again im showing button can't be pressed at all when a staff is already an admin-->
                  <?php if($NoAddPlz) { ?>

                    <button type="" name=""  disabled="" class="btn btn-primary">Proses Kemas Kini Tidak Dibenarkan</button>

                <?php } else { ?>

                    
                    <button type="button"  disabled=""name="ApplyChanges" id='ApplyChanges'class="btn btn-primary">Daftar</button>


                <?php } ?>

                   <button type="button" onclick="window.location.href='adminReg.php'" class="btn btn-primary">Tutup</button>

                  
                </div>
              </div>
             
            </div>
         
          </div>

          <?php endif; ?>
          </form>

        


       <!--/.col (right) -->

        

        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
  </div>


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
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- DataTables -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<script src="../sweetalert2/dist/sweetalert2.all.min.js"></script>


<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": true,
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
<script type="text/javascript">
  
  $(document).ready(function(){

   

    $('#rights').change(function(){

      $("#ApplyChanges").prop('disabled',false);

    })


    $('#ApplyChanges').on('click',function(){
      var Id = $('#StaffID').val();
      var Code = $('#StaffCode').val();
      var TypeDecided = $('#rights').val();

      $.ajax({

        url:"AdminRegAction.php",
        method:"POST",
        data:{Id:Id,Code:Code,TypeDecided:TypeDecided},

        success:function(){
          $("#ApplyChanges").prop('disabled',true);
          Swal.fire(
              'Daftar Berjaya!',
              'Pastikan staff menggunakan staff code sendiri untuk login kali pertama',
              'success'
          )
          
           
        }
      })





    })




  })

</script>

</body>
</html>
