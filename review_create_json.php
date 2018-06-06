<?php
/*******************************************************************************
 *
 * Review create
 *
 * author: sirPauley
 * email: sirpauley@gmail.com
 *
 ******************************************************************************/
//including my DBCLASS for doing mySQL data handeling
include("config/config.php");

//Creating a new instance of the db class
$DBCLASScreateReview = new DBCLASS();

//error detect varaible and error message
$error = false;
$errorMessage = "";
//abcdefghijklmnopqrstuvwxyz

$reviewer = $DBCLASScreateReview->SELECT('employee', 'user_id', $_POST['varReviewerUserID']);
$reviewer = $reviewer[0];

// echo "<pre><h3>_POST</h3>";
// print_r($reviewer);
// echo "</pre>";

//Review information being stored
$review = array('employee_id' => $_POST['varEmployeeID'], 'reviewer_id' => $reviewer['ID'], 'comment'=> $_POST['message'], 'comment_date'=> date('Ymd') );


// echo "<pre><h3>REVIEW</h3>";
// print_r($review);
// echo "</pre>";

  //Insert new Review
  $ReviewCreate = $DBCLASScreateReview->INSERT("review", $review );

  if($ReviewCreate['SQLsuccess'] == "FALSE"){
    $error = true;
    $errorMessage .= "Job level not created \n";
  }



$returnData = array("error" => $error, "errorMessage" => $errorMessage);

//close db connection
$DBCLASScreateReview->close_connection();


echo json_encode($returnData);

?>
