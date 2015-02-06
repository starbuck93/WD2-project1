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

// $title = "Testing!"; 
// $content = "LOTS OF TESTING!!!";
// $poster = "ADAM!! WHOO TESTING";
// $date_posted = date("c",time()); //timestamp!
// $approved_by = 0; //not approved yet


    // if($email == "")
    //     $message = "You have to input an email address!";
    // if($passwrd == "")
    //     $message = "You have to input a password!";

    $title = htmlentities($link->real_escape_string($title));
    $content = htmlentities($link->real_escape_string($content));
    $poster = htmlentities($link->real_escape_string($poster));

	$result = $link->query("INSERT INTO stories (title,content,poster,date_posted,approved_by) VALUES ('$title', '$content', '$poster', '$date_posted', '$approved_by')");
    printf("%s\n", $link->info);
    if($link->info == ""){
        $success = "successfully";
    }
    // $row_cnt = $result->num_rows;

    // if($row_cnt == 0){
        // $message = "WOAH";
        // print("<div class=\"container\"> <div class=\"col-md-4\"></div><div class=\"col-md-4 alert alert-danger\">$message Something went wrong!</div><div class=\"col-md-4\"></div></div>");
    // }

    /* fetch object array */
    /* I think this will only work when there are unique emails in our database */
    /* and when the SQL returns true (so the email and password match!) */
    // $textResult = "";
    // while ($obj = $result->fetch_object()) {
    // 	$textResult = $obj[0];
    // }
        // if(!$result)
        //         die ('Broke because: ' . $link->error);
        //     else { 
        //         //die('Here\'s your data ' . $email . ' ' . $passwrd . ' '. $emailFromServer . ' ' . $passFromServer); //testing code
        //         die();
        //     }

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

<html>
<head>
</head>
<body>
<p>Your post was <?php print($success)?> submitted!</p> <br>
<a href="index.php"><button type="button" class="btn btn-default btn-sm">Return to homepage</button></a>
</body>
</html>