<?php 
// home.php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) { ?> 

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>View CNC Equip</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel='stylesheet' href='https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>
<link rel="stylesheet" href="/assets/suiv-ad/inter-style.css">

</head>
<body>

<?php include "navbar-ad.php";?>
<?php include "cnc/dev-cnc-lst-conf.php";?>


  <div class="my-margin">
      <h2><font color="#077cb0">Historique Interventions su Machine :</font></h2>
  </div>


  











  




  

</body>
</html>


<?php 

     }

else {
     
     header("Location: /index.php");
     exit();
}
 ?>
 