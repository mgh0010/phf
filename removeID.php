<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link href="style.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>
<body id="login">

<div class="container">
	<div class="center-align">
      	<h4 class="white-text">Project Horseshoe Farm</h4>
      	<p class="white-text">ID deletion</p>
    	
    	<br /> <br />

<?php

$servername = "localhost";
$username = "garretti_admin";
$password = "Password1";
$dbname = "garretti_phf";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if(isset($_POST['ID']) && $_POST['ID'] != 0) {
	$ID = $_POST['ID'];

	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 

	//prepare the sql statement
	$stmt = mysqli_prepare($conn, "DELETE FROM IDs WHERE wearableID = ?");
	//binds the ?s to strings
	mysqli_stmt_bind_param($stmt, 's', $ID);
	//execute the statement
	mysqli_stmt_execute($stmt);

	//begin to refresh the page, let them know was creaed and going back to main page
	echo ('<p class="white-text">ID deleted. Redirecting back to input page...</p>');
	echo ('<meta http-equiv="refresh" content="3; URL=admin.php">');
}

else {
	echo ('<p class="white-text">ID not entered. Redirecting back to input page...</p>');
	echo ('<meta http-equiv="refresh" content="3; URL=admin.php">');
}

?>

<div class="preloader-wrapper big active">
	    		<div class="spinner-layer">
	      			<div class="circle-clipper left">
	        			<div class="circle"></div>
	      			</div>
	      			<div class="gap-patch">
	        			<div class="circle"></div>
	      			</div>
	      			<div class="circle-clipper right">
	        			<div class="circle"></div>
	      			</div>
	    		</div>
	  		</div>

		</div>
	</div>

	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
</body>
</html>