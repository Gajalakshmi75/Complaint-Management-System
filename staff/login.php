<?php include('server3.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Staff Login</h2>
	</div>
	
	<form method="post" action="">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Admin Id</label>
			<input type="text" name="username">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login">Login</button>
		</div>
	</form>

</body>
</html>