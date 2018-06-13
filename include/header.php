<?php

/*****************************************************
 *
 * Header
 *
 * author: sirPauley
 * email: sirpauley@gmail.com
 *
 *****************************************************/

//including my DBCLASS for doing mySQL data handeling
include_once("config/config.php");

//creating a new instance
$DBCLASSuserInfo = new DBCLASS();

//Get user information
$userInfo = $DBCLASSuserInfo->SELECT('employee', 'user_id', $_SESSION['USER_ID']);
$userInfo = $userInfo[0];

//see output
// print_r($userInfo);
// echo "<br>";
// echo "<br>";

//Get user job level
$userJob = $DBCLASSuserInfo->SELECT('joblevel', 'ID', $userInfo['position_id']);
$userJob = $userJob[0];

//see output
// print_r($userJob);

?>

<header class="page-header row justify-center">
  <div class="col-md-6 col-lg-8" >
    <h1 class="float-left text-center text-md-left"><?php echo $header = (empty($header)) ? "Header" : $header; ?></h1>
  </div>

  <div class="dropdown user-dropdown col-md-6 col-lg-4 text-center text-md-right"><a class="btn btn-stripped dropdown-toggle" href="#" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <div class="username mt-1">
      <h4 class="mb-1"><?php echo strToUpper($userInfo['fullname']) . " " . strToUpper($userInfo['surname']); ?></h4>
      <h6 class="text-muted"><?php echo $userJob['description'] ?></h6>
    </div>
    </a>
    <div class="dropdown-menu dropdown-menu-right" style="margin-right: 1.5rem;" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="profile_current_user.php"><em class="fa fa-user-circle mr-1"></em> View Profile</a>
        <a class="dropdown-item" href="logOut.php"><em class="fa fa-power-off mr-1"></em> Logout</a></div>
  </div>

  <div class="clear"></div>

</header>

<?php
//close db connection
$DBCLASSuserInfo->close_connection();
?>
