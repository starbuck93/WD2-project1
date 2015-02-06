<?php

$link = new mysqli("localhost","root","","project1"); /*for local testing only*/


//link database
if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}
//do stuff
if(isset($_REQUEST["action"]))
	$action = $_REQUEST["action"];
else
	$action = "none";

$message = "";

if($action == "add_user")
{
	$name = $_POST["nameActual"];
	$email = $_POST["email"];
	$emailConfirm = $_POST["email2"];
    $passwrd = $_POST["password"];
    $passwrd2 = $_POST["password2"];

    $username = trim($name);

    if(($passwrd != $passwrd2) || ($email != $emailConfirm))
    	die('Passwords or emails do not match!');

	$email = htmlentities($link->real_escape_string($email));
	$result = $link->query("INSERT INTO users (name,username,pass,email,is_mod) VALUES ('$name','$username','$passwrd','$email', 0)");

	if(!$result)
		die ('Can\'t query users because: ' . $link->error);
	else {
		header("Location: http://localhost/WD2-project1/portal"); //of course this only works on localhost but it has to be a full URL
        die(); //this is imporant so the php script dies when we move pages
    }

}

?>


<script>

$(document).ready(function() {
  $("#pswd2").keyup(validate);
});

function CheckPswd() {
  var pswd1 = $("#pswd1").val();
  var pswd2 = $("#pswd2").val();
    
 
    if(pswd1 == pswd2) {
        
       $("#validate-status").text("Passwords match!");        
    }
    else {
        $("#validate-status").text("Passwords do not match");
    }
    
}

</script>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Signup</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body style="margin-top:200px">

        <img src="bg.jpg" id="bg" alt="">
        
<!--login modal-->
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Create Account for Generic Company</strong></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="signup.php">
                            <fieldset>
                            	<div class="form-group">
                                    <input class="form-control" id="name" placeholder="Name" name="nameActual" type="text" value="" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="e1" placeholder="E-mail" name="email" type="email" value="" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="e2" placeholder="Confirm E-mail" name="email2" type="email" value="" onkeyup="CheckEm()" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="pswd1" placeholder="Password" name="password" type="password" value="" required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" id="pswd2" placeholder="Confirm Password" name="password2" type="password" value="" onkeyup= "CheckPswd()" required>
                                    <span id="validate-status"></span>
                                    
                                    <hr>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="hidden" name="action" value="add_user" />
                                <button class="btn btn-lg btn-success btn-block">Sign Up</button>
                            </fieldset>
                        </form>
                        <center><a href="index.php"><b>Already have an account?</b></a></center>
                    </div>
                </div>
            </div>
        </div>

    </div>
	<!-- script references -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
