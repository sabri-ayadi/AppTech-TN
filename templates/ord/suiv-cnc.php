<?php 
// home.php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 2) { ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suivie CNC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/cnc/usr_suiv_cnc.css">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">

</head>

<?php include "navbar.php";?> 
<?php include "conf/suiv-cnc-conf.php";?>

<body>

<div class="container">
  <h1><span>Suivie des Opérations CNC :</span></h1>
  <br>
    <table id="example" class="table table-striped">		

      <thead>

              <tr class="btn-primary">
                <th class="col-id">N°</th>
                <th class="col-creation">Création</th>
                <th class="col-machine">Machine</th>
                <th class="col-model">Model</th>
                <th class="col-problem">Probleme</th>
                <th class="col-priority">Priority</th>
                <th class="col-subject">Subject</th>
                <th class="col-etat">Etat__</th>
                <!-- <th>Action</th> -->
              </tr>


        </thead>

        <tbody>
          <?php
                  if ($rowCount > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["id_inter"] . "</td>";
                        echo "<td>" . $row["created_dt"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["model"] . "</td>";
                        echo "<td>" . $row["problemtype"] . "</td>";
                        echo "<td>" . $row["priority"] . "</td>";
                        echo "<td>" . $row["subject"] . "</td>";
                        echo "<td>" . $row["state"] . "</td>";
                        // echo "<td class='actions'><a href='cnc-view.php?id_inter=". $row["id_inter"]. "'>View</a> | <a href='cnc-edit.php?id_inter=". $row["id_inter"]. "'>Edit</a> </td>";
                        echo "</tr>";
                    }
                } else {
                    // Display NO DATA message
                    echo "<tr><td colspan='7'>No data found.</td></tr>";
                }
                ?>
          </tbody>
    </table>
</div>


    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">
          $(document).ready(function() {
            $('#example').DataTable();
        });
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
