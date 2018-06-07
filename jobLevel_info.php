<?php
/*****************************************************
 *
 * Job level info
 *
 * author: sirPauley
 * email: sirpauley@gmail.com
 *
 *****************************************************/
 //including my DBCLASS for doing mySQL data handeling
 include_once("config/config.php");

 //creating a new instance
 $DBCLASS = new DBCLASS();

$header = "JOB LEVEL INFORMATION";

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="images/favicon.ico">
	<title><?php echo $header; ?></title>

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
      <?php include_once("include/menu.php");  ?>

        <main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">

          <!-- Header-->
          <?php
          include_once("include/header.php");
          ?>

          <!-- Code body from here -->
          <?php
          //get jib level information
          $JobLevel = $DBCLASS->SELECT('joblevel', 'ID', $_GET['id']);
          $JobLevel = $JobLevel[0];

          // print_r($employee);
            printf(
              "<div class='row'>".
                "<div class='col-12 col-md-4'><h6>ID:</h6> %s <br><br></div>" .
                "<div class='col-12 col-md-4'><h6>JOB LEVEL:</h6> %s<br><br></div>" .
                "<div class='col-12 col-md-4'><h6>DESCRIPTION:</h6> %s<br><br></div>" .
              "</div>",
              $JobLevel['ID'],
              $JobLevel['level'],
              $JobLevel['description']
            );
          ?>

        <br>
        <div class='row'>
          <div class='col'><a href="jobLevel.php"><button class="btn btn-warning"><em class="fa fa-arrow-left"></em> Back</button></a></div>
        </div>

        <br>
        <br>
        
      </main>

    </div>
  </div>


  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="lib/medialoot/dist/js/bootstrap.min.js"></script>

  <script src="lib/medialoot/js/chart.min.js"></script>
  <script src="lib/medialoot/js/chart-data.js"></script>
  <script src="lib/medialoot/js/easypiechart.js"></script>
  <script src="lib/medialoot/js/easypiechart-data.js"></script>
  <script src="lib/medialoot/js/bootstrap-datepicker.js"></script>
  <script src="lib/medialoot/js/custom.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

  <!--noty from https://ned.im/noty-->
  <script src="lib/noty.js" type="text/javascript"></script>

  <!--My function library for calling a standard noty function -->
  <script src="lib/noty_function.js" type="text/javascript"></script>

</body>
</html>


<?php

//close db connection
$DBCLASS->close_connection();

?>
