<?php
/*****************************************************
 *
 * Employee Edit page
 *
 * author: sirPauley
 * email: sirpauley@gmail.com
 *
 *****************************************************/
//including my DBCLASS for doing mySQL data handeling
include_once("config/config.php");

//include functions
include_once("include/functions.php");
$positions = JobPositionByID();

//creating a new instance
$DBCLASS = new DBCLASS();

//get employ information
$employee = $DBCLASS->CUSTOM("SELECT e.*, jl.description, u.user
FROM employee e 
LEFT JOIN joblevel jl ON e.position_id = jl.ID
LEFT JOIN user u on e.user_id = u.ID 
WHERE e.ID = " . $_GET['id']);

$employee = $employee->fetch_assoc();
// print_r($employee);

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
      $header = "Employee Edit page";
      include_once("include/menu.php");
      ?>

        <main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">

          <!-- Header-->
          <?php include_once("include/header.php"); ?>

          <!-- Code body from here -->
        <div class="">
            <div class="container">
            <form id="editEmployee" class="form-inline">
            
               
                    <label for="username" class="col-3">USERNAME: </label>
                    <input id="username" name="username" type="text" class="form-control col-3" required value="<?php echo $employee['user'] ?>"></input>

                    <label for="fullname" class="col-3">FULLNAME: </label>
                    <input id="fullname" name="fullname" type="text" class="form-control col-3" required value="<?php echo $employee['fullname'] ?>"></input>

                    <label for="surname" class="col-3">SURNAME: </label>
                    <input id="surname" name="surname" type="text" class="form-control col-3" required value="<?php echo $employee['surname'] ?>"></input>

                    <label for="jobleve" class="col-3">WORK POSITION: </label>
                    <select id="joblevel" name="joblevel" class="form-control col-3" required >
                    <option value=""> -SELECT- </option>
                    <?php
                    foreach ($positions as $key => $value) {
                        if($employee['description'] == $value){
                            echo "<option value='" . $key . "' selected> " . $value . " </option>";
                        }else{
                            echo "<option value='" . $key . "'> " . $value . " </option>";
                        }

                    }
                    ?>
                    </select>
 
                    <label for="employed-date" class="col-3" >EMPLOYED DATE: </label>
                    <input id="employed-date" name="employed-date" type="date" class="form-control col-3" required value="<?php echo $employee['employed_date'] ?>"></input>

                    <label for="birth-date" class="col-3">BIRTH DATE: </label>
                    <input id="birth-date" name="birth-date" type="date" class="form-control col-3" required required value="<?php echo $employee['birthday'] ?>"></input>

                    <label for="tell" class="col-3">TELLEPHONE NUMBER: </label>
                    <input pattern="^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}" id="tell" name="tell" type="tel" class="form-control col-3" required value="<?php echo $employee['tell'] ?>"></input>

                    <label for="email" class="col-3">EMAIL ADDRESS: </label>
                    <input id="email" name="email" type="email" class="form-control col-3" required value="<?php echo $employee['email'] ?>"></input>
                </form>
                <br>
                <a href="home_page.php" class="pull-left"><button class="btn btn-warning"><em class="fa fa-arrow-left"></em> Back</button></a>                
                <button onclick="createEmployee();" type="submit" class="btn btn-success pull-right"><em class="fa fa-pencil-square-o"></em>SAVE DATA</button>
            </div>
        </div>

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