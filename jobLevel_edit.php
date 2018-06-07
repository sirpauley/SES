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

//creating a new instance
$DBCLASS = new DBCLASS();

//get job level information
$JobLevel = $DBCLASS->SELECT('joblevel', 'ID', $_GET['id']);
$JobLevel = $JobLevel[0];

	// echo "<h1>";
	// print_r($employee);
	// echo "</h1>";

$header = "JOB LEVEL EDIT";
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
            <form id="editJobLevel">

                    <label for="id" class="col-12 col-md-4">ID: </label>
                    <input id="id" name="id" type="text" class="form-control col-12 col-md-4" required value="<?php echo $JobLevel['ID']; ?>" readonly></input>

                    <label for="joblevel" class="col-12 col-md-4">JOB LEVEL: </label>
                    <input id="joblevel" name="joblevel" type="number" class="form-control col-12 col-md-4" required max="100" value="<?php echo $JobLevel['level'] ?>"></input>

                    <label for="description" class="col-12 col-md-4">DESCRIPTION: </label>
                    <input id="description" name="description" type="text" class="form-control col-12 col-md-4" required value="<?php echo $JobLevel['description'] ?>"></input>

										<br>

										<div class="row col-12">
                      <button onclick="editJobLevel();" type="submit" class="btn btn-success pull-left"><em class="fa fa-pencil-square-o"></em>SAVE DATA</button>
                    </div>
                    <br>

										<div class=" row col-12">
                      <a href="jobLevel.php" class="pull-left"><button type="button" class="btn btn-warning"><em class="fa fa-arrow-left"></em> Back</button></a>
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
$("#editJobLevel").submit(function(e) {
    e.preventDefault();
  });

  //create function of job level edit
  function editJobLevel(){
    //alert("FRIKKIE");

    //Fetch form to apply custom Bootstrap validation
    var form = $("#editJobLevel");
    //alert(form.prop('id')) //test to ensure calling form correctly

        if (form[0].checkValidity() === true) {


          console.log("id: ", $("#id").val());
          console.log("joblevel: ", $("#joblevel").val());
          console.log("description: ", $("#description").val());

          $.ajax({
              url: "jobLevel_edit_json.php",
              dataType: 'json',
              type: "POST",
              data: {
                id          : $("#id").val(),
                joblevel    : $("#joblevel").val(),
                description : $("#description").val()
              }
              }).done(function(data) {
                console.log(data);
                  if(!data.error){
                    notySuccess("Job level data saved!");
                    setTimeout(function(){window.location.replace("jobLevel.php")}, 1500);

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


            }else if( $("#joblevel").val() > 100){
              notyError("Job level can only be less/equal to 100.");
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
