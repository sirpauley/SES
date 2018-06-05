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

//Login default value
$returnData["login_success"] = false;

 //including my DBCLASS for doing mySQL data handeling
include("config/config.php");

//Creating a new instance of the db class
$DBCLASS = new DBCLASS();

//getting the data form user table and test the password entered on loging screen against the password saved on the database
$user = $DBCLASS->SELECT("user", "user", $_POST['username']);
$user = $user[0];

//retrieve password entered
$password_entered = md5($_POST["password"]);
$user_password = isset($user['password']) ? $user['password'] : "";

//Test login password entered agains password on the database
if($password_entered === $user['password'] ){
  $returnData["login_success"] = true;

  //set login session
  $_SESSION['LAST_ACTIVITY']   = $time;
  $_SESSION['USER'] = $user['user'];
  $_SESSION['USER_ID'] = $user['ID'];


}else{
  $returnData["login_success"] = false;
}

echo json_encode($returnData);


//close db connection
$DBCLASS->close_connection();

?>
