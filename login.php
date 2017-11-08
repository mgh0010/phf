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
			<br />
      		<h4 class="white-text">Project Horseshoe Farm</h4>
      		<p class="white-text">Login System</p>
      		</div>

      		
      		<form method="post" action="loginScript.php">
				<div class="input-field">
					<input type="text" name="username">
					<label>Username</label>
				</div>
				<div class="input-field">
					<input type="password" name="password">
					<label>Password</label>
				</div>
				<div class="center-align">
					<button class="btn waves-effect white grey-text darken-text-2" type="submit" name="action">Login</button>
				</div>
			</form>

   	</div>

	<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
</body>
</html>