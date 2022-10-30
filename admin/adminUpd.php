<?php 

  session_start();
  
  if( !isset($_SESSION["login"])){

    header("Location: adminLogin.php");
    exit;
  }
  include '../database_connection.php';
            
  require '../functions.php';
  $code= $_SESSION["AdminCode"];

  $statement = $conn->prepare("EXEC dbo.AdminUpdate_GetAllRegularAdmin @code=$code");
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);











  


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
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
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
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-alt"></i>
                <p>
                  Admins
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="" class="nav-link active">
                    <i class="far fa-circle nav-icon " ></i>
                    <p>Admin Management</p>
                  </a>
                </li>
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
              <!--    
                </ul>
             
                <ul class="nav nav-treeview">
                  
                  <li class="nav-item">
                    <a href=""class="nav-link ">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Alter  State / City</p>
                    </a>
                  </li>
                  
                  
                </ul>
            

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
              <h1></h1>
            </div>
            
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Admin Lists</h3>
                </div>
                <!-- /.card-header -->
                <div id="result" class="card-body">  <!-- Hopefully display here -->

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Kod Admin</th>
                        <th>Nama</th>
                        <th>No. Telefon</th>
                        <th>Emel</th>
                        <th>Status</th>
                        <th>Jenis</th>
                        <th>Edit</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      foreach($result as $row)
                       { ?>
                        
                          
                            <tr>
                              <td><?php echo$row["staff_code"];?></td>
                              <td><?php echo$row["staff_name"]; ?></td>
                              <td><?php echo$row["staff_ph"]; ?></td>
                              <td><?php echo$row["staff_email"] ?></td>
                              <td><?php echo$row["admin_status_name"]; ?></td>
                              <td><?php echo$row["admin_type_name"];?></td>
                              <td><button type="button" admin_id='<?php echo $row["admin_id"] ?>' class="btn btn-warning btn-xs update">Update</button></td>
                            </tr>
                         
                        

                      <?php
                       } ?>
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
        <b>Version</b> 3.7.6
      </div>
      <strong>Copyright © B34$T CLAN 2020
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->



        <<!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables -->
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
 


  <script>
 
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({


        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  </body>
</html>

<!----------------------------- Custom Stuff --------------------->
<!-- Modal [Pop Up Form]-->

<div id="customerModal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title">Update Admin </h4>
   </div>
   <div class="modal-body">
    <label>ID</label>
    <input type="text" name="staff_code" id="staff_code" disabled value=''autocomplete="off" required class="form-control" />
    <br />
    <label>Name</label>
    <input type="text" name="admin_name" id="admin_name" disabled autocomplete="off" required class="form-control" />
    <br/>

    <div class="container">
        <label>Jenis Admin</label>

        <div class="form-inline">
          <input type="text" name="type" id="type"class="form-control mr-1" disabled>
            
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="changeType" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Tukar
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">


                <?php 

                $state = $conn->prepare("EXEC [dbo].[AdminReg_GetAllAdminTypes]");
                $state->execute();
                $state= $state->fetchAll(PDO::FETCH_ASSOC);
              
                foreach($state as $row){ ?>

                  <button class="dropdown-item adminTypes"  admin_Types= '<?php echo $row["admin_type_name"] ?>' type="button"><?php echo $row["admin_type_name"];?></button>

                <?php
                } 
                ?>

            </div>
          </div>    
        </div>
        
    </div>
    <br />
    <div class="container">
        <label>Status</label>
        <div class="form-inline">
          <input type="text" name="status" id="status"class="form-control mr-1" disabled>
            
          <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Tukar
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">


                <?php 

                $state = $conn->prepare("EXEC dbo.AdminUpdate_GetAllAdminStatus");
                $state->execute();
                $state= $state->fetchAll(PDO::FETCH_ASSOC);

                foreach($state as $row){ ?>

                  <button class="dropdown-item adminStatus" admin_Status= '<?php echo $row["admin_status_name"] ?>' type="button"><?php echo $row["admin_status_name"];?></button>
                <?php
                } 
                ?>

            </div>
          </div>    
        </div>
        
    </div>
    <br />



                
    
   </div>
   <div class="modal-footer">
    <input type="hidden" name="admin_id" id="admin_id" />
    <input type="submit" name="action" id="action" class="btn btn-success" />
    <button type="button" class="btn btn-default" id="closeModal">Batal</button>
   </div>
  </div>
 </div>
</div>

<script src="../sweetalert2/dist/sweetalert2.all.min.js"></script>
<script>

$(document).ready(function(){
 //This JQuery code is for Click on Modal action button for Create new records or Update existing records. This code will use for both Create and Update of data through modal
 $('#action').click(function(){

  Swal.fire({
      title: 'Sudah pasti?',
      text: "",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes'
    }).then((result) => {
      if (result.isConfirmed) {

        var type = $('#type').val(); //Get the value of type name textbox.
        var status = $('#status').val(); //Get the value of status name textbox
        var admin_id = $('#admin_id').val();  //Get the value of hidden field admin id
        var action = "Update";  //Get the value of Modal Action button and stored into action variable
        
         $.ajax({
          url : "action.php",    //Request send to "action.php page"
          method:"POST",     //Using of Post method for send data
          data:{type:type, status:status, admin_id:admin_id, action:action}, //Send data to server
          success:function(data){
               //It will pop up which data it was received from server side
           $('#customerModal').modal('hide'); //It will hide Customer Modal from webpage.
           //self.location = 'adminUpd.php';    // Fetch User function has been called and it will load data under divison tag with id result
          }
         });

        
        Swal.fire({
          title: 'Admin Updated!',
          
          icon :'success',
          showConfirmButton : false
        })
        setTimeout(function(){ self.location = 'adminUpd.php';}, 1000);

      }
    })

  
  

  });





 //For update at the text once choose a type
  $(document).on('click', '.adminTypes', function(){

    var dbType = $(this).attr("admin_Types");
    $('#type').val(dbType);
   });

  $(document).on('click', '.adminStatus', function(){
  var dbStatus = $(this).attr("admin_status");
  $('#status').val(dbStatus);
  });





 //This JQuery code is for Update customer data. If we have click on any customer row update button then this code will execute
 $(document).on('click', '.update', function(){

  var admin_id = $(this).attr("admin_id");
 //This code will fetch any admin id from attribute id with help of attr() JQuery method
  var action = "Select";   //We have define action variable value is equal to select
  $.ajax({
   url:"action.php",   //Request send to "action.php page"
   method:"POST",    //Using of Post method for send data
   data:{admin_id:admin_id, action:action},//Send data to server
   
   dataType:"json",   //Here we have define json data type, so server will send data in json format.
   success:function(data){
    $('#customerModal').modal('show');   //It will display modal on webpage
    $('.modal-title').text("Update Records"); //This code will change this class text to Update records
    $('#action').val("Save");     //This code will change Button value to Update
    $('#admin_id').val(data.admin_id);     //It will define value of id variable to this customer id hidden field
    $('#type').val(data.admin_type_name);  //It will assign value to modal first name texbox
    $('#status').val(data.admin_status_name);
    $('#staff_code').val(data.staff_code); //It will assign value of modal last name textbox
    $('#admin_name').val(data.staff_name);
   }
  });
 });

 //This JQuery code is for Delete customer data. If we have click on any customer row delete button then this code will execute
  

 $('#closeModal').click(function(){

  $('#customerModal').modal('hide');



 })
 
});
</script>




 
