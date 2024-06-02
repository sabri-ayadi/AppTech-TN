<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) { ?> 

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Gestion Devices</title>

<!-- link: https://www.codehim.com/menu/javascript-tab-navigation-with-indicator/ -->
<link rel="stylesheet" href="/assets/dev/dev-gest.css">
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

</head>
<body>

<?php include "navbar-ad.php";?>
<!-- <?php include "conf/user-lst-conf.php";?> -->


<div class="container">
<div class="tabs">
	<nav class="tabs-nav">
		<ol class="nav-list">
			<li class="nav-item">
				<a href="#add" class="nav-link">Create</a>
			</li>
			<li class="nav-item">
				<a href="#update" class="nav-link">Update</a>
			</li>
			<li class="nav-item">
				<a href="#remove" class="nav-link">Remove</a>
			</li>
		</ol>
	</nav>

	<div class="tabs-panels">
		<div class="tabs-panel" id="add" style=""></div>
		<div class="tabs-panel" id="update" style="display: none;"></div>
		<div class="tabs-panel" id="remove" style="display: none;"></div>
	</div>
</div>

</div>

<!-- script for mapping tabs -->
<script src="/assets/dev/dev-gest.js"></script>

</body>
</html>


<?php 

     }

else {
     
     header("Location: /index.php");
     exit();
}
 ?>
 