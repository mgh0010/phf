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
      	<p class="white-text">Login System</p>
    	
    	<br /> <br />
		<?php

		$servername = "localhost";
		$username = "garretti_admin";
		$password = "Password1";
		$dbname = "garretti_phf";


		//creates connection
		$conn = new mysqli($servername, $username, $password, $dbname); 

		//checks if values are set
		if(isset($_POST['username']) && isset($_POST['password']) && $_POST['password'] != null && $_POST['username'] != null) {
			//get values from post request
			$username = $_POST['username'];
			$password = $_POST['password'];

			// Check connection
			if ($conn->connect_error) {
		    	die("Connection failed: " . $conn->connect_error);
			}

			//prepare the sql statement
			$stmt = mysqli_prepare($conn, "SELECT username, password FROM Users WHERE username = ? and password = ?");
			//binds the ?s to strings
			mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
			//execute the statement
			mysqli_stmt_execute($stmt);
			//store the statements result
			mysqli_stmt_store_result($stmt);

			//set the count to the number of matching rows
			//will be 1 if a user exists
			$count = mysqli_stmt_num_rows($stmt);

			//the account exists because count is 1
			if($count >= 1) {
				echo ('<p class="white-text">Logging in...</p>');

				//gets whether user is an admin
				$isAdmin = mysqli_query($conn, "SELECT isAdmin FROM Users WHERE username='$username'");
				$row = mysqli_fetch_array($isAdmin);

				//if not an admin, go to user page
				if($row['isAdmin'] == 0){
					$_SESSION['username'] = $username;
					echo ('<meta http-equiv="refresh" content="2; URL=index.php">');
				}

				//if admin, go to admin page
				if($row['isAdmin'] == 1){
					$_SESSION['username'] = $username;
					$_SESSION['isAdmin'] = 1;
					echo ('<meta http-equiv="refresh" content="2; URL=admin.php">');
				}

			}
			//count doesnt = 1 so the combo doesnt exist. redirect
			else {
				echo ('<p class="white-text">Not a correct Username and Password combination... Redirecting back to login screen</p>');
				echo ('<meta http-equiv="refresh" content="3; URL=login.php">');
			}
		}
		//fields not entered, redirect
		else {
			
			echo ('<p class="white-text">Username or Password was not entered... Redirecting back to login screen </p>');
			echo ('<meta http-equiv="refresh" content="3; URL=login.php">');
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