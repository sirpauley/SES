<?php
/*****************************************************
 *
 * logout page
 *
 * author: sirPauley
 * email: sirpauley@gmail.com
 *
 *****************************************************/

//start session
session_start();

// remove all session variables
session_unset();

// destroy the session
session_destroy();

//redirect page to login
header("Refresh:0; url=index.php");

?>
