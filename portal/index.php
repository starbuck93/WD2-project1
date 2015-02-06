<?php

$link = new mysqli("localhost","root","","project1"); /*for local testing only*/

//link database
if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}

//do stuff
$success = "unsuccessfully";

if(isset($_REQUEST["name"]))
  $user_name_admin = $_REQUEST["name"];


$result = $link->query("SELECT * FROM stories WHERE approved_by!='0'");

if($link->info == ""){
    $success = "successfully";
}

$result_array = array();
//while loop for inserting data into the array for results of all the posts
$i = 0;
while ($obj = $result->fetch_object()) {    //put these into $result_array[0]->title etc...
  $result_array[$i][0] = $obj->title;       //0
  $result_array[$i][1] = $obj->content;     //1
  $result_array[$i][2] = $obj->poster;      //2
  $result_array[$i][3] = $obj->date_posted; //3
  $result_array[$i][4] = $obj->approved_by; //4
  $i++;
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Portal Template</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
    
	</head>
	<body>
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
	<div class="navbar-header">
        <a class="navbar-brand" rel="home" href="#">Generic Company</a>
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
	</div>
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact Moderator</a></li>
		</ul>
		<div class="pull-right">
      <ul class="nav navbar-nav">
          <li><a href="../"></span><strong><?php if(isset($_GET["name"])) print($_GET["name"] . ", "); ?> Logout</strong></a></li>
      </ul>
		</div>
	</div>
</nav>

<div class="col-sm-3">
        <h2>News Portal Home</h2>
        <hr>
        <div class="alert alert-info alert-dismissible" role="alert">
          Hey! Someone had a baby or something.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <hr>
        <div class="panel panel-default">
          <div class="panel-heading">Announcements</div>
          <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
            Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis 
            dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
            Aliquam in felis sit amet augue.</div>
        </div>
        <hr>
        <button type="button" class="btn btn-warning btn-lg">Company RSS Feed</button>

  </div><!--/right-->
<br>

<div class="container-fluid">
  
  <div class="col-md-6">
   <div class="row">
          <div class="col-xs-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                    <div class="panel-title">
                      <h4>Submit New Posts</h4>
                    </div>
                  </div>
                  <div class="panel-body">
                    
                    <form class="form form-vertical" action="submit.php" method="POST">
                      <div class="form-group">
                        <label>Name</label>
                        <div class="controls">
                          <input type="text" class="form-control" placeholder="Enter Your Name" name="posted_by">
                        </div>
                      </div><!--form-group-->

                      <div class="form-group">
                        <label>Post Title</label>
                        <div class="controls">
                          <input type="text" class="form-control" placeholder="Creative Title" name="posted_Title">
                        </div>
                      </div><!--form-group-->

                      <div class="form-group">
                        <label>Content</label>
                        <div class="controls">
                        <textarea class="form-control" rows="5" name="posted_text"></textarea>
                        </div>
                      </div> <!--form-group-->
                      <div class="form-group">
                        <div class="controls">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </div>   
                      
                    </form><!--form-->
                    
                    
                  </div><!--/panel content-->
                </div><!--/panel-->
            </div>
    </div>

	<?php 
	if($i !== 0){
	for($j=0; $j < $i; $j++){?>
	<div class="row">
	      <div class="col-xs-12">
	        <h2><?php print($result_array[$j][0]) ?></h2>
	        <p><?php print($result_array[$j][1]) ?></p>
	        <ul class="list-inline"><li><?php print($result_array[$j][3]) ?></li><li>Submitted by: <?php print($result_array[$j][2]) ?></a></li><li>Approved by: <?php print($result_array[$j][4]) ?></li></ul>
	      </div>
	</div>
	    <hr>
	<?php } //end for loop
	} 
	else{//end if statement?>

	<?php } //end else statement ?>
      
      <nav>
        <ul class="pager">
          
          <li class="next"><a href="#">Older <span aria-hidden="true">&rarr;</span></a></li>
        </ul>
      </nav>
  </div>

  
</div><!--/container-fluid-->

	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>