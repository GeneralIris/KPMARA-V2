<?php
	include ('../database_connection.php');
	require '../functions.php';
	
	$path = "../uploads/";

	function loadState($someValue){



	}

	//Listing every city based on state
	if(isset($_POST['sid']) && $_POST['separate']=="GetCity") {


		$stmt = $conn->prepare("EXEC dbo.AlterClinic_GetAllCity @stateCode =:statecode");
		$stmt ->bindParam(':statecode',$_POST['sid'],PDO::PARAM_INT);
		$stmt->execute();
		$city = $stmt->fetchAll(PDO::FETCH_ASSOC);

		echo json_encode($city);
		exit;
		
	}



	//Get Certain Clinic Data for datatable once city being choosed
	elseif (isset($_POST['displayDataTableAfterEnterCity'])){

		$stmt = $conn->prepare("AlterClinic_ListAllClinicBasedOnDropDown @cityCode=:cityCode");
		$stmt->bindParam(':cityCode',$_POST['city'],PDO::PARAM_INT);
		$stmt->execute();
		$table = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($table);
		exit;
		
	}

	//Get every important data for update
	elseif(isset($_POST["action"]) &&  $_POST["action"]=="Select")
	 {

	  $output = array();
	  $statement = $conn->prepare(
	   " EXEC dbo.AlterClinic_ModalView @clinic_id=:clinicID");
	  $statement->bindParam(':clinicID',$_POST['clinic_id'],PDO::PARAM_INT);
	  $statement->execute();
	  $result = $statement->fetchAll(PDO::FETCH_ASSOC);

	  foreach($result as $row)
	  {
	   $output["clinic_id"] = $row["clinic_id"];
	   $output["clinic_code"] = $row["clinic_code"];
	   $output["clinic_name"] = $row["clinic_name"];
	   $output["clinic_owner"] = $row["clinic_owner"];
	   $output["clinic_address"] = $row["clinic_address"];
	   $output["clinic_ph"] = $row["clinic_ph"];
	   $output["clinic_fax"] = $row["clinic_fax"];
	   $output["clinic_email"] = $row["clinic_email"];
	   $output["clinic_start_duty"] = $row["clinic_start_duty"];
	   $output["clinic_end_duty"] = $row["clinic_end_duty"];
	   $output["city_id"] = $row["city_code"];
	   $output["city_name"] = $row["city_name"];
	   $output["city_code"] = $row["city_code"];
	   $output["state_id"] = $row["state_code"];
	   $output["state_name"] = $row["state_name"];
	   $output["state_code"] = $row["state_code"];
	   $output["status_name"]= $row["status_name"];


	   if($row["clinic_picture"]==null){
	   	$output["clinic_picture"]= "NoImage.png";
	   }
	   else{
	   $output["clinic_picture"]= $row["clinic_picture"];
		}

	  }

	  echo json_encode($output);
	  exit;

	 }


	//Perform Save & Create 
	elseif((isset($_POST["action"])) && ($_POST["action"]=="Save")){

		if(preg_match('@[^\w]@', $_POST['clinic_owner'])){
			$newName= str_replace("'", "''", $_POST['clinic_owner']);
		}
		else{
			$newName=$_POST['clinic_owner'];
		}


		$insert = ("EXEC dbo.AlterClinic_UpdateClinic
					@id=".$_POST['clinic_id'].",
					@clinic_code=".$_POST['clinic_code']." 			, 
					@address = '".$_POST['address']."'				,
					@clinic_name ='".$_POST['clinic_name']."'		,
					@clinic_owner ='".$newName."'					,
					@clinic_ph ='".$_POST['clinic_ph']."'			,
					@clinic_fax ='".$_POST['clinic_fax']."'			,
					@clinic_email ='".$_POST['clinic_email']."'		,
					@Sop = '".$_POST['newdateSopr']."',");
		/////////////////////////////////////////////////////////////////////////
		if($_POST['newdateEopr']===""){
			$newdateEopr = "null";
			$insert.= ("@Eop =".$newdateEopr.",");				
		}
		else{
			$insert.= ("@Eop ='".$_POST['newdateEopr']."',");	
		}
		//////////////////////////////////////////////////////////////////////////

		
		$insert.= ("@status_name ='".$_POST['status_name']."'		,
					@state_name ='".$_POST['state_name']."' 		,
					@city_name ='".$_POST['city_name']."'			,");
		

		if($_POST['tempImage']!=""){
		list($imgName,$imgPath) = explode('-',$_POST['tempImage']);

		rename($imgPath,$path.$imgName);

		$insert.= ("@temp_img ='".$imgName."',@rules = 1");
		}
		else{
			$imgName = "null";
			$insert.= ("@temp_img =".$imgName.",@rules = 0");
		}

		$Power = $conn->prepare($insert);
		$Power->execute();

		exit;


	}

	elseif((isset($_POST["action"])) &&  ($_POST["action"]=="Create")){

		
		if(preg_match('@[^\w]@', $_POST['clinic_owner'])){
			$newName= str_replace("'", "''", $_POST['clinic_owner']);
		}
		else{
			$newName=$_POST['clinic_owner'];
		}
		
		$insert = ("EXEC dbo.AlterClinic_AddClinic 
					@clinic_code=".$_POST['clinic_code']." 			, 
					@address = '".$_POST['address']."'				,
					@clinic_name ='".$_POST['clinic_name']."'		,
					@clinic_owner ='".$newName."'					,
					@clinic_ph ='".$_POST['clinic_ph']."'			,
					@clinic_fax ='".$_POST['clinic_fax']."'			,
					@clinic_email ='".$_POST['clinic_email']."'		,
					@Sop = '".$_POST['newdateSopr']."',");
			
		if($_POST['newdateEopr']===""){
			$newdateEopr = "null";
			$insert.= ("@Eop =".$newdateEopr.",");				
		}
		else{
			$insert.= ("@Eop ='".$_POST['newdateEopr']."',");	
		}

		$insert.= ("@state_name ='".$_POST['state_name']."' 		,
					@city_name ='".$_POST['city_name']."'			,");
		


		if($_POST['tempImage']!=""){
		list($imgName,$imgPath) = explode('-',$_POST['tempImage']);

		rename($imgPath,$path.$imgName);

		$insert.= ("@temp_img ='".$imgName."'");
		}
		else{
			$imgName = "null";
			$insert.= ("@temp_img =".$imgName);
		}

		$Power = $conn->prepare($insert);
		$Power->execute();

		exit;

	  }




 ?>