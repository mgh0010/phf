<?php 
session_start();

if ($_SESSION['username'] == null) {
  header("Location: /login.php");
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
        	<form class="col s12" method="post" action="createRfidandClient.php">
        	<h6>Participant Registration</h6>
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
        	<form class="col s12" method="post" action="testSignal.php">
        	<h6>Test Signal</h6>
            <br />
        		<div class="row">
            		<div class="input-field">
              			<select name="testID">
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

        <br />
        <a href="logoutScript.php" class="btn waves-effect white grey-text darken-text-2">Logout</a>
        <br />
        <br />
    </div>

    
    

 	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
    <script src="app.js"></script>

    
</body>
</html>	