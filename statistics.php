<?php
/*****************************************************
 *
 * Statistics
 *
 * author: sirPauley
 * email: sirpauley@gmail.com
 *
 *****************************************************/

//including my DBCLASS for doing mySQL data handeling
include_once("config/config.php");
$header = "STATISTICS";

//creating a new instance
$DBCLASS = new DBCLASS();

//include functions
include_once("include/functions.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="images/favicon.ico">
	<title>Medialoot Bootstrap 4 Dashboard Template</title>

  <!-- Bootstrap core CSS -->
  <link href="lib/medialoot/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Icons -->
  <link href="lib/medialoot/css/font-awesome.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="lib/medialoot/css/style.css" rel="stylesheet">

  <!-- NOTY from https://ned.im/noty-->
  <link href="lib/noty.css" rel="stylesheet">

</head>
<body>

  <div class="container-fluid" id="wrapper">
		<div class="row">

      <!--Menu -->
      <?php
      include_once("include/menu.php");
      ?>

        <main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">

          <!-- Header-->
          <?php include_once("include/header.php"); ?>

          <!-- Code body from here -->
					<?php

					/************************************************************************************************
					* birthdays this month
					************************************************************************************************/
					$Birthdays = $DBCLASS->CUSTOM("SELECT * FROM employee WHERE MONTH(birthday) ='" . date('m') . "' ORDER BY DAY(birthday) ASC");
					//print_r($Birthdays);

					while($row = $Birthdays->fetch_assoc()) {
						$BirthdayArray[] = $row;
					}

					$colorArray = array(
															'text-white bg-primary mb-3', 	//0
															'text-white bg-secondary',			//1
															'text-white bg-success',				//2
															'text-white bg-danger',					//3
															'text-white bg-warning',				//4
															'text-white bg-info',						//5
															'bg-light',											//6
															'text-white bg-dark' 						//7
														);

					if(isset($BirthdayArray) && $BirthdayArray['SQLsuccess'] !== 'FALSE'){
						echo "<h2>UPCOMMING BIRTHDAYS</h2>";
						foreach ($BirthdayArray as $key => $value) {

							if($key == 0){
								echo "<div class='row'>";
							}

							//Employe birthday date convert to ddmm format for better testing
							$time = strtotime($value['birthday']);
							$birthday = date("dm", $time);

							//gettting date today
							//format ddmm(day month)
							$today = date("dm");

							if($birthday === $today){
								$colorCardClass = $colorArray[3];
								$employeeNamePreText = "Happy birthday";
							}else{
								$colorCardClass = $colorArray[1];
								$employeeNamePreText = "EMPLOYEE NAME";
							}


							echo "
							<div class='col-sx-12 col-md-4'>
								<div class='card md-3 " . $colorCardClass . "' >
									<h5 class='card-header'>" . $value['birthday'] . "</h5>
									<div class='card-body'>
										<h5 class='card-title'>" . $employeeNamePreText .": " . $value['fullname'] . " " . $value['surname'] . "</h5>
										<p class='card-text'>TELEPHONE: " . $value['tell'] . "</p>
										<p class='card-text'>EMAIL: " . $value['email'] . "</p>
									</div>
								</div>
							</div>
							";

							if( ($key+1)%3 == 0 ){
								echo "</div>";
								echo "<div class='row'>";
							}

						}//for
						echo "</div>";
					}

					/************************************************************************************************
					* Total number of emloyees
					************************************************************************************************/
					$TotalEmployees = $DBCLASS->CUSTOM("SELECT * FROM employee");
					printf("<div class='col-12'><h4>Total number of employees: </h4>%s</div>", $TotalEmployees->num_rows);
					//print_r($TotalEmployees);

					/************************************************************************************************
					* Total COMMENTS
					************************************************************************************************/
					$TotalComments = $DBCLASS->CUSTOM("SELECT * FROM review");
					printf("<div class='col-12'><h4>Total number of REVIEWS: </h4>%s</div>", $TotalComments->num_rows);
					//print_r($TotalComments);

					/************************************************************************************************
					* Total Likes
					************************************************************************************************/
					$TotalLikes = $DBCLASS->CUSTOM("SELECT * FROM likes");
					printf("<div class='col-12'><h4>Total number of LIKES: </h4>%s</div>", $TotalLikes->num_rows);
					//print_r($TotalLikes);

					echo "<br>";

					/************************************************************************************************
					* Top 10 LIKED employees
					************************************************************************************************/
					echo "<h2>TOP 10 LIKED EMPLOYEES</h2>";

					//all employees
					$employees = EmployeeListByID();

					//print_r($employees);

					//Likes per employee
					$employeeLikes = array();
					foreach ($employees as $key => $value) {
						$likes = $DBCLASS->CUSTOM("SELECT * FROM likes WHERE employee_id = '" . $key . "'");

						$employeeLikes[] = array('employeeID'=>$key, 'numberOfLikes' => $likes->num_rows, 'employeeName' => $value);

					}

					//sort of multi dimensional array
					usort($employeeLikes, function($a, $b) {
    				return  $b['numberOfLikes'] - $a['numberOfLikes'];
					});

					//print_r($employeeLikes);
					// echo "<br>";

					//Creat top 10 string for TOP 10 employees card
					$top10employeeLikesText = "";
					for ($i=1; $i < 11; $i++) {
						$arrayPos = $i -1;
						$top10employeeLikesText .= "<p class='card-text'>" . $i . ". LIKES (" . $employeeLikes[$arrayPos]['numberOfLikes'] . ") - " . $employeeLikes[$arrayPos]['employeeName'] . "</p>";
					}


					echo "
					<div class='col-sx-12 col-md-4'>
						<div class='card md-12 " . $colorArray[5] . "' >
							<h5 class='card-header'>" . "TOP 10 LIKED" . "</h5>
							<div class='card-body'>
								<h5 class='card-title'>" . "EMPLOYEES" ."</h5>
								" . $top10employeeLikesText . "
							</div>
						</div>
					</div>
					";

					echo "<br>";

					?>

      </main>

    </div>
  </div>


  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="lib/medialoot/dist/js/bootstrap.min.js"></script>

	<script src="lib/medialoot/js/bootstrap-datepicker.js"></script>
  <script src="lib/medialoot/js/custom.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

  <!--noty from https://ned.im/noty-->
  <script src="lib/noty.js" type="text/javascript"></script>

  <!--My function library for calling a standard noty function -->
  <script src="lib/noty_function.js" type="text/javascript"></script>

</body>
</html>
