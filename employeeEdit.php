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

	// echo "<h1>";
	// print_r($employee);
	// echo "</h1>";


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
      $header = "EMPLOYEE EDIT PAGE";
      include_once("include/menu.php");
      ?>

        <main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">

          <!-- Header-->
          <?php include_once("include/header.php"); ?>

          <!-- Code body from here -->
        <div class="">
            <div class="container">
            <form id="editEmployee" class="form-inline">

              <label for="username" class="col-sm-6 col-md-3">USERNAME: </label>
              <input id="username" name="username" type="text" class="form-control col-sm-6 col-md-3 " required value="<?php echo $employee['user']; ?>" readonly></input>

              <label for="fullname" class="col-sm-6 col-md-3">FULLNAME: </label>
              <input id="fullname" name="fullname" type="text" class="form-control col-s-6 col-md-3 " required value="<?php echo $employee['fullname'] ?>"></input>

              <label for="surname" class="col-sm-6 col-md-3">SURNAME: </label>
              <input id="surname" name="surname" type="text" class="form-control col-sm-6 col-md-3" required value="<?php echo $employee['surname'] ?>"></input>

              <label for="jobleve" class="col-sm-6 col-md-3">WORK POSITION: </label>
              <select id="joblevel" name="joblevel" class="form-control col-sm-6 col-md-3" required >

              <option value=""> -SELECT- </option>
              <?php
              foreach ($positions as $key => $value) {
                  if($employee['position_id'] == $key){
                      echo "<option value='" . $key . "' selected> " . $value . " </option>";
                  }else{
                      echo "<option value='" . $key . "'> " . $value . " </option>";
                  }

              }
              ?>
              </select>

              <label for="employed-date" class="col-sm-6 col-md-3" >EMPLOYED DATE: </label>
              <input id="employed-date" name="employed-date" type="date" class="form-control col-sm-6 col-md-3" required value="<?php echo $employee['employed_date'] ?>"></input>

              <label for="birth-date" class="col-sm-6 col-md-3">BIRTH DATE: </label>
              <input id="birth-date" name="birth-date" type="date" class="form-control col-sm-6 col-md-3" required required value="<?php echo $employee['birthday'] ?>"></input>

              <label for="tell" class="col-sm-6 col-md-3">TELEPHONE NUMBER: </label>
              <input pattern="(^0[1-9][0-9]{8})" id="tell" name="tell" type="tel" class="form-control col-sm-6 col-md-3" required value="<?php echo $employee['tell'] ?>"></input>

              <label for="email" class="col-sm-6 col-md-3">EMAIL ADDRESS: </label>
              <input id="email" name="email" type="email" class="form-control col-sm-6 col-md-3" required value="<?php echo $employee['email'] ?>"></input>
              <br>

              <div class="col-md-12">
              <br>
                <button onclick="editEmployee();" type="submit" class="btn btn-success pull-left"><em class="fa fa-pencil-square-o "></em>SAVE DATA</button>
              </div>

              <div class="col-md-12">
              <br>
                <a href="home_page.php" class="pull-left"><button type="button" class="btn btn-warning"><em class="fa fa-arrow-left"></em> Back</button></a>
              </div>

            </form>
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

	<script src="lib/medialoot/js/bootstrap-datepicker.js"></script>
  <script src="lib/medialoot/js/custom.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

  <!--noty from https://ned.im/noty-->
  <script src="lib/noty.js" type="text/javascript"></script>

  <!--My function library for calling a standard noty function -->
  <script src="lib/noty_function.js" type="text/javascript"></script>

<script>

//prevent submit function to reload page
$("#editEmployee").submit(function(e) {
    e.preventDefault();
  });

  //create function of employee
  function editEmployee(){
    //alert("FRIKKIE");

    console.log("username: ", $("#username").val());
    console.log("password: ", $("#password").val());
    console.log("retype_password: ", $("#retype-password").val());
    console.log("fullname: ", $("#fullname").val());
    console.log("surname: ", $("#surname").val());
    console.log("joblevel: ", $("#joblevel").val());
    console.log("employed-date: ", $("#employed-date").val());
    console.log("birth-date: ", $("#birth-date").val());
    console.log("tell: ", $("#tell").val());
    console.log("email: ", $("#email").val());

    //Fetch form to apply custom Bootstrap validation
    var form = $("#editEmployee")
    //alert(form.prop('id')) //test to ensure calling form correctly
    if($("#password").val() === $("#retype-password").val()){
        if (form[0].checkValidity() === true) {


          $.ajax({
              url: "employeeEdit_json.php",
              dataType: 'json',
              type: "POST",
              data: {
                username        : $("#username").val(),
                fullname        : $("#fullname").val(),
                surname         : $("#surname").val(),
                joblevel        : $("#joblevel").val(),
                employeddate    : $("#employed-date").val(),
                birthday        : $("#birth-date").val(),
                tell            : $("#tell").val(),
                email           : $("#email").val(),
                id              : "<?php echo $_GET['id'] ?>"
              }
              }).done(function(data) {
                console.log(data);
                  if(!data.error){
                    notySuccess("Employee data saved!");
                    setTimeout(function(){window.location.replace("home_page.php")}, 1500);

                  }else{
                    if(data.errorMessage != ''){
                      notyError(data.errorMessage);
                    }else{
                      notyError('Unexpected error!');
                    }

                  }

              }).fail(function() {

                  notyError("Database error, Please contact IT Support");

              });


            }else{
                notyError("Form not valid!");
            }
          }else{
            notyError("Password and retype Passwoord must be the same");
          }
        }//function

  </script>


</body>
</html>

<?php

//close db connection
$DBCLASS->close_connection();

?>
