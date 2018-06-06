<?php
/*****************************************************
 *
 * Password changer/reset
 *
 * author: sirPauley
 * email: sirpauley@gmail.com
 *
 *****************************************************/

$header = "PASSWORD UPDATE";

include_once('include/functions.php');

$employeeList = EmployeeListByID();
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
          <div class="">
            <div class="container">
            <form id="passwordReset" class="form">

                <label for="employee" class="col-3">EMPLOYEE: </label>
                <select id="employee" name="employee" class="form-control col-3" required >
                <option value=""> -SELECT- </option>
                <?php
                foreach ($employeeList as $key => $value) {
                    echo "<option value='" . $key . "'> " . $value . " </option>";
                }
                ?>
                </select>

                <label for="oldPassword" class="col-3">OLD PASSWORD: </label>
                <input id="oldPassword" name="oldPassword" type="password" class="form-control col-3" required></input>

                <label for="newPassword" class="col-3">NEW PASSWORD: </label>
                <input id="newPassword" name="newPassword" type="password" class="form-control col-3" required></input>

                <label for="newPasswordRetype" class="col-3">NEW PASSWORD RETYPE: </label>
                <input id="newPasswordRetype" name="newPasswordRetype" type="password" class="form-control col-3" required></input>

                <div class="col-6">
                     <br>
                    <button onclick="editEmployee();" type="submit" class="btn btn-success pull-left"><em class="fa fa-pencil-square-o"></em>SAVE DATA</button>
                </div>
            </form>
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
$("#passwordReset").submit(function(e) {
    e.preventDefault();
  });

  //create function of employee
  function editEmployee(){
    //alert("FRIKKIE");

    console.log("user_id: ", $("#employee").val());
    console.log("oldPassword: ", $("#oldPassword").val());
    console.log("newPassword: ", $("#newPassword").val());
    console.log("newPasswordRetype: ", $("#newPasswordRetype").val());

    //Fetch form to apply custom Bootstrap validation
    var form = $("#passwordReset")
    //alert(form.prop('id')) //test to ensure calling form correctly
    if($("#newPassword").val() === $("#newPasswordRetype").val()){
        if (form[0].checkValidity() === true) {


          $.ajax({
              url: "password_json.php",
              dataType: 'json',
              type: "POST",
              data: {
                id                  : $("#employee").val(),
                oldPassword         : $("#oldPassword").val(),
                newPassword         : $("#newPassword").val(),
                newPasswordRetype   : $("#newPasswordRetype").val()
              }
              }).done(function(data) {
                console.log(data);
                  if(!data.error){
                    notySuccess("Password Updated!");
                    setTimeout(function(){window.location.replace("password.php")}, 1500);

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
