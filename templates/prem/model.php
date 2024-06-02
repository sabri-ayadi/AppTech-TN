<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) { ?> 

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Utilisateurs</title>


<link rel="stylesheet" href="/assets/suiv-ad/inter-style.css">

</head>
<body>

<?php include "navbar-ad.php";?>
<?php include "conf/user-lst-conf.php";?>








<script>


</script>

</body>
</html>





<?php 

     }

else {
     
     header("Location: /index.php");
     exit();
}
 ?>
 