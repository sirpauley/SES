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
$DBCLASS = new DBCLASS();

//getting the data form user table and test the password entered on loging screen against the password saved on the database
$users = $DBCLASS->SELECT("user");

echo "<pre>";
print_r($_POST);
echo "</pre>";

// echo "<pre>";
// print_r($users);
// echo "</pre>";
//
// echo "<br>";


//MD5 encryption for passwords
// $pass = md5("password");
// echo $pass;

?>