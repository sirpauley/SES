<?php

/*****************************************************
 *
 * Menu
 *
 * author: sirPauley
 * email: sirpauley@gmail.com
 *
 *****************************************************/

$employeeActive = '';
$statisticActive = '';
$jobLevelActive = '';
$phoneBookActive = '';
$reviewActive = '';
$passwordActive = '';

switch ($header) {
  case 'EMPLOYEES':
  case 'EMPLOYEE EDIT PAGE':
  case 'EMPLOYEES INFORMATION':
    $employeeActive = 'active';
    break;
  case 'STATISTICS':
    $statisticActive = 'active';
    break;
  case 'JOB LEVEL':
  case 'JOB LEVEL INFORMATION':
  case 'JOB LEVEL EDIT':
    $jobLevelActive = 'active';
    break;
  case 'PHONEBOOK':
    $phoneBookActive = 'active';
    break;
  case 'PASSWORD UPDATE':
    $passwordActive = 'active';
    break;  
}

?>
<nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2">
  <h1 class="site-title"><a href="index.html"><em class="fa fa-rocket"></em> SES</a></h1>

  <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fa fa-bars"></em></a>
  <ul class="nav nav-pills flex-column sidebar-nav">
    <li class="nav-item"><a class="nav-link <?php echo $employeeActive; ?>" href="home_page.php"><em class="fa fa-user"></em> Employees <span class="sr-only">(current)</span></a></li>
    <li class="nav-item"><a class="nav-link <?php echo $statisticActive; ?>" href="statistics.php"><em class="fa fa-line-chart"></em> Statistics</a></li>
    <li class="nav-item"><a class="nav-link <?php echo $jobLevelActive; ?>" href="jobLevel.php"><em class="fa fa-bar-chart"></em> Job level</a></li>
    <li class="nav-item"><a class="nav-link <?php echo $phoneBookActive; ?>" href="phonebook.php"><em class="fa fa-phone-square"></em> Phone book</a></li>
    <li class="nav-item"><a class="nav-link <?php echo $reviewActive; ?>" href="forms.html"><em class="fa fa-pencil-square-o"></em> Leave a review</a></li>
    <li class="nav-item"><a class="nav-link <?php echo $passwordActive; ?>" href="password.php"><em class="fa fa-clone"></em> Password</a></li>
  </ul>
  <a href="login.html" class="logout-button"><em class="fa fa-power-off"></em> Signout</a>
</nav>
