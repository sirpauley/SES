<?php

/*****************************************************
 *
 * Functions for overall use in SYSTEM
 *
 * author: sirPauley
 * email: sirpauley@gmail.com
 *
 *****************************************************/
 //including my DBCLASS for doing mySQL data handeling
 include_once("config/config.php");


 //function for JobLevel descriptions by IDs
function JobPositionByID(){

  //creating a new instance
  $DBCLASSJob = new DBCLASS();

  //get all position in company
  $positions = $DBCLASSJob->SELECT("joblevel");

  $positionsById = array();

  foreach ($positions as $key => $value) {
    $positionsById[$value['ID']] = StrToUpper($value['description']);
  }

  return $positionsById;

  $DBCLASSJob->close_connection();
}


 ?>
