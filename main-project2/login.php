<?php include ('database/server.php') ?>





<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.min.css">
	<link rel="stylesheet" href="login.css">

</head>

<body>

	<div class="header">
	</div>
	<div class="main-container">
		<h1>Inventory System</h1>

		<form method="post" action="login.php">
			<?php include ('errors.php'); ?>
			<div class="input-group">
				<label>Username</label>
				<input type="text" name="username">
			</div>
			<div class="input-group">
				<label>Password</label>
				<input type="password" name="password">
			</div>
			<div class="input-group">
				<button type="submit" class="btn" name="login_user">Login</button>
			</div>
			<!-- <p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p> -->
		</form>
	</div>


</body>

</html>