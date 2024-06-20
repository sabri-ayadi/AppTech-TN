<?php 
// home.php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 2) { ?>


     <!DOCTYPE html>
     <html>
     <head>
          <title>HOME</title>
          <link rel="stylesheet" type="text/css" href="/assets/user/ord.css">
     </head>        
     <?php include "navbar.php";?>

     <body>
            <div class="container">
                <h1 class="heading">Bienvenu, <?php echo $_SESSION['fullname']; ?></h1>
                <p class="paragraph">Email: <span class="mail"><?php echo $_SESSION['mail']; ?></span></p>
                <p class="paragraph">Type: <span class="type"><?php echo $_SESSION['type']; ?></span></p>
                <p class="paragraph">Matriculation Number: <span class="mat"><?php echo $_SESSION['mat']; ?></span></p>
                
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
