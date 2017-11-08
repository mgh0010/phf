<?php 
session_start();

if ($_SESSION['username'] == null || $_SESSION['isAdmin'] != 1) {
  header("Location: /logoutScript.php");
}
?>

<!DOCTYPE html>
<html id="user">
<head>
  <title>Project Horseshoe Farm</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="style.css" type="text/css" rel="stylesheet" media="screen,projection" />
</head>
<body >
  <nav>
	  <div class="nav-wrapper row">
		  <a href="#" class="brand-logo" id="logo">Project Horseshoe Farm</a>
	  </div>
	</nav>

	<br />
	<div class="container">
	  <div class="row">
		<h6>Participant Registration</h6>
		  <form class="col s12" method="post" action="createRfidandClient.php">
		  
			<div class="row">
				<div class="input-field">
					<input type="text" name="clientName">
					<label>Name</label>
				</div>
			</div>

				<div class="row">
					<div class="input-field">
						<select name="ID">
							<option value="" disabled selected>Choose your option</option>
							<?php

								$servername = "localhost";
								$username = "garretti_admin";
								$password = "Password1";
								$dbname = "garretti_phf";


								//creates connection
								$conn = new mysqli($servername, $username, $password, $dbname);

								$stmt = mysqli_prepare($conn, "SELECT wearableID FROM IDs");
								//execute the statement
								mysqli_stmt_execute($stmt);
								//store the statements result
								mysqli_stmt_bind_result($stmt, $id);

								while (mysqli_stmt_fetch($stmt)) {
									echo('<option value="'.$id.'">'.$id.'</option>');
								}

								mysqli_close($conn)
							?>

						</select>
						<label>ID</label>

						<div id="indexButtons">
							<button class="btn waves-effect white grey-text darken-text-2" type="submit" name="action">Register</button>
						</div>
					</div>
					
				</div>
		  </form>
	  </div>

	  <br /><br />
	  <div class="row" id="test">
		<h6>Test Signal</h6>
		  <form class="col s12" method="post" action="testSignal.php">
		  
		  <br />
			<div class="row">
				<div class="input-field">
					<select name="ID">
							<option value="" disabled selected>Choose your option</option>
							<?php

								$servername = "localhost";
								$username = "garretti_admin";
								$password = "Password1";
								$dbname = "garretti_phf";


								//creates connection
								$conn = new mysqli($servername, $username, $password, $dbname);

								$stmt = mysqli_prepare($conn, "SELECT wearableID FROM IDs");
								//execute the statement
								mysqli_stmt_execute($stmt);
								//store the statements result
								mysqli_stmt_bind_result($stmt, $id);

								while (mysqli_stmt_fetch($stmt)) {
									echo('<option value="'.$id.'">'.$id.'</option>');
								}

								mysqli_close($conn)
							?>

						</select>
						<label>ID</label>

					<div id="indexButtons">
					  <button class="btn waves-effect white grey-text darken-text-2" type="submit" name="action">Submit</button>
					</div>
				</div>
			  </div>
		  </form>
	  </div>

	  <br /><br />
	  <div class="row" id="test">
		<h6>Add New ID</h6>
		  <form class="col s12" method="post" action="createID.php">
			<div class="row">
				<div class="input-field">
					<input type="text" name="newID">
					<label>ID</label>

					<div id="indexButtons">
					  <button class="btn waves-effect white grey-text darken-text-2" type="submit" name="action">Submit</button>
					</div>
				</div>
			  </div>
		  </form>
	  </div>

	  <br /><br />
	  <div class="row" id="test">
		<h6>Remove ID</h6>
		  <form class="col s12" method="post" action="removeID.php">
		  
		  <br />
			<div class="row">
				<div class="input-field">
					<select name="ID">
							<option value="" disabled selected>Choose your option</option>
							<?php

								$servername = "localhost";
								$username = "garretti_admin";
								$password = "Password1";
								$dbname = "garretti_phf";


								//creates connection
								$conn = new mysqli($servername, $username, $password, $dbname);

								$stmt = mysqli_prepare($conn, "SELECT wearableID FROM IDs");
								//execute the statement
								mysqli_stmt_execute($stmt);
								//store the statements result
								mysqli_stmt_bind_result($stmt, $id);

								while (mysqli_stmt_fetch($stmt)) {
									echo('<option value="'.$id.'">'.$id.'</option>');
								}

								mysqli_close($conn)
							?>

						</select>
						<label>ID</label>

					<div id="indexButtons">
					  <button class="btn waves-effect white grey-text darken-text-2" type="submit" name="action">Submit</button>
					</div>
				</div>
			  </div>
		  </form>
	  </div>

	  <br /><br />
	  <div class="row">
		<h6>Create New User</h6>
		  <form class="col s12" method="post" action="createUser.php">
		  <div class="row">
				<div class="input-field">
					<input type="text" name="username">
					<label>Username</label>
				</div>
			</div>

			<div class="row">
				<div class="input-field">
					<input type="text" name="password">
					<label>Password</label>
				</div>
			</div>

			<div class="row">
				<p><span style="color: white; font-size: 10pt;">Admin?</span></p>
				<div class="input-field">
					<div class='switch'>
						<label>
							No
							<input name='admin' type='hidden' value='0'>
							<input name='admin' type='checkbox' value='1'>
							<span class='lever'></span>
							Yes
						</label>
					</div>

					
				</div>
			</div>

			<div class="row">
				<div class="input-field">
					<div id="indexButtons">
						<button class="btn waves-effect white grey-text darken-text-2" type="submit" name="action">Submit</button>
					</div>
				</div>
			</div>

		  </form>
	  </div>

	  <br /><br />
	  <div class="row">
	  <h6>Remove all pairings</h6>
		  <form class="col s12" method="post" action="removePairings.php">
			<div class="row">
				<div class="input-field">
					  <button class="btn waves-effect white grey-text darken-text-2" type="submit" name="action">Submit</button>
				</div>
			  </div>
		  </form>
	  </div>

		<br /> <br /> <br />
		<div class="row">
			<h6>Logout</h6>
				<a href="logoutScript.php" class="btn waves-effect white grey-text darken-text-2">Logout</a>
			</div>
		<br /><br />
	</div>

	
	

  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
	<script src="app.js"></script>

	
</body>
</html> 