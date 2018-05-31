<?php

/*****************************************************
 * 
 * This is the Login screen
 * 
 * author: sirPauley
 * email: sirpauley@gmail.com
 * 
 *****************************************************/
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <!-- NOTY from https://ned.im/noty-->
    <link href="lib/noty.css" rel="stylesheet">

    <title>Login!</title>

    <style type="text/css">
    
        html, body, .container {
            height: 100%;
        }
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    
    </style>

    <script>
        function testLogin(){
            var username = $("#user_name").val();
            var password = $("#password").val();

            if(username == ""){
                notyError("Please enter a username.", true);
            }else if(password == ""){
                notyError("Please enter a Password.", true);
            }else{
            
                console.log(username);
                console.log(password);
                console.log("Login!!");
                $.ajax({
                    url: "login_json.php",
                    dataType: 'json',
                    type: "POST",
                    data: {
                        username 	: username,
                        password    : password,
                    }
                    }).done(function(data) {

                        console.log(data);

                    }).fail(function() {
                        
                        notyError("Database error, Please contact IT Support");

                    });
                //notySuccess("Login!!", true);
            }



        }
    </script>

  </head>
  <body>

  <div class= "container">
    <fieldset>
        <legend> <h1>Login Details</h1></legend>
            <div>
                <form >
                    <div class="row ">
                        <div class="col"><input type="text" id="user_name" class="form-control" name="user_name" maxlength="50" placeholder="Username"></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col"><input type="text" id="password" class="form-control" name="password" maxlength="50" placeholder="password"></div>
                    </div>
                    <br>
                    <div class="row"> 
                        <div class="col"><button type="button" class="btn btn-primary btn-lg btn-block" onClick="testLogin();";>Login</button></div>
                    </div>
                </form>
            </div>
        </fieldset>
    </div>

<!-- Bootstrap 4 -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
    <!--noty from https://ned.im/noty-->
    <script src="lib/noty.js" type="text/javascript"></script>

    <!--My function library for calling a standard noty function -->
    <script src="lib/noty_function.js" type="text/javascript"></script>

    <!-- Google jQuery library CND-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  </body>
</html>

