<?php
/*******************************************************************************
 *
 * Change password
 *
 * author: sirPauley
 * email: sirpauley@gmail.com
 *
 ******************************************************************************/
//including my DBCLASS for doing mySQL data handeling
include("config/config.php");

//print_r($_POST);

//Creating a new instance of the db class
$DBCLASSpassword = new DBCLASS();

//error detect varaible and error message
$error = false;
$errorMessage = "";

// echo "<pre><h3>_POST</h3>";
// print_r($_POST);
// echo "</pre>";

//Get current password
$userData = $DBCLASSpassword->SELECT('user', 'ID', $_POST['id']);
$userData = $userData[0];

//old password 
$oldPassword = md5($_POST['oldPassword']);

//new Password
$newPassword = md5($_POST['newPassword']);

if($userData['password'] !== $oldPassword){
    $error = true;
    $errorMessage = "Old password doesn't match!";
}

if(!$error){



  $userData = array('password' => $newPassword);

  $userPasswordUpdate = $DBCLASSpassword->UPDATE("user", 'ID', $_POST['id'], $userData );

  if($userPasswordUpdate['SQLsuccess'] == "FALSE"){
    $error = true;
    $errorMessage = "Password not updated";
  }

}

$returnData = array("error" => $error, "errorMessage" => $errorMessage);

//close db connection
$DBCLASSpassword->close_connection();


echo json_encode($returnData);

?>
