<?php


/**************************
*
* Database Connections
*
***************************/
// $link = new mysqli("localhost","root","time azoth moonshot","test"); /*for server-side testing only*/
$link = new mysqli("localhost","root","","project1"); /*for local testing only*/


if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}
/**************************
*
* Database interactions
*
***************************/

if(isset($_REQUEST["action"]))
	$action = $_REQUEST["action"];
else
	$action = "none";

$message = "";

if($action == "add_user")
{
	$name = $_POST["name"];
	$name = htmlentities($link->real_escape_string($name));
	$result = $link->query("INSERT INTO users (name) VALUES ('$name')");
	if(!$result)
		die ('Can\'t query users because: ' . $link->error);
	else
		$message = "User Added";
}

elseif ($action == "delete_user") {
	$id = $_POST["id"];
	$id = htmlentities($link->real_escape_string($id));
	$result = $link->query("delete from users where id='" . $id . "'");
	if(!$result)
		die ('Can\'t query users because: ' . $link->error);
	else
		$message = "User Deleted";
}

?>

<html>
	<head>
		<title>Welcome</title>
	</head>
	<body>
	
		<h1>Welcome!</h1>
		<?php
			if($message != "")
				print $message . "<br/><br/>";
			
			print "<h3>Users:</h3>";
			
			$result = $link->query("SELECT * FROM users");
			if(!$result)
				die ('Can\'t query users because: ' . $link->error);
			else
			{
				while($row = $result->fetch_assoc()):?>
					<?php print $row["name"]; ?>

					<form method="post" action="db_mysqli.php">
						<input type="hidden" name="id" value="<?php print $row["id"];?>" />
						<input type="hidden" name="action" value="delete_user" />
						<input type="Submit" value="Delete" />
					</form>

				<?php endwhile;
			}

			$result->close();
		?>
		
		<form method="post" action="index.php">
			<input type="text" name="name" />
			<input type="hidden" name="action" value="add_user" />
			<input type="Submit" value="Go" />
		</form>
		
	</body>
</html>