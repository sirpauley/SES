<?php
/*******************************************************************************
 *
 * Job level create
 *
 * author: sirPauley
 * email: sirpauley@gmail.com
 *
 ******************************************************************************/
//including my DBCLASS for doing mySQL data handeling
include("config/config.php");

//Creating a new instance of the db class
$DBCLASScreateJobLevel = new DBCLASS();

//error detect varaible and error message
$error = false;
$errorMessage = "";

// echo "<pre><h3>_POST</h3>";
// print_r($_POST);
// echo "</pre>";

//JobLevel information being stored
$JobLevelData = array('level' => $_POST['joblevel'], 'description' => $_POST['description']);

$JobLevelDuplicateTest = $DBCLASScreateJobLevel->CUSTOM("SELECT * FROM joblevel WHERE joblevel= " . $_POST['joblevel'] . " OR description=" . $_POST['description']);


//$JobLevelDuplicateTest = $JobLevelDuplicateTest->fetch_assoc();

//$JobLevelDuplicateTest returns with false, it didn't get any records
if(!$JobLevelDuplicateTest['SQLsuccess']){

  //Insert new job level
  $JobLevelCreate = $DBCLASScreateJobLevel->INSERT("joblevel", $JobLevelData );

  if($JobLevelCreate['SQLsuccess'] == "FALSE"){
    $error = true;
    $errorMessage .= "Job level not created \n";
  }

}else{
  $error = true;
  $errorMessage .= "Job level already exist \n";
}


$returnData = array("error" => $error, "errorMessage" => $errorMessage);

//close db connection
$DBCLASScreateJobLevel->close_connection();


echo json_encode($returnData);

?>
