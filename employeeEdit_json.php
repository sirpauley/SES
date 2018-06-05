<?php
/*******************************************************************************
 *
 * Saving change done to employee details
 *
 * author: sirPauley
 * email: sirpauley@gmail.com
 *
 ******************************************************************************/
//including my DBCLASS for doing mySQL data handeling
include("config/config.php");

//Creating a new instance of the db class
$DBCLASScreateEmployee = new DBCLASS();

//error detect varaible and error message
$error = false;
$errorMessage = "";

// echo "<pre><h3>_POST</h3>";
// print_r($_POST);
// echo "</pre>";


if(!$error){

  //Get user ID
  $userData = $DBCLASScreateEmployee->SELECT('user', 'user', $_POST['username']);
  $userData = $userData[0];
  $userID = $userData['ID'];

  $employeeData = array(
                  'user_id'       => $userID,
                  'fullname'      => ucfirst($_POST['fullname']),
                  'surname'       => ucfirst($_POST['surname']),
                  'position_id'   => $_POST['joblevel'],
                  'employed_date' => $_POST['employeddate'],
                  'birthday'      => $_POST['birthday'],
                  'tell'          => $_POST['tell'],
                  'email'         => $_POST['email']
                );

  $employeeCreate = $DBCLASScreateEmployee->UPDATE("employee", 'ID', $_POST['id'], $employeeData );

  if($employeeCreate['SQLsuccess'] == "FALSE"){
    $error = false;
    $errorMessage .= "Employee not created \n";
  }

}

$returnData = array("error" => $error, "errorMessage" => $errorMessage);

//close db connection
$DBCLASScreateEmployee->close_connection();


echo json_encode($returnData);

?>
