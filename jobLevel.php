<?php
/*****************************************************
 *
 * Home screen
 *
 * author: sirPauley
 * email: sirpauley@gmail.com
 *
 *****************************************************/

//including my DBCLASS for doing mySQL data handeling
include_once("config/config.php");

//creating a new instance
$DBCLASS = new DBCLASS();

//set headers text
$header = "JOB LEVEL";

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
          include_once("include/header.php");
          ?>

          <!-- Code body from here -->

          <div class="card mb-4">
            <div class="card-block">
              <h3 class="card-title">LIST</h3>
              <div class="dropdown card-title-btn-container">

                <!-- Button to Open the Modal -->
                <button class="btn btn-sm btn-info" type="button" data-toggle="modal" data-target="#myModal"><em class="fa fa-user"></em> ADD NEW JOB LEVEL</button>


                <!-- The Modal -->
                <div class="modal" id="myModal">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <!-- Modal Header -->
                      <div class="modal-header">
                        <h4 class="modal-title">CREATE A JOB LEVEL</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                      </div>

                      <!-- Modal body -->
                      <div class="modal-body">

                        <form id="createJobLevel" >
                          <div class="form-group">
                            <label for="joblevel">JOB LEVEL: </label>
                            <input id="joblevel" name="joblevel" type="number" class="form-control" max="100" required></input>
                          </div>

                          <div class="form-group">
                            <label for="description">DESCRIPTION: </label>
                            <input id="description" name="description" type="text" class="form-control" required></input>
                          </div>

                          <button onclick="createJoblevel();" type="submit" class="btn btn-success"><em class="fa fa-check"></em>CREATE</button>
                        </form>

                      </div>

                      <!-- Modal footer -->
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger fa fa-check" data-dismiss="modal">Close</button>
                      </div>

                    </div>
                  </div>
                </div>

              </div>

              <div class="table-responsive">
                <table id="JobLevelTable" class="display table table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>LEVEL</th>
                      <th>DESCRIPTION</th>
                      <th>CONTROL</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    //get all employees
                    $jobLevel = $DBCLASS->SELECT("joblevel");
                    if(isset($jobLevel['SQLsuccess']) != "FALSE") {
                      foreach ($jobLevel as $key => $value) {
                        $id             = (!empty($value['ID'])) ? $value['ID'] : "NULL";
                        $level          = (!empty($value['level'])) ? $value['level'] : "NULL";
                        $description     = (!empty($value['description'])) ? strToUpper($value['description']) : "NULL";


                        echo "
                          <tr>
                            <td>$id</td>
                            <td>$level</td>
                            <td>$description</td>
                            <td><a href='employeeEdit.php?id=" . $value['ID'] . "'><button class='btn btn-circle btn-warning'><em class='fa fa-pencil-square-o'></em></button></a> <a href='jobLevel_info.php?id=" . $value['ID'] . "'><button class='btn btn-circle btn-info'><em class='fa fa-info-circle'></em></button></a> </td>
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
      $('#JobLevelTable').DataTable();

  } ) ( jQuery );


//prevent submit function to reload page
  $("#createJobLevel").submit(function(e) {
    e.preventDefault();
  });

  //create function of employee
  function createJoblevel(){
    //alert("FRIKKIE");

    console.log("joblevel: ", $("#joblevel").val());
    console.log("description: ", $("#description").val());

    //Fetch form to apply custom Bootstrap validation
    var form = $("#createJobLevel")
    //alert(form.prop('id')) //test to ensure calling form correctly

        if (form[0].checkValidity() === true) {


          $.ajax({
              url: "jobLevelCreate_json.php",
              dataType: 'json',
              type: "POST",
              data: {
                  joblevel     : $("#joblevel").val(),
                  description  : $("#description").val()
                }
              }).done(function(data) {
                console.log(data);
                  if(!data.error){
                    notySuccess("New Job level created!");
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
        }//function

  </script>

</body>
</html>

<?php

//close db connection
$DBCLASS->close_connection();
 ?>
