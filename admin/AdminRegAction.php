<?php

	include ('../database_connection.php');
	include('../functions.php');


	if((isset($_POST['Code'])) && (isset($_POST['TypeDecided'])) && (isset($_POST['Id']))){

		$password = password_hash($_POST['Code'],  PASSWORD_DEFAULT);
		$Statement = $conn -> prepare('EXEC dbo.AdminReg_AddNewAdmin @pass=:pass , @id=:id ,@type=:type');
		$Statement -> bindValue(':pass',$password,PDO::PARAM_STR);
		$Statement ->bindValue(':id',$_POST['Id'],PDO::PARAM_INT);
		$Statement ->bindValue(':type',$_POST['TypeDecided'],PDO::PARAM_INT);
		$Statement->execute();
	  //$Statement->bindValue('user',$staffcode ,PDO::PARAM_STR);


	}















?>