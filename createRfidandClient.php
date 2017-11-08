<?php
session_start();
?>

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
      	<p class="white-text">Participant Registration</p>
    	
    	<br /> <br />

<?php 

$servername = "localhost";
$username = "garretti_admin";
$password = "Password1";
$dbname = "garretti_phf";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if(isset($_POST['clientName']) && isset($_POST['ID']) && $_POST['ID'] != NULL) {
	$name = $_POST['clientName'];
	$id = $_POST['ID'];

	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	} 

	//get id
	//prepare the sql statement
	$stmt = mysqli_prepare($conn, "SELECT ID FROM IDs WHERE wearableID = ?");
	//bind param
	mysqli_stmt_bind_param($stmt, 's', $id);
    //execute the statement
    mysqli_stmt_execute($stmt);
	//store the statements result
    mysqli_stmt_bind_result($stmt, $matchingID);

	while (mysqli_stmt_fetch($stmt)) {
        $idKey = $matchingID;
    }

 
    //Check if another Client was previously using this ID
	$clientMatch = null;
	//prepare the sql statement
	$stmtIDCheck = mysqli_prepare($conn, "SELECT ID FROM Clients WHERE wearableID = ?");
	//bind param
	mysqli_stmt_bind_param($stmtIDCheck, 'i', $idKey);
    //execute the statement
    mysqli_stmt_execute($stmtIDCheck);
	//store the statements result
    mysqli_stmt_bind_result($stmtIDCheck, $matchingName);
	while (mysqli_stmt_fetch($stmtIDCheck)) {
        $clientMatch = $matchingName;
	}
	
	$blankID = 0;
	//If the ID is currently bound to another Client, set their current wearableID to null to prevent duplication
	if($clientMatch != null)
	{
		//prepare the sql statement
		$stmtIDOverride = mysqli_prepare($conn, "UPDATE Clients SET wearableID = ? WHERE ID = ?");
		//bind param
		mysqli_stmt_bind_param($stmtIDOverride, 'is', $blankID, $clientMatch);
		//execute the statement
		mysqli_stmt_execute($stmtIDOverride);
	
	}

	//create client with name and ID
	//prepare the sql statement
	$stmt2 = mysqli_prepare($conn, "REPLACE INTO Clients (ClientName, wearableID)
	VALUES (?, ?)");
	//binds the ?s to strings
	mysqli_stmt_bind_param($stmt2, 'si', $name, $idKey);
	//execute the statement
	mysqli_stmt_execute($stmt2);

	//close connection
	mysqli_close($conn);

	//begin to refresh the page, let them know was creaed and going back to main page
	echo ('<p class="white-text">Client created. Redirecting back to input page...</p>');
	if ($_SESSION['isAdmin'] == 0)
		echo ('<meta http-equiv="refresh" content="3; URL=index.php">');
	else if ($_SESSION['isAdmin'] == 1)
		echo ('<meta http-equiv="refresh" content="3; URL=admin.php">');
}

else {
	echo ('<p class="white-text">Name or ID not entered. Redirecting back to input page...</p>');
	if ($_SESSION['isAdmin'] == 0)
		echo ('<meta http-equiv="refresh" content="3; URL=index.php">');
	else if ($_SESSION['isAdmin'] == 1)
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