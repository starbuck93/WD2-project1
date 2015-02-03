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

if($action == "login_user")
{
	$email = $_POST["email"];
    $passwrd= $_POST["password"];
    if($email == "")
        die('you have to input an email address!');
    if($passwrd == "")
        die('you have to input a password!');
	$email = htmlentities($link->real_escape_string($email));
	$result = $link->query("SELECT * from users where email= '$email' AND pass= '$passwd'");
	if(!$result)
		die ('Can\'t query users because: ' . $link->error);
	else {
		header("Location: http://localhost/WD2-project1/portal"); //of course this only works on localhost but it has to be a full URL
        die();
    }

}

// elseif ($action == "delete_user") {
// 	$id = $_POST["id"];
// 	$id = htmlentities($link->real_escape_string($id));
// 	$result = $link->query("delete from users where id='" . $id . "'");
// 	if(!$result)
// 		die ('Can\'t query users because: ' . $link->error);
// 	else
// 		$message = "User Deleted";
// }

?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Bootstrap Login Form</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body background="bg.jpg" style="margin-top:250px">
<!--login modal-->
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Generic Company</strong></h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="index.php">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>

                                    <a href="#"><b>Create an acount</b></a>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="hidden" name="action" value="login_user" />
                                <button class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
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
