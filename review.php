<?php
/*****************************************************
 *
 * Employees review page
 *
 * author: sirPauley
 * email: sirpauley@gmail.com
 *test
 *****************************************************/
//including my DBCLASS for doing mySQL data handeling
include("config/config.php");

//set header text
$header = "EMPLOYEE REVIEW";

//creating a new instance
$DBCLASS = new DBCLASS();

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
      <?php
      include_once("include/menu.php");
      ?>

        <main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">



          <!-- Header-->
          <?php include_once("include/header.php"); ?>

          <!-- Code body from here -->

                    <div class="card mb-4">
                      <div class="card-block">
                        <h3 class="card-title">LIST</h3>

                        <div class="table-responsive">
                          <table id="employeeTable" class="display table table-striped">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>SURNAME</th>
                                <th>EMPLOYED DATE</th>
                                <th>BIRTHDAY</th>
                                <th>TELEPHONE</th>
                                <th>LIKE</th>
                                <th>CONTROL</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php
                              //get employee ID
                              $employeeIDloggedInUser = $DBCLASS->SELECT('employee', 'user_id', $_SESSION['USER_ID']);
                              $employeeIDloggedInUser = $employeeIDloggedInUser[0];
                              $employeeIDloggedInUser = $employeeIDloggedInUser['ID'];

                              //get all employees
                              $employees = $DBCLASS->SELECT("employee");
                              if(isset($employees['SQLsuccess']) != "FALSE") {
                                foreach ($employees as $key => $value) {
                                  $name           = (!empty($value['fullname'])) ? strToUpper($value['fullname']) : "NULL";
                                  $surname        = (!empty($value['surname'])) ? strToUpper($value['surname']) : "NULL";

                                  $positionID = (!empty($value['position_id'])) ? $value['position_id'] : "NULL";
                                  if(true){
                                    $positionName = "NULL";
                                  }

                                  $id             = (!empty($value['ID'])) ? $value['ID'] : "NULL";
                                  $employed_date  = (!empty($value['employed_date'])) ? $value['employed_date'] : "NULL";
                                  $birthDate      = (!empty($value['birthday'])) ? $value['birthday'] : "NULL";
                                  $tell           = (!empty($value['tell'])) ? $value['tell'] : "NULL";

                                  $active         = (!empty($value['ACTIVE']) ) ? $value['ACTIVE'] : 0;
                                  $active         = ($value['ACTIVE'] == 1 ) ? "ACTIVE" : "NOT ACTIVE";

                                  echo "
                                    <tr>
                                      <td>$id</td>
                                      <td>$name</td>
                                      <td>$surname</td>
                                      <td>$employed_date</td>
                                      <td>$birthDate</td>
                                      <td>$tell</td>";


                                    $employeeLiked = '';
                                    $employeeLiked = $DBCLASS->CUSTOM("SELECT * FROM likes WHERE employee_id='"  . $employeeIDloggedInUser . "'AND employee_liked_id ='" . $value['ID'] . "'");
                                    $employeeLiked = $employeeLiked->fetch_assoc();

                                  if(isset($employeeLiked['ID'])){
                                    echo "<td><button id='" . $value['ID'] . "' onclick='liked(" . $value['ID'] . ");' class='btn btn-circle btn-primary'><em class='fa fa-thumbs-o-up'></em></button></td>";
                                  }else{
                                    echo "<td><button id='" . $value['ID'] . "' onclick='liked(" . $value['ID'] . ");' class='btn btn-circle btn-secondary'><em class='fa fa-thumbs-o-up'></em></button></td>";
                                  }

                                  echo "<td><a href='employee_info.php?id=" . $value['ID'] . "'><button class='btn btn-circle btn-info'><em class='fa fa-info-circle'></em></button></a> </td>
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
                                  <td>NULL</td>
                                  <td>NULL</td>
                                </tr>
                              ";
                              }//if

                               ?>


                            </tbody>
                          </table>
                        </div><!-- table div -->

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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>

  <!-- Data table-->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <!-- <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script> -->

  <!--noty from https://ned.im/noty-->
  <script src="lib/noty.js" type="text/javascript"></script>

  <!--My function library for calling a standard noty function -->
  <script src="lib/noty_function.js" type="text/javascript"></script>

</body>
</html>


<script type="text/javascript">

( function($) {
    // we can now rely on $ within the safety of our "bodyguard" function
    $('#employeeTable').DataTable();

} ) ( jQuery );


//add a like
function addLike(varLikedEmployee=NULL){
  $.ajax({
      url: "review_like_add_json.php",
      dataType: 'json',
      type: "POST",
      data: {
        LikedEmployee  : varLikedEmployee
      }
      }).done(function(data) {
        console.log(data);
          if(!data.error){
            //notySuccess("Employee liked!!");
            $("#" + varLikedEmployee).removeClass("btn-secondary");
            $("#" + varLikedEmployee).addClass("btn-primary");
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
}

//Remove like
function removeLike(varLikedEmployee=NULL){
  $.ajax({
      url: "review_like_remove_json.php",
      dataType: 'json',
      type: "POST",
      data: {
        LikedEmployee  : varLikedEmployee
      }
      }).done(function(data) {
        console.log(data);
          if(!data.error){
            //notySuccess("Employee liked removed");
            $("#" + varLikedEmployee).removeClass("btn-primary");
            $("#" + varLikedEmployee).addClass("btn-secondary");
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
}

function liked(varID=NULL){
  //notyWarning(varID);

  //toggle like button
  if( $("#" + varID).hasClass('btn-secondary') ){
    addLike(varID);
  }else if( $("#" + varID).hasClass('btn-primary') ){
    removeLike(varID);
  }


}

</script>

<?php

//close db connection
$DBCLASS->close_connection();

?>
