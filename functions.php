<?php 

	//connection to database
	//$connect = mysqli_connect("localhost","sa","p@ssw0rd","kpmara");
	include 'database_connection.php';
        

	function query($query){

		global $conn;
		$statement=$conn->prepare($query);
		$statement->execute();
		$ActualResult = $statement->fetchAll(PDO::FETCH_ASSOC);
		$rows = [];

		$rows=$ActualResult;
		
		return $rows;
	}




	/*function get_total_all_records()
	{
	 global $conn;
	 $statement = $conn->prepare("SELECT kpmara.staff.staff_code,kpmara.staff.staff_name,kpmara.staff.staff_ph ,kpmara.admin.admin_id , kpmara.staff.staff_email,kpmara.admin_status.admin_status_name, kpmara.admin_type.admin_type_name FROM kpmara.admin JOIN kpmara.staff ON kpmara.staff.staff_id = kpmara.admin.staff_id JOIN kpmara.admin_status ON kpmara.admin.admin_status_id = kpmara.admin_status.admin_status_id JOIN kpmara.admin_type ON kpmara.admin.admin_type_id = kpmara.admin_type.admin_type_id");
	 $statement->execute();
	 $result = $statement->fetchAll();
	 return $statement->rowCount();
	}
	*/
	
 ?>