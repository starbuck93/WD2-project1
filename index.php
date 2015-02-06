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
        $moderator = '';


    	$email = htmlentities($link->real_escape_string($email));
    	$result = $link->query("SELECT * from users where email= '$email' AND pass= '$passwrd'");

        $row_cnt = $result->num_rows;

        if($row_cnt == 0){
            $message = "The email or password is incorrect";
            print("<div class=\"container\"> <div class=\"col-md-4\"></div><div class=\"col-md-4 alert alert-danger\">$message Something went wrong! The email or password is incorrect, or you'll need to sign up.</div><div class=\"col-md-4\"></div></div>");
        }

        /* fetch object array */
        /* I think this will only work when there are unique emails in our database */
        /* and when the SQL returns true (so the email and password match!) */
        while ($obj = $result->fetch_object()) {
        	$emailFromServer  = $obj->email;
            $passFromServer   = $obj->pass;
            $user_name_server = $obj->name;
            $moderator        = $obj->is_mod;
        }

        if($moderator) //super secure!!!!
        {
            header("Location: http://localhost/WD2-project1/portal/portal_ismod.php?name=$user_name_server"); //of course this only works on localhost but it has to be a full URL
            die(); 
        }

    	if ($message == "") {
            if(!$result)
                    die ('Can\'t query users because: ' . $link->error);
                else { //the user is logged in because the SQL returned true!
                    //die('Here\'s your data ' . $email . ' ' . $passwrd . ' '. $emailFromServer . ' ' . $passFromServer); //testing code
                    header("Location: http://localhost/WD2-project1/portal/index.php?name=$user_name_server"); //of course this only works on localhost but it has to be a full URL
                      die();
                }
        }
    }


?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Login</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body background="bg.jpg" style="margin-top:200px; background:no-repeat center top scroll;">

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
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" required autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="hidden" name="action" value="login_user" />
                                <button class="btn btn-lg btn-primary btn-block">Login</button>
                            </fieldset>
                        </form>

                        <br>
                        <center><a href="signup.php"><b>Create a new account</b></a></center>
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
