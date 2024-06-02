<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 2) { ?> 

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/assets/cnc/update-cnc.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    <title>Edit</title>
    
</head>
<body>

<?php include "navbar.php";?> 

      <div class="container">
          <div class="custom-container">
            <h2>Modifier Intervention N°: </h2>
            <br>

            <div class="form">
                <form id="update-cnc-form" action="" method="post">

                
                        <div class="divbtn">
                            <a class="btn btn-outline-danger" type="button" href="suiv-cnc.php">Cancel</a>
                            <button class="btn btn-outline-success" type="submit" value='submit' id='submit'>Update</button>
                        </div>
                </form>
            </div>
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
 