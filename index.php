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
    $emailFromServer = '';
    $passFromServer = '';

    if($email == "")
        die('you have to input an email address!');
    if($passwrd == "")
        die('you have to input a password!');

	$email = htmlentities($link->real_escape_string($email));
	$result = $link->query("SELECT * from users where email= '$email' AND pass= '$passwrd'");

    /* fetch object array */
    /* I think this will only work when there are unique emails in our database */
    /* and when the SQL returns true (so the email and password match!) */    
    while ($obj = $result->fetch_object()) {
    	$emailFromServer = $obj->email;
    	$passFromServer = $obj->pass;
    }

	if(!$result)
		die ('Can\'t query users because: ' . $link->error);
	else { //the user is logged in because the SQL returned true!
		//die('Here\'s your data ' . $email . ' ' . $passwrd . ' '. $emailFromServer . ' ' . $passFromServer); //testing code
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
	<body style="margin-top:200px">
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
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="hidden" name="action" value="login_user" />
                                <button class="btn btn-lg btn-primary btn-block">Login</button>
                                <br>
                                <center><a href="signup2.php"><b>Create a new account</b></a></center>
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
