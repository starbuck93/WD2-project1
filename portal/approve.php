<?php

date_default_timezone_set('America/Chicago'); //timezone is Central Standard Time

$link = new mysqli("localhost","root","","project1"); /*for local testing only*/

//link database
if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}

$value_title = $_POST["Button1"];
$name = $_POST["username"];


//do stuff
$success = "successful!";

$result = $link->query("UPDATE stories SET approved_by='$name' WHERE title = '$value_title'");
printf("%s\n", $link->info);
if($link->info == ""){
    $success = "unsuccessful...";
}
?>

<html>
<head>
</head>
<body>
<p><?php print($success)?></p> <br>
<a href="portal_ismod.php?name=<?php print($name); ?>">Return to homepage</a>
</body>
</html>