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

 /************************************************************************************************
 * function for JobLevel descriptions by IDs
 ************************************************************************************************/
function JobPositionByID(){

  //creating a new instance
  $DBCLASSJob = new DBCLASS();

  //get all position in company
  $positions = $DBCLASSJob->SELECT("joblevel");

  $positionsById = array();

  if(isset($positions['SQLsuccess']) != "FASLE"){
    foreach ($positions as $key => $value) {
      $positionsById[$value['ID']] = StrToUpper($value['description']);
    }
  }
  return $positionsById;

  $DBCLASSJob->close_connection();
}

/************************************************************************************************
* function for Users list by IDs
************************************************************************************************/
function UserListByID(){
    //creating a new instance
    $DBCLASSuser = new DBCLASS();

    //get all position in company
    $user = $DBCLASSuser->SELECT("user");

    $user = array();

    if(isset($employees['SQLsuccess']) != "FASLE"){
      foreach ($employees as $key => $value) {
        $user[$value['ID']] = StrToUpper($value['user']);
      }
    }

    $DBCLASSuser->close_connection();

    return $user;
}

/************************************************************************************************
* function for Users list by IDs
************************************************************************************************/
Function EmployeeListByID(){

  //creating a new instance
  $DBCLASSEmployees = new DBCLASS();

  //get all position in company
  $employees = $DBCLASSEmployees->SELECT("employee");

  $employeesList = array();

  if(isset($employees['SQLsuccess']) != "FASLE"){
    foreach ($employees as $key => $value) {
      $employeesList[$value['ID']] = StrToUpper($value['fullname']) . " " . StrToUpper($value['surname']);
    }
  }

  $DBCLASSEmployees->close_connection();

  return $employeesList;
}

?>
