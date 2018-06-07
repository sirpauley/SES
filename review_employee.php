<?php
/*****************************************************
 *
 * Review employee
 *
 * author: sirPauley
 * email: sirpauley@gmail.com
 *
 *****************************************************/
//including my DBCLASS for doing mySQL data handeling
include("config/config.php");
$header = "EMPLOYEE REVIEW";


$DBCLASS = new DBCLASS();

//get employ information
$employee = $DBCLASS->CUSTOM("SELECT e.*, jl.description, u.user
FROM employee e
LEFT JOIN joblevel jl ON e.position_id = jl.ID
LEFT JOIN user u on e.user_id = u.ID
WHERE e.ID = " . $_GET['id']);

$employee = $employee->fetch_assoc();

//including my DBCLASS for doing mySQL data handeling
include_once("include/functions.php");

$employees = EmployeeListByID();

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



          <h3>PLEASE LEAVE A POSITIVE MESSAGE FOR <em><?php echo $employee['fullname'] . " " . $employee['surname']; ?></em></h3>
          <!-- Code body from here -->
          <div class="container">
          <form id="writeReview">
                <div class="form-group">
                  <label for="message">REVIEW: </label>
                  <textarea id="message" rows="5" name="message" type="textarea" class="form-control col-12" maxlength="1000" required ></textarea>
                </div>
                  <br>

                  <div class="row col-12">
                    <button onclick="writeReview(<?php echo $_GET['id']; ?>, <?php echo $_SESSION['USER_ID']?>);" type="submit" class="btn btn-success pull-left "><em class="fa fa-check"></em>SAVE MESSAGE</button>
                    <a href="review.php" class="pull-left col-3"><button type="button" class="btn btn-warning"><em class="fa fa-arrow-left"></em> Back</button></a>
                  </div>

                  <br>

              </form>

          </div>

          <div class="container" >
            <?php
              //creat review cards from database
              $reviews = $DBCLASS->CUSTOM("SELECT * FROM review WHERE employee_id ='" . $_GET['id'] . "' ORDER BY comment_date" );
							//$reviews = $reviews->fetch_assoc();
							while($row = $reviews->fetch_assoc()) {
					         $ReviewArray[] = $row;
					    }

							//print_r($ReviewArray);

              //random card color array
              $colorArray = array('text-white bg-primary mb-3',
                                  'text-white bg-secondary',
                                  'text-white bg-success',
                                  'text-white bg-danger',
                                  'text-white bg-warning',
                                  'text-white bg-info',
                                  'bg-light',
                                  'text-white bg-dark');

              if(isset($ReviewArray) && $ReviewArray['SQLsuccess'] !== 'FALSE'){


                foreach ($ReviewArray as $key => $value) {

                  //random class color
                  $randomNum = rand(0, 7);

                  if($key == 0){
                    echo "<div class='row'>";
                  }

                  echo "
                  <div class='col-sx-12 col-md-4'>
                    <div class='card md-3 " . $colorArray[$randomNum] . "' >
                      <h5 class='card-header'>" . $value['comment_date'] . "</h5>
                      <div class='card-body'>
											<h5 class='card-title'>" .$employees[$value['reviewer_id']] . "</h5>
                        <p class='card-text'>" . $value['comment'] . "</p>
                      </div>
                    </div>
                  </div>
                  ";

                  if( ($key+1)%3 == 0 ){
                    echo "</div>";
                    echo "<br>";
                    echo "<div class='row'>";
                  }

                }//for
                echo "</div>";
                echo "<br>";
              }

            ?>
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

  <script src="lib/medialoot/js/bootstrap-datepicker.js"></script>
  <script src="lib/medialoot/js/custom.js"></script>

  <!-- JQUERY -->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>

  <!--noty from https://ned.im/noty-->
  <script src="lib/noty.js" type="text/javascript"></script>

  <!--My function library for calling a standard noty function -->
  <script src="lib/noty_function.js" type="text/javascript"></script>


  <script>

  //prevent submit function to reload page
  $("#writeReview").submit(function(e) {
      e.preventDefault();
    });

    //create function of employee
    function writeReview(varEmployeeID=NULL, varReviewerUserID=NULL){
      //alert("FRIKKIE");

      console.log("message: ", $("#message").val());
      console.log("varEmployeeID: ", varEmployeeID);
      console.log("varReviewerUserID: ", varReviewerUserID);

      //Fetch form to apply custom Bootstrap validation
      var form = $("#writeReview")
      //alert(form.prop('id')) //test to ensure calling form correctly
          if (form[0].checkValidity() === true) {


            $.ajax({
                url: "review_create_json.php",
                dataType: 'json',
                type: "POST",
                data: {
                  message            : $("#message").val(),
                  varEmployeeID      : varEmployeeID,
                  varReviewerUserID  : varReviewerUserID
                }
                }).done(function(data) {
                  console.log(data);
                    if(!data.error){
                      notySuccess("Employee data saved!");
                      setTimeout(function(){window.location.replace("review_employee.php?id=" + varEmployeeID)}, 1500);

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
