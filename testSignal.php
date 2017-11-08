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
      	<p class="white-text">Test Signal</p>
    	
    	<br /> <br />

<?php 

$servername = "localhost";
$username = "garretti_admin";
$password = "Password1";
$dbname = "garretti_phf";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if(isset($_POST['testID']) && $_POST['testID'] != 0) {
	$id = $_POST['testID'];

	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 


 	$pairedID = NULL;
 	//first get the key that matches the ID
 	$stmtGetKey = mysqli_prepare($conn, "SELECT ID FROM IDs WHERE wearableID = ?");
 	//binds the ? to string
	mysqli_stmt_bind_param($stmtGetKey, 's', $id);
	//execute the statement
	mysqli_stmt_execute($stmtGetKey);
	//save the key into $key
	mysqli_stmt_bind_result($stmtGetKey, $key);

	while (mysqli_stmt_fetch($stmtGetKey)) {
        $pairedID = $key;
    }


	$clientName = "";
 	//get name in Client from that key
 	//prepare the sql statement
	$stmtGetName = mysqli_prepare($conn, "SELECT ClientName FROM Clients WHERE wearableID = ?");
	//binds the ?s to strings
	mysqli_stmt_bind_param($stmtGetName, 'i', $key);
	//execute the statement
	mysqli_stmt_execute($stmtGetName);
	//save the data
	mysqli_stmt_bind_result($stmtGetName, $client);

	while (mysqli_stmt_fetch($stmtGetName)) {
        $clientName = $client;
    }


	//close connection
	mysqli_close($conn);

	//pair has not been found
	//tell them no pair found and redirect them
	if($clientName == ""){
		echo ('<p class="white-text">Client not found with that ID. Redirecting back to input page...</p>');
		echo ('<meta http-equiv="refresh" content="3; URL=index.php">');
	}
	
	//pair has been found
	//set message and send
	//Let them know the pair and that the message has been sent. redirect back.
	else {
		$subject = $clientName." has left the building";
		$headers = 'From: server@ProjectHorseshoeFarm';
		mail ('gdj0004@gmail.com', $subject , $clientName, $headers);
		echo ('<p class="white-text">The ID is paired to '.$client.'. Message Sent.</p>');
		echo ('<meta http-equiv="refresh" content="3; URL=index.php">');
	}
}

else {
	echo ('<p class="white-text">Value not entered. Redirecting back to input page...</p>');
	echo ('<meta http-equiv="refresh" content="3; URL=index.php">');
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