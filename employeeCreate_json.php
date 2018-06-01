<?php
/*******************************************************************************
 *
 * This is mainly for testing the login details entered on the login page
 * Doing the validation through Javascript
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

//check if user already exist
$userExist = $DBCLASScreateEmployee->SELECT('user', 'user', $_POST['username']);
if($userExist['SQLsuccess'] != "FALSE"){
  $error = true;
  $errorMessage .= "User Already exist.\n";
}

//check if employee already exist
$employeeExist = $DBCLASScreateEmployee->SELECT('employee', 'fullname', $_POST['fullname'] );
if($employeeExist['SQLsuccess'] != "FALSE"){
  $error = true;
  $errorMessage .= "Employee Already exist.\n";
}

//test for error and try to create employee
if(!$error){

  //Create user
  $_POST['password'] = md5($_POST['password']);
  $userData = array('user' => $_POST['user'], 'password'=> $_POST['password']);
  $userCreate = $DBCLASScreateEmployee->INSERT("user", $userData );

  if($userCreate['SQLsuccess'] == "FALSE"){
    $error = false;
    $errorMessage .= "User not created \n";
  }


}

if(!$error){

  //Get user ID
  $userData = $DBCLASScreateEmployee->SELECT('user', 'user', $_POST['username']);
  $userData = $userData[0];
  $userID = $userData['ID'];

  $employeeData = array(
                  'fullname'      => $_POST['fullname'],
                  'surname'       => $_POST['surname'],
                  'position_id'   => $_POST['joblevel'],
                  'employed_date' => $_POST['employeddate'],
                  'birthday'      => $_POST['birthday'],
                  'tell'          => $_POST['tell'],
                  'email'         => $_POST['email']
                );

  $employeeCreate = $DBCLASScreateEmployee->INSERT("employee", $employeeData );

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
