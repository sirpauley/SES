<?php

include("config/config.php");

$DBCLASS = new DBCLASS();

$users = $DBCLASS->SELECT("user");

// echo "<pre>";
// print_r($users);
// echo "</pre>";
//
// echo "<br>";


//MD5 encryption for passwords
// $pass = md5("password");
// echo $pass;

//windows push test

?>
