
<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="/assets/login.css">
</head>
<body>
	<form action="login.php" method="post">
		<h2>Login</h2>

		<?php if (isset($_GET['error'])) { ?>
			<p class="error"><?php echo $_GET['error']; ?></p>
		<?php } ?>

		<label>Matriculation Number</label>
		<input type="text" name="mat" placeholder="Matriculation Number"><br>

		<label>Password</label>
		<input type="password" name="password" placeholder="Password"><br>

		<button type="submit">Login</button>
	</form>
	
</body>
</html>