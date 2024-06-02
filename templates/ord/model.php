<?php 
// home.php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 2) { ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/usr_inter.css">
    <title>Intervention</title>
</head>    


<?php include "navbar.php";?> 
<?php include "conf/-conf.php";?>  <!-- change the path to include correct files -->

<body>






</body>
</html>


<?php 

     }

else {
     
     header("Location: /index.php");
     exit();
}
 ?>