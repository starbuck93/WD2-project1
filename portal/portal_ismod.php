<?php

$link = new mysqli("localhost","root","","project1"); /*for local testing only*/

//link database
if ($link->connect_errno) {
    printf("Connect failed: %s\n", $link->connect_error);
    exit();
}

//do stuff
$success = "unsuccessfully";

$user_name_admin = $_GET["name"];

$result = $link->query("SELECT * FROM stories WHERE approved_by='0'");
printf("%s\n", $link->info);
if($link->info == ""){
    $success = "successfully";
}

$result_array = array();
//while loop for inserting data into the array for results of the posts that need to be approved
$i = 0;
while ($obj = $result->fetch_object()) { //put these into $result_array[0]->title etc...
  $result_array[$i][0] = $obj->title; //0
  $result_array[$i][1] = $obj->content; //1
  $result_array[$i][2] = $obj->poster; //2
  $result_array[$i][3] = $obj->date_posted; //3
  $i++;
}

// $num_row = $result->$num_rows; //to enumerate through inside of the html



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
		</ul>
		<div class="pull-right">
      <ul class="nav navbar-nav">
          <li><a href="../"></span><strong><?php print($user_name_admin . ", "); ?> Logout</strong></a></li>
      </ul>
		</div>
	</div>
</nav>

<div class="col-md-3">
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
  </div><!--/right-->
<br>

<div class="container-fluid">
  


  <!--center-->


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
       
 <div class="row">
      <div class="col-xs-12">
        <h2>Company was Invaded by Hornets</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate. 
          Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis 
          dolor, in sagittis nisi. Sed ac orci quis tortor imperdiet venenatis. Duis elementum auctor accumsan. 
          Aliquam in felis sit amet augue.</p>
        <ul class="list-inline"><li>2 Hours Ago</li><li>Submitted by: </a></li><li>Approved by: </li></ul>
        
      </div>
</div>

<hr>

  </div><!--/center-->


<div class="col-md-3">
      <div class="panel panel-info">
          <div class="panel-heading"><h4>Posts Awaiting Approval</h4></div>
          <div class="panel-body">
              <table class="table table-bordered">
                  <tr>
                    <th>User</th>
                    <th>Post Title</th> 
                    <th>Approve</th>
                 </tr>
                <?php 
                if($i !== 0){

                for($j=0; $j < $i; $j++){?>
                  <tr>
                    <td><?php print($result_array[$j][2]);?></td>
                    <td><?php print($result_array[$j][0]);?></td> 
                    <td><form action="approve.php" method="POST"><input type="hidden" name="username" value=<?php print($user_name_admin);?> /><button name="Button1" value="<?php print($result_array[$j][0]);?>" class="btn btn-sm btn-primary">Approve</button></form></td> <!-- name=post_title -->
                  </tr>
                <?php } //end while loop
                } 
                else{//end if statement?>
                  <tr>
                    <td><p>---</p></td>
                    <td>nothing to approve!</td> 
                    <td><p>:-)</p></td>
                  </tr>

                <?php } //end else statement ?>


              </table>
          </div>
        </div>
        <hr>
              <!-- From Boot Snip -->
                <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Vote for Employee of The Year
                    </h3>
                </div>

                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios">
                                    Adam
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios">
                                    Garrett
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios">
                                    Shawn
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios">
                                    No Comment
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="panel-footer">
                    <button type="button" class="btn btn-primary btn-sm">
                        Vote</button>

                    <button type="button" class="btn btn-primary btn-sm">
                      View Result</button>
                     
                  </div>

            </div>
            <hr>
      

  </div><!--/right-->


  
</div><!--/container-fluid-->
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>