<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 
  <style>
    body {
      padding-top: 70px; /* Adjust body padding to accommodate the fixed navbar */
    }
  </style>

</head>
<body>

        <?php
            $current_page = basename($_SERVER['PHP_SELF']);
        ?>


<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="user-panel.php">AppTech</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
            <li class="nav-item<?php if ($current_page === 'user-panel.php') echo ' active'; ?>"><a class="nav-link" href="user-panel.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
            <li class="nav-item<?php if ($current_page === 'inter.php') echo ' active'; ?>"><a class="nav-link" href="inter.php"><span class="glyphicon glyphicon-tasks"></span> Intervention</a></li>
            <li class="nav-item<?php if ($current_page === 'demande.php') echo ' active'; ?>"><a class="nav-link" href="demande.php"><span class="glyphicon glyphicon-list-alt"></span> Demande</a></li>
            <li class="nav-item<?php if ($current_page === 'suiv.php') echo ' active'; ?>"><a class="nav-link" href="suiv.php"><span class="glyphicon glyphicon-check"></span> Suivie</a></li>
            <li class="nav-item<?php if ($current_page === 'cnc.php') echo ' active'; ?>"><a class="nav-link" href="cnc.php"><span class="glyphicon glyphicon-cog"></span> CNC</a></li>
            <li class="nav-item<?php if ($current_page === 'suiv-cnc.php') echo ' active'; ?>"><a class="nav-link" href="suiv-cnc.php"><span class="glyphicon glyphicon-check"></span> Suivie CNC</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
          <li class="nav-item<?php if ($current_page === 'profile.php') echo ' active'; ?>"><a class="nav-link" href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
          <li class="nav-item<?php if ($current_page === 'logout.php') echo ' active'; ?>"><a class="nav-link" href="/templates/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
        
    </div>
  </div>
</nav>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
</html>

