<?php
/*******************************************************************************
 *
 * Saving change done to job level details
 *
 * author: sirPauley
 * email: sirpauley@gmail.com
 *
 ******************************************************************************/
//including my DBCLASS for doing mySQL data handeling
include("config/config.php");

//Creating a new instance of the db class
$DBCLASSeditJoblevel = new DBCLASS();

//error detect varaible and error message
$error = false;
$errorMessage = "";

// echo "<pre><h3>_POST</h3>";
// print_r($_POST);
// echo "</pre>";


if(!$error){

  $jobLevelData = array(
                  'level'       => $_POST['joblevel'],
                  'description' => $_POST['description']
                );

  $employeeCreate = $DBCLASSeditJoblevel->UPDATE("joblevel", 'ID', $_POST['id'], $jobLevelData );

  if($employeeCreate['SQLsuccess'] == "FALSE"){
    $error = true;
    $errorMessage .= "Job level not created \n";
  }

}

$returnData = array("error" => $error, "errorMessage" => $errorMessage);

//close db connection
$DBCLASSeditJoblevel->close_connection();


echo json_encode($returnData);

?>
