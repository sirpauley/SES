<?php
/*****************************************************
 *
 * Phone book
 *
 * author: sirPauley
 * email: sirpauley@gmail.com
 *
 *****************************************************/

//including my DBCLASS for doing mySQL data handeling
include_once("config/config.php");

//creating a new instance
$DBCLASS = new DBCLASS();

$header = "PHONEBOOK";

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

  <!-- DataTables CSS-->
  <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

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
          //set headers text

          include_once("include/header.php");

          //include functions
          include_once("include/functions.php");
          $positions = JobPositionByID();
          ?>

          <!-- Code body from here -->

          <div class="card mb-4">
            <div class="card-block">
              <h3 class="card-title">LIST</h3>
              <div class="dropdown card-title-btn-container">

              </div>

              <div class="table-responsive">
                <table id="employeeTable" class="display table table-striped">
                  <thead>
                    <tr>
                      <th>NAME</th>
                      <th>SURNAME</th>
                      <th>POSITION</th>
                      <th>BIRTHDAY</th>
                      <th>TELL.</th>
                      <th>EMAIL</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    //get all employees
                    $employees = $DBCLASS->SELECT("employee");
                    if(isset($employees['SQLsuccess']) != "FALSE") {
                      foreach ($employees as $key => $value) {
                        $name           = (!empty($value['fullname'])) ? strToUpper($value['fullname']) : "NULL";
                        $surname        = (!empty($value['surname'])) ? strToUpper($value['surname']) : "NULL";

                        $positionID = (!empty($value['position_id'])) ? $value['position_id'] : "NULL";
                        if(array_key_exists($positionID, $positions)){
                          $positionName = $positions[$positionID];
                        }else{
                          $positionName = "NULL";
                        }

                        $employed_date  = (!empty($value['employed_date'])) ? $value['employed_date'] : "NULL";
                        $birthDate      = (!empty($value['birthday'])) ? $value['birthday'] : "NULL";
                        $tell           = (!empty($value['tell'])) ? $value['tell'] : "NULL";

                        $active         = (!empty($value['ACTIVE']) ) ? $value['ACTIVE'] : 0;
                        $active         = ($value['ACTIVE'] == 1 ) ? "ACTIVE" : "NOT ACTIVE";

                        $email = ( !empty($value['email']) ) ? $value['email'] : "NULL";

                        echo "
                          <tr>
                            <td>$name</td>
                            <td>$surname</td>
                            <td>$positionName</td>
                            <td>$birthDate</td>
                            <td>$tell</td>
                            <td>$email</td>
                          </tr>
                        ";
                      }//foreach
                    }else{
                      echo "
                      <tr>
                        <td>NULL</td>
                        <td>NULL</td>
                        <td>NULL</td>
                        <td>NULL</td>
                        <td>NULL</td>
                        <td>NULL</td>
                      </tr>
                    ";
                    }//if

                     ?>


                  </tbody>
                </table>
              </div>
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

  <!-- <script src="lib/medialoot/js/chart.min.js"></script>
  <script src="lib/medialoot/js/chart-data.js"></script>
  <script src="lib/medialoot/js/easypiechart.js"></script>
  <script src="lib/medialoot/js/easypiechart-data.js"></script>
  <script src="lib/medialoot/js/bootstrap-datepicker.js"></script>
  <script src="lib/medialoot/js/custom.js"></script> -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

  <!-- Data table-->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <!-- <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script> -->

  <!--noty from https://ned.im/noty-->
  <script src="lib/noty.js" type="text/javascript"></script>

  <!--My function library for calling a standard noty function -->
  <script src="lib/noty_function.js" type="text/javascript"></script>

  <script type="text/javascript">

  ( function($) {
      // we can now rely on $ within the safety of our "bodyguard" function
      $('#employeeTable').DataTable();

  } ) ( jQuery );


//prevent submit function to reload page
  $("#createEmployee").submit(function(e) {
    e.preventDefault();
  });

  //create function of employee
  function createEmployee(){
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
    var form = $("#createEmployee")
    //alert(form.prop('id')) //test to ensure calling form correctly
    if($("#password").val() === $("#retype-password").val()){
        if (form[0].checkValidity() === true) {


          $.ajax({
              url: "employeeCreate_json.php",
              dataType: 'json',
              type: "POST",
              data: {
                username        : $("#username").val(),
                password        : $("#password").val(),
                retype_password : $("#retype-password").val(),
                fullname        : $("#fullname").val(),
                surname         : $("#surname").val(),
                joblevel        : $("#joblevel").val(),
                employeddate      : $("#employed-date").val(),
                birthday        : $("#birth-date").val(),
                tell            : $("#tell").val(),
                email           : $("#email").val()
              }
              }).done(function(data) {
                console.log(data);
                  if(!data.error){
                    notySuccess("New employee created!");
                    setTimeout(function(){location.reload()}, 1500);

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
