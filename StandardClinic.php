<?php

	include ('database_connection.php');
	require 'functions.php';


	if(isset($_POST['state']) && isset($_POST['city'])){
		
		$AQuery = "SELECT A.clinic_picture,A.clinic_id,A.clinic_name,A.clinic_address,A.clinic_ph,A.clinic_fax,A.clinic_email FROM KPMARA2.kpmara.clinic A JOIN KPMARA2.kpmara.clinic_status D ON A.status_id = D.status_id";
	
		if($_POST['state']!='all' && $_POST['city']!='all'){

			$AQuery.= " WHERE A.city_code =".$_POST['city'];

		}

		elseif ($_POST['state']!='all' && $_POST['city']=='all') {
			$AQuery.= " JOIN KPMARA2.kpmara.city B ON A.city_code = B.city_code JOIN KPMARA2.kpmara.state C ON B.state_code = C.state_code WHERE C.state_code =".$_POST['state'];
		}

		$AQuery.= " AND D.status_id = 1";
		
		$Statement = $conn->prepare($AQuery);
		$Statement->execute();
		$result = $Statement->fetchAll(PDO::FETCH_ASSOC);


	  	echo json_encode($result);

	 }









	























?>