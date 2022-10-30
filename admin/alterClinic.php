<?php

	session_start();
  
  if( !isset($_SESSION["login"])){

    header("Location: adminLogin.php");
    exit;
  }
  include '../database_connection.php';
            
  require 'clinicAction.php';

  //Update new img
  
	  

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
	    <link href="https://code.jquery.com/jquery-3.5.1.js">
	    <link href="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js">
 		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
	    <!-- Theme style -->
	    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
	    <!-- Google Font: Source Sans Pro -->
	    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	    <style>
			.picDIV {
				width: 70%;
				margin: 0 auto;
				padding: 50px;
	
			}
			#preview
				{
				 max-width:1000px;
				}
			#ClinicImage{
				display: block;
				margin-left: auto;
			  	margin-right: auto;
				max-width:1500px;
				}
			.center {
			  display: block;
			  margin-left: auto;
			  margin-right: auto;
			  width: 100%;
			}
			.required
			{
			    color: red;
			    
			}
			.modal-body {
			    
			    
			    

			}
			.modal-header {
			    
			}
			.modal-footer {
			    
			}
			.force-scroll {
				max-height: 500px;
				max-width: 400px;
				overflow: auto;
				

			}
		</style>
		



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
		          <li class="nav-item has-treeview menu-open">
		            <a href="#" class="nav-link">
		              <i class="nav-icon fas fa-copy"></i>
		              <p>
		                Clinic Panel MARA
		                <i class="fas fa-angle-left right"></i>
		              </p>
		            </a>
		            
		            <ul class="nav nav-treeview">
		              
		              <li class="nav-item">
		                <a href="#"class="nav-link active">
		                  <i class="far fa-circle nav-icon"></i>
		                  <p> Alter Clinic </p>
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
	<div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <section class="content-header">
        
      </section>
     
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-12">


            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Senarai Panel Klinik MARA</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form role="form">
                  <?php
					$state = query("EXEC dbo.AlterClinic_GetAllState");
                  ?>

                  
                  <div class="row">
                    <div class="col-sm-3">
                      <!-- select -->
                      <div class="form-group">
                        <label>Negeri</label>
                        <select class="form-control" id='state'name='state'>
                          <option selected="" disabled="">Pilih Negeri</option>
                          


                          <?php 


                          foreach($state as $x){

                          	echo "<option value='  ".$x['state_code']."   '  > ".$x['state_name'] ."</option>";

                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <!-- select -->
                      <div class="form-group city">
                        <label>Daerah</label>
                        <select class="form-control" id='city' name='city'>
                          
                        </select>
                      </div>
                    </div>
                  </div>
                    <div align="right">
					    <button type="button" id="createButton" class="btn btn-info">Tambah</button>
					    <!-- It will show Modal for Create new Records !-->
					</div>
                    
                  
                  <div class="row">
		            <div class="col-12">
		              <div class="card">
		                <div class="card-header">
		                  <h3 class="card-title"></h3>
		                </div>
		                <!-- /.card-header -->
		                <div id="result" class="card-body">  <!-- Hopefully display here -->

		                	<?php

		                	$listAllClinics = query("EXEC dbo.AlterClinic_GetAllClinicAsGlobal");

		                	?>


		                  <table id="example1" class="table table-bordered table-striped">
		                    <thead>
		                      <tr>
		                        <th>ID</th>
		                        <th>Nama Klinik</th>
		                        <th>Kod Klinik</th>
		                        <th>Emel</th>
		                        <th>No. Telefon </th>
		                        <th>Status</th>
		                        <th>Tindakan</th>
		                      </tr>
		                    </thead>

		                    <tbody>
		                      	<?php
		                      	foreach($listAllClinics as $row)
		                       	{ ?>
		                        
                          
		                            <tr>
		                              <td><?php echo$row["clinic_id"];?></td>
		                              <td><?php echo$row["clinic_name"]; ?></td>
		                              <td><?php echo$row["clinic_code"]; ?></td>
		                              <td><?php echo$row["clinic_email"]; ?></td>
		                              <td><?php echo$row["clinic_ph"]; ?></td>
		                              <td><?php echo$row["status_name"] ?></td>
		                              <td><button type='button' clinic_id='<?php echo $row["clinic_id"];?>' class='btn btn-dark update center'>Update</button></td>
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
                </form>
              </div>
              <!-- /.card-body -->

				











            </div>
            <!-- /.card -->
           </div>
          </div>
         </div>
       
       </section>


   		</div>



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

		        <!-- jQuery -->
		<script src="../plugins/jquery/jquery.min.js"></script>
		<script src="http://malsup.github.com/jquery.form.js"></script> 
		<!-- Bootstrap 4 -->
		<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- DataTables -->
		<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
	 	<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
		<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
		<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
		<script src="../plugins/moment/moment.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
		<script src="../sweetalert2/dist/sweetalert2.all.min.js"></script>

		<!-- AdminLTE App -->
		<script src="../dist/js/adminlte.min.js"></script>


		<script>



			////////////////////////////////////////////////////////////////////////
  		$(function () {

  			$('#reservationdate').datetimepicker({
        		format: 'DD/MM/YYYY'
    		});
    		$('#reservationdate1').datetimepicker({
        		format: 'DD/MM/YYYY'
    		});
  		});
  		////////////////////////////////////////////////////////////////////////






  		</script>
  		
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
		  
		
		<script>
		$(document).ready(function(){
			
			//To prepare city list once user chooses a state:

			$("#state").change(function(){
				//$('#example1').DataTable().clear().draw();
				
				var sid = $("#state").val(); //State Code
				var separate = "GetCity";
				$.ajax({
					url: 'clinicAction.php',
					method: 'post',
					data: {sid:sid,separate:separate}				//pass data from right to left [ pass right data[recieve] into left using sid[to other page]]
				}).done(function(City){
					City = JSON.parse(City); // Change to object to use city1 . [city_id]/ [city_name]...etc
					$('#city').empty();

					if(City==''){
					
						$('.city').hide();
						
					}
					else{
						$('.city').show();
						$('#city').append('<option selected="" disabled="">Choose a city</option>');
						//Clears city content once done with one city
						City.forEach(function(city1){		//Does the same like PHP for each
							$('#city').append('<option value=' + city1.city_code + ' name = ' + city1.city_name + ' >' + city1.city_name + '</option>')  //Append same as concat but does it under <select id...>
						})
					}
				})

			})

			//DataTable Display!!
			//After user choose a city then it will directly show data table :
			
			$("#city").change(function(){
				$('#example1').DataTable().clear().draw();
				
				var city = $('#city').val();

				var displayDataTableAfterEnterCity = true;
				$.ajax({
					url:'clinicAction.php',
					method: 'post',
					data: {city:city,displayDataTableAfterEnterCity:displayDataTableAfterEnterCity}

				}).done(function(Data){
					Data = JSON.parse(Data);
					Data.forEach(function(TableData){
						$("#example1").DataTable().row.add([

							TableData.clinic_id,TableData.clinic_name,TableData.clinic_code,TableData.clinic_email,TableData.clinic_ph,TableData.status_name,"<button type='button' clinic_id='"+TableData.clinic_id+"' class='btn btn-dark update center '>Update</button>"

							]).draw();


					})


				})

				



			})

		});

		</script>
		<!-- END OF MAIN DATATABLE & DISPLAY-->
		  
		
	</body>

	
</html>
<!----------------------------- Custom Stuff --------------------->
<!-- Modal [Pop Up Form]-->



<!--


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

								////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
								////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
								//																														  //
								//					//	    /\			  ///////////  //////////		  //	      //								  //
								//				   ////    //\\  		 //       //  //		//      // //		 //									  //
								//				  // //   //  \\		//       //  //			 //   //////// 	    //									  //
								//				 //   // //	   \\	   //	    //  //         //   //       //    //									  //
								//				//     ///      \\	  ///////////  ////////////   //          //  //////////							  //
								//			   																											  //
								////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
								////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


-->

<div id="clinicModal" class="modal fade " data-backdrop="static" data-keyboard="false">
 <div class="modal-dialog mw-100 w-75">
  <div class="modal-content">
   <div class="modal-header">
    <h4 class="modal-title">Kemaskini </h4>
   </div>
   <div class="modal-body">
   		<div class="container-fluid">

		    <div class="row sneaky">
		    	<img id="ClinicImage" src="" alt="Clinic Image" width='500'>
		    </div>
		    <br/>
		    <br/>

		    <form id="imageform" method="post" enctype="multipart/form-data" action='ajaximage.php'>
		    	<div class="row">
		    		<div class="col-md-5 imgDesc">
					<strong>Update image & Save</strong> 
					</div>
					<div class="col-md-5 col-md-offset-5">
						<input type="file" name="photoimg" id="photoimg"  />
					</div>
					<div id="preview">
					</div>
					
				</div>
			</form>
			<br/>
			<br/>
			
	        	

    		<div class="row">
    			<div class="col-md-5 showClinicID">
				    <label>ID</label>
				    <input type="text" name="id" id="id" disabled value=''autocomplete="off" required class="form-control" />
				</div>
			    <div class="col-md-5 col-md-offset-5 ">
				    <label>Kod Klinik</label>
				    <span class="required">*</span>
				    <input type="text" name="Code" id="code"  autocomplete="off" required class="form-control" />
			    </div>
			</div>
			<br/>

			<div class="row">  
				<div class="col-md-5">  
				    <label>Nama Klinik</label>
				    <span class="required">*</span>
				    <input type="text" name="name" id="name"  autocomplete="off" required class="form-control" />
			    </div>
			    <div class="col-md-5 col-md-offset-5">
				    <label>Pemilik Klinik</label>
				    <input type="text" name="owner" id="owner"  autocomplete="off" required class="form-control" />
			    </div>
			    
			</div>
			<br/>
			<div class="row">  
				<div class="col-md-6">  
					<label>Alamat</label>
					<span class="required">*</span>
					<input type="text" name="address" id="address"  autocomplete="off" required class="form-control" />
				</div>

			</div>
			<div class="row">  
				<div class="col-md-6">  
					<label>Emel</label>
					   <input type="text" name="email" id="email"  autocomplete="off" required class="form-control" />
				</div>

			</div>
			<br/>
			<div class="row">  
				<div class="col-md-5">  
					<label>No. Telefon</label>
					<span class="required">*</span>
					   <input type="text" name="ph" id="ph"  autocomplete="off" required class="form-control" />
					   <br/>
				</div>
				<div class="col-md-5 col-md-offset-5">
					<label>No. Faks</label>
					   <input type="text" name="fax" id="fax"  autocomplete="off" required class="form-control" />
					   <br/>
				</div>
			</div>
			<div class="row">  
				<div class="col-md-5">  
				    <label>Mula Operasi</label>
				    <span class="required">*</span>  
	                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
		                        <input type="text" id="Sopr" required autocomplete="off" class="form-control datetimepicker-input" data-target="#reservationdate"/>
		                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
		                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
		                        </div>
		                </div>
				    <br/>
				</div>
				<div class="col-md-5 col-md-offset-5">
					<label>Tamat Operasi</label> 
	                    <div class="input-group date" id="reservationdate1" data-target-input="nearest">
		                        <input type="text" id="Eopr" autocomplete="off" class="form-control datetimepicker-input" data-target="#reservationdate1"/>
		                        <div class="input-group-append" data-target="#reservationdate1" data-toggle="datetimepicker">
		                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
		                        </div>
		                </div>
				    <br/>
			    </div>
			</div> 

				

			<div class="row ShowStatus">
				<div class="col-md-5"> 	
			        <label>Status</label>
			    	<div class="form-inline">
			          <input type="text" name="status" id="status"class="form-control mr-1" disabled>
			            
			          <div class="dropdown">
			            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                Tukar
			            </button>
			            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">


			                <?php 

			                $state = $conn->prepare("EXEC dbo.AlterClinic_GetClinicStatus");
			                $state->execute();
			                $state= $state->fetchAll(PDO::FETCH_ASSOC);

			                foreach($state as $row){ ?>

			                  <button class="dropdown-item clinicStatus" clinic_Status= '<?php echo $row["status_name"] ?>' type="button"><?php echo $row["status_name"];?></button>
			                <?php
			                	} 
			                ?>

			            </div>
			          </div>    
			        </div>
			        
				</div>
			</div>

	    	<br />
	    		
			<label>Negeri</label>
			<span class="required">*</span>
			<div class="row">
				<div class="col-md-5"> 
			    	<input type="text" name="AState" id="AState"class="form-control mr-1" disabled>
			   	</div>
			   	<div class="col-md-5 col-md-offset-5">


			   		<div class="dropdown" id="StateDropDown">
			            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                Tukar Negeri
			            </button>
			            <div class="dropdown-menu states" aria-labelledby="dropdownMenu2">


			                <?php 

			                $Statement = $conn -> prepare("EXEC dbo.AlterClinic_GetAllState");
							$Statement->execute();
							$state = $Statement->fetchAll(PDO::FETCH_ASSOC);

			                foreach($state as $row){ ?>

			                  <button class="dropdown-item state" id='<?php echo$row['state_code']?>'stateName= '<?php echo $row["state_name"] ?>' type="button"><?php echo $row["state_name"];?></button>
			                <?php
			                } 
			                ?>

			            </div>
          			</div> 
			    </div>
			</div>
			<br/>
		    <label>Bandar</label>
		    <span class="required">*</span>
		    <div class="row">
				<div class="col-md-5">
		    		<input type="text" name="cityName" id="cityName"class="form-control mr-1" disabled>
		    	</div>
		    	<div class="col-md-5 col-md-offset-5">
					<div class="dropdown" id="CityDropDown">
			            <button class="btn btn-secondary dropdown-toggle clickMe" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                Tukar Bandar
			            </button>
			            <div class="dropdown-menu cities force-scroll" aria-labelledby="dropdownMenu2">



			            </div>

          			</div> 


				</div>
			</div>

	   </div>
	   <div class="modal-footer">
	    <input type="hidden" name="clinic_id" id="clinic_id" />
	    <input type="hidden" name="state_id" id="state_id" />
	    <input type="hidden" name="city_id" id="city_id" />
	    <input type="hidden" name="tempCity" id="tempCity" />
	    <input type="hidden" name="tempState" id="tempState" />
	    <input type="hidden" name="tempImage" id ="tempImage"/>
	    <input type="hidden" name="anoynomousSession" id="anoynomousSession" value="<?php echo $_SESSION['access']?>" />
	    <input type="submit" name="action" id="action" class="btn btn-success" />
	    
	    <button type="button" class="btn btn-default" id="cancel" data-dismiss="modal">Close</button>
		</div>
    </div>
  </div>
 </div>
</div>
<script>
	$(document).ready(function() {

		$('#photoimg').on('change', function(){

			
			$("#preview").html('');
			var clinicID = $("#id").val();
			var action = $("#action").val();
			$("#imageform").ajaxForm({
				url: "ajaximage.php",
				target: "#preview",
				method:"post",
				data:{clinicID:clinicID,action:action},
				
			}).submit();


		});
	})
	
</script>



<script>



$(document).ready(function(){

				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				//																														  //
				//									   //////////      //////////    //       //    ////////							  //
				//									  //		      //	  //	//	     //    //	    //							  //
				//									 //              //////////	   //       //    //		 //							  //
				//							        //              //	  //   	  //	   //    //		   //							  //
				//								   ///////////     //	   //	 ///////////    ///////////								  //
				//																														  //
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




  	$('#createButton').click(function(){
  	   $('.sneaky').hide();
	   $('#clinicModal').modal('show'); //It will load modal on web page
	   $('#first_name').val(''); //This will clear Modal first name textbox
	   $('#last_name').val(''); //This will clear Modal last name textbox
	   $('.modal-title').text("Create New Records"); //It will change Modal title to Create new Records
	   $('.imgDesc').text("Add Image");
	   $('#action').val('Create'); //This will reset Button value ot Create  
	   $('.showClinicID').hide();      
	   $('#code').val(''); 
	   $('#name').val('');
	   $('#owner').val('');
	   $('#ph').val('');
	   $('#fax').val(''); 
	   $('#email').val('');
	   $('.ShowStatus').hide();
	   $('#AState').val('');
	   $('#cityName').val('');
	   $('#Sopr').val('');
	   $('#Eopr').val('');
	   $('#address').val('');
	  

	  //Hold the temp stored image until it is ready to save into database
	  //Else we remove it if they dont want it?? BUTTTT WHYYY???
	  //Cause im using a function for 2 seperate action (Update and Add)[Dynamic] for future use.
	   $("#tempImage").val('');


   	});
 //This JQuery code is for Click on Modal action button for Create new records or Update existing records. This code will use for both Create and Update of data through modal


	

  //Once Click Update
	$(document).on('click', '.update', function(){

	    var clinic_id = $(this).attr("clinic_id");
	    $("#photoimg").val('');
	 //This code will fetch any admin id from attribute id with help of attr() JQuery method
	    var action = "Select";   //We have define action variable value is equal to select
	    $.ajax({
		   url:"clinicAction.php",   
		   method:"POST",    //Using of Post method for send data
		   data:{clinic_id:clinic_id, action:action},//Send data to server
		   
		   dataType:"json",   //Here we have define json data type, so server will send data in json format.
		   success:function(data){
			   	$('.sneaky').show();
			   	$('.imgDesc').text("Update Image And Save");
			    $('#clinicModal').modal('show');   //It will display modal on webpage
			    $('.modal-title').text("Update Records"); //This code will change this class text to Update records
			    $('#action').val("Save");     
			    $('#id').val(clinic_id);
			    $('.showClinicID').show();        
			    $('#code').val(data.clinic_code); 
			    $('#name').val(data.clinic_name);
				$('#owner').val(data.clinic_owner);
			    $('#ph').val(data.clinic_ph);
			    $('#fax').val(data.clinic_fax); 
			    $('#email').val(data.clinic_email);
			    $('#status').val(data.status_name);
			    $('#address').val(data.clinic_address);
			    if($('#anoynomousSession').val()==1){
			    	$('.ShowStatus').show();
			    }
			    else{
			    	$('.ShowStatus').hide();
			    }
			    
				$('#AState').val(data.state_name);
				$('#cityName').val(data.city_name);
				$('#Sopr').val(data.clinic_start_duty);
				$('#Eopr').val(data.clinic_end_duty); 
				document.getElementById("ClinicImage").src = "../uploads/"+data.clinic_picture;

				//Below here is the default one... WHY??//
				//Cause when user change any value...i need to restore the default value WITHOUT page refreshing....maybe call db again might work
				//Above one used once data confirmed and ready to update the data into db
				//Do NOT use the variable below FOR UPDATING!!
				$('#state_id').val(data.state_id);
				$('#city_id').val(data.city_id);
				$('#tempState').val(data.state_name);
				$('#tempCity').val(data.city_name);


				// Dis one will auto prepare the city IF user dont wanna change no state. [Same State] Easier and Faster
				var sid = $("#state_id").val();
			  	var separate ="GetCity";

			  	$.ajax({
			  		url: 'clinicAction.php',
					method: 'post',
					data: {sid:sid,separate:separate}		
			  	}).done(function(Stuff){
			  		Stuff = JSON.parse(Stuff);
			  		$('.cityList2').remove();
					Stuff.forEach(function(MoreStuff){		//Does the same like PHP for each
						$('.cities').append("<button class='dropdown-item cityList2' cityName2='" +MoreStuff.city_name+ "'>" +MoreStuff.city_name + "</button>")
					})
			  	})
	  		}
	 	})
	});





	//Fake instant update
  	// Update  value in the text input once choosen a value
    $(document).on('click', '.state', function(){
	  	var dbState = $(this).attr("stateName");
	    $('#AState').val(dbState);
  	});

    $(document).on('click', '.cityList2', function(){
	  	var dbCity = $(this).attr("cityName2");
	    $('#cityName').val(dbCity);
    });

    $(document).on('click', '.clinicStatus', function(){
	    var dbStatus = $(this).attr("clinic_Status");
	    $('#status').val(dbStatus);	
    });

    // END Fake instant update




    //
    // Dependency where display city by state
	$(document).on('click', '.state', function(){
		var sid = $(this).attr("id");
		var separate = "GetCity";
		$.ajax({
			url: 'clinicAction.php',
			method: 'post',
			data: {sid:sid,separate:separate}				//pass data from right to left [ pass right data[recieve] into left using sid[to other page]]
		}).done(function(City1){
			City1 = JSON.parse(City1); // Change to object to use city1 . [city_id]/ [city_name]...etc
				$('.cityList2').remove();

				if(City1==''){
					var temp = $('#AState').val();
					
					$('.cities').append(" <button class='dropdown-item cityList2' cityName2='' disabled>No City In Database</button>")
					$('#cityName').val("No city detected");
				}
				else {

					if($('#tempState').val()===$('#AState')){
					$('#cityName').val($('#tempCity').val());
					}
					else{
						$('#cityName').val("Enter a city");

					}

					$('#CityDropDown').show();
					
					//Clears city content once done with one city
					City1.forEach(function(city2){
							//Does the same like PHP for each
					$('.cities').append(" <button class='dropdown-item cityList2' cityName2='" +city2.city_name+ "'>" +city2.city_name + "</button>")  //Append same as concat but does it under <select id...>
					})
				}
		})

	});



				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				//																														  //
				//				      //		 /////////   //////////   ///////////    ///////////     //       //   ////////			  //
				//				    // //		//		        //		      //		//	     //		////  	 //   //				  //
				//				  //    //     //              //			 //		   // 		//	   //  //   //	 /////////			  //
				//				///////////   //              //			//        //       //     //     ////          //		      //
				//			  //          // ///////////     //		   //////////	 ///////////     //       //    ////////			  //
				//																														  //
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

				//Button SAVE & CANCEL





 	$('#action').click(function(){



		Swal.fire({
		  title: 'Confirm?',
		  showDenyButton: true,
		  showCancelButton: false,
		  confirmButtonText: `Yes`,
		  denyButtonText: `Not Yet!`,
		}).then((result) => {
		 
		  if (result.isConfirmed) {

			  	var action = $("#action").val();   
			    var clinic_id =$('#id').val(); 
			    var clinic_code = $('#code').val(); 
			    var clinic_name = $('#name').val();
			    var clinic_owner = $('#owner').val();
			    var clinic_ph = $('#ph').val();
			    var clinic_fax = $('#fax').val(); 
			    var clinic_email = $('#email').val();
			    var status_name = $('#status').val();
			    var state_name = $('#AState').val();
			    var city_name = $('#cityName').val();
			    var clinic_start_duty = $('#Sopr').val();
			    var clinic_end_duty = $('#Eopr').val();
			    var tempImage = $("#tempImage").val();
			    var address = $('#address').val();


			    var Filters = /[\W]/g;

			    if(clinic_code=="" || clinic_name=="" || clinic_ph=="" || state_name=="" || city_name=="No city detected" || clinic_start_duty=="" || city_name=="Enter a city" || address==""){

			    	Swal.fire({
					  icon: 'error',
					  title: 'Oops...',
					  text: 'Pastikan Semua Maklumat Diisi dengan betul',
					}).then(function() {
				    	return;
					});

					return;
			    	
			    }
			    else {
			    	
			    	if(clinic_code.match(Filters)!=null){
			    	document.getElementById('code').value = '';
			    	alert("Please remove any special Characters from Clinic Code");
			    	return;
			    	}

					if(clinic_owner==""){
			    		clinic_owner='Unknown';
			    	}
			    	

			    	var newdateSopr = clinic_start_duty.split("/").reverse().join("-");
			   		var newdateEopr = clinic_end_duty.split("/").reverse().join("-");

			    }
			   	$.ajax({
			    url : "clinicAction.php",    //Request send to "action.php page"
			    method:"POST",     //Using of Post method for send data
			    data:{clinic_code:clinic_code, clinic_name:clinic_name, 
			    	  clinic_id:clinic_id, action:action, clinic_owner:clinic_owner,
			    	  clinic_ph:clinic_ph,clinic_fax:clinic_fax,clinic_email:clinic_email,
			    	  status_name:status_name,state_name:state_name,city_name:city_name,
			    	  newdateSopr:newdateSopr,newdateEopr:newdateEopr,
			    	  tempImage:tempImage,address:address
			    	  }, //Send data to server
			    success:function(){
			      $('#photoimg').val(''); 
			        //It will pop up which data it was received from server side
			      $('#clinicModal').modal('hide'); //It will hide Customer Modal from webpage.

			   	}
					
			    });

			   	//Display output when press save and redirect back when press ok
			    Swal.fire('Saved!', '', 'success').then(function() {
				    window.location="alterClinic.php";
				});

		  } else if (result.isDenied) {

		    Swal.fire('Tiada Sebarang Perubahan akan dibuat', '', 'info')
		    return;
		  }
		})
  	});

 	$("#cancel").click(function(){
 		$('#photoimg').val(''); 
 	});

 	

});
</script>
<!--
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-->

