<?php
/*******************************************************************************
 *
 * REMOVE like to like table
 *
 * author: sirPauley
 * email: sirpauley@gmail.com
 *
 ******************************************************************************/
//including my DBCLASS for doing mySQL data handeling
include("config/config.php");

//Creating a new instance of the db class
$DBCLASSremoveLike = new DBCLASS();

//error detect varaible and error message
$error = false;
$errorMessage = "";

// echo "<pre><h3>_POST</h3>";
// print_r($_POST);
// echo "</pre>";


if(!$error){

  $employeeInfo = $DBCLASSremoveLike->SELECT("employee", "user_id", $_SESSION['USER_ID']);
  $employeeInfo = $employeeInfo[0] ;


  $employeeLikeRemove = $DBCLASSremoveLike->CUSTOM("DELETE FROM likes WHERE employee_id='"  . $employeeInfo['ID'] . "'AND employee_liked_id ='" . $_POST['LikedEmployee'] . "'" );
  //$employeeLikeRemove = $employeeLikeRemove->fetch_assoc();


  if(!$employeeInfo){
    $error = true;
    $errorMessage .= "Employee not Not Liked \n";
  }

}

$returnData = array("error" => $error, "errorMessage" => $errorMessage);

//close db connection
$DBCLASSremoveLike->close_connection();


echo json_encode($returnData);

?>
