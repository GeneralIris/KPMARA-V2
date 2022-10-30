<?php 

//****************** database_connection.php ***********************


$servername = "0064PC174\SQLSERVER";
$username = "sa";
$password = "p@ssw0rd";

try{

	$conn = new PDO ("sqlsrv:Server=$servername;Database=KPMARA2;",$username,$password); // Main PDO db call


	$conn ->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);//Prepare to generate exception


}

	
	catch(Exception $e){
        echo "Exception : " . $e->getMessage();

	}

	//echo "$servername";
	
	
?>
