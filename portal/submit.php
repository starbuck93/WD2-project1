<?php

date_default_timezone_set('America/Chicago'); //timezone is Central Standard Time

$link = new mysqli("localhost","root","","project1"); /*for local testing only*/

//link database
if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}

//do stuff
$success = "unsuccessfully";
//get full name from the login page and pass it along to this page somehow
$title = $_POST["posted_Title"]; 
$content = $_POST["posted_text"];
$poster = $_POST["posted_by"];
$date_posted = date("c",time()); //timestamp!
$approved_by = 0; //not approved yet

$title = htmlentities($link->real_escape_string($title));
$content = htmlentities($link->real_escape_string($content));
$poster = htmlentities($link->real_escape_string($poster));

$result = $link->query("INSERT INTO stories (title,content,poster,date_posted,approved_by) VALUES ('$title', '$content', '$poster', '$date_posted', '$approved_by')");
printf("%s\n", $link->info);
if($link->info == ""){
    $success = "successfully";
}
?>

<html>
<head>
</head>
<body>
<p>Your post was <?php print($success)?> submitted!</p> <br>
<a href="index.php"><button type="button" class="btn btn-default btn-sm">Return to homepage</button></a>
</body>
</html>