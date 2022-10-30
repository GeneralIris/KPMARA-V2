
<?php

include ('../database_connection.php');
include('../functions.php');




 //This code for Create new Records
 /*
 if($_POST["action"] == "Create")
 {
  $statement = $connection->prepare("
   INSERT INTO customers (first_name, last_name) 
   VALUES (:first_name, :last_name)
  ");
  $result = $statement->execute(
   array(
    ':first_name' => $_POST["firstName"],
    ':last_name' => $_POST["lastName"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Inserted';
  }
 }*/



 //This Code is for fetch single customer data for display on Modal
 if($_POST["action"] == "Select")
 {

  $output = array();
  $statement = $conn->prepare("AdminUpdate_GetModalDatas @adminID=:id");
  $statement->bindValue(':id',$_POST["admin_id"],PDO::PARAM_INT);
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);

  foreach($result as $row)
  {
   $output["staff_code"] = $row["staff_code"];
   $output["staff_name"] = $row["staff_name"];
   $output["admin_id"] = $row["admin_id"];
   $output["admin_status_name"] = $row["admin_status_name"];
   $output["admin_type_name"] = $row["admin_type_name"];

  }
  echo json_encode($output);

 }

 elseif($_POST["action"] == "Update")
 {
  $a = $_POST["type"];
  $b = $_POST["status"];
  $c = $_POST["admin_id"];


  $statement = $conn->prepare(
   "EXEC dbo.AdminUpdate_UpdatingAdmins @type =:a , @status =:b ,@admin_id =:c;"
  );
  $statement->bindValue(':a',$a,PDO::PARAM_STR);
  $statement->bindValue(':b',$b,PDO::PARAM_STR);
  $statement->bindValue(':c',$c,PDO::PARAM_INT);
  $statement->execute();

  
  

 }




?>



