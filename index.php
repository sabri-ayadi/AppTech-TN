<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="/assets/log/login.css">
</head>
<body>
	<div class="container">
		<div class="login">
			<form action="login.php" method="POST">
				<img src="/assets/navbar-ad/logo.png" alt="logo" class="logo">
				<h2>AppTech Login</h2>

				<?php if (isset($_GET['error'])) { ?>
					<p class="error"><?php echo $_GET['error']; ?></p>
				<?php } ?>

				<label>Matricule, Username :</label>
				<input type="text" name="mat" placeholder="matricule ou username" required><br>

				<label>Mot de passe :</label>
				<input type="password" name="password" placeholder="password" required><br>

				<div class="btn">
					<button type="submit">Login</button>
				</div>
			</form>
		</div>
	</div>

</body>
</html>