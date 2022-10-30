<?php
	include ('../database_connection.php');
	require '../functions.php';
		
	$session_id='1';
	$path = "../uploads/";
	$valid_formats = array("jpg", "png", "gif", "bmp","jpeg");
	
	$getExistingCode = query("SELECT clinic_picture FROM KPMARA2.kpmara.clinic");

	$escape = false;


	if((isset($_POST)) && ($_SERVER['REQUEST_METHOD'] == "POST") && (isset($_FILES['photoimg']))){


		$name = $_FILES['photoimg']['name'];
		$size = $_FILES['photoimg']['size'];
		if(strlen($name)){


			 $names= explode(".", $name);
			 $txt = reset($names);
			 $ext = end($names);
			$RealExt = strtolower($ext);
			if(in_array($RealExt,$valid_formats)){

				if($size<5242880){ /* Image size max 5 MB*/

					while($escape ==false){
						$imgCode = bin2hex(random_bytes(50));
						foreach($getExistingCode as $rows){

							if($imgCode!=$rows){
								$escape = true;
							}
							
						}
					

					}
					//Update Stuff  [FOR UPDATE ONLY NOT ADD]
					if((isset($_POST['clinicID']) && (!empty($_POST['clinicID']))) && ($_POST['action']=='Save')){

						$getNewExistingCode = query("SELECT TOP 1 clinic_picture FROM KPMARA2.kpmara.clinic WHERE clinic_id =".$_POST['clinicID']);
						
						if($getNewExistingCode!=""){
							@unlink('../uploads/'.$getNewExistingCode[0]['clinic_picture']);
						} //End IF

					}

					$actual_image_name = $imgCode.".".$ext;
					$tmp = $_FILES['photoimg']['tmp_name'];
		

					if($_FILES['photoimg']['error']==0)
					{
						/*if((isset($_POST['action']))&&($_POST['action']=='Save')){
							move_uploaded_file($tmp, $path.$actual_image_name);

							$UpdateIMG = $conn-> prepare("UPDATE KPMARA2.kpmara.clinic SET clinic_picture ='".$actual_image_name."' WHERE clinic_id =".$_POST['clinicID']);
							$UpdateIMG->execute();
							$msg= "Successfully Updated Image";

							echo "	<script> 


									document.getElementById('ClinicImage').src = '../uploads/".$actual_image_name."';

									</script>";
									
						}*/
						if((isset($_POST['action']))&& (($_POST['action']=="Create") || ($_POST['action']=='Save'))){

							move_uploaded_file($tmp, $tmp);
							$Newtmp = str_replace('\\','\\\\',$tmp);
							
							echo "	<script>
												
									$('#tempImage').val('".$actual_image_name."-".$Newtmp."');
									
									</script>";

 							$msg="Image Added";

 							
						}
					}
					else
					$msg= "failed";


				}
				else{
				$msg= "Image file size max 5 MB";
				}
			}
			else
			$msg= "Invalid file format..";
		}
		else
		$msg= "Please select image..!";

		
		
	}

	else{

		exit;
	}	
	echo "<script> alert('$msg');</script>";

	
?>