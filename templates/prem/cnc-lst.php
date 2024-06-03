<?php 
// home.php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) { ?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Interv CNC</title>

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Data Table CSS -->
    <link rel='stylesheet' href='https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css'>
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>    

    <link rel="stylesheet" href="/assets/cnc/cnc-inter-lst.css">

</head>

<body>

    <?php include "navbar-ad.php";?>
    <?php include "cnc/cnc-tab-lst.php";?>
   
    <div class="d-flex justify-content-between align-items-center my-margin">
      <h2><font color="#001dad">Interventions sur machines</font></h2>
        <div class="flex-container">
            <a href="adm-cnc.php" class="btn btn-success" type="button">Add</a>
        </div>
    </div>


    <table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>N°</th>
            <th>Date</th>
            <th>Nom & Prén</th>
            <th>Depart</th>
            <th>Type-Prob</th>
            <th>Machine</th>
            <th>Priority</th>
            <th>Subject</th>
            <th>Etat</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($rowCount > 0) {
            // Display the data in the table
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id_cnc"] . "</td>";
                echo "<td>" . $row["created_dt"] . "</td>";
                echo "<td>" . $row["fullname"] . "</td>";
                echo "<td>" . $row["department"] . "</td>";
                echo "<td>" . $row["problemtype"] . "</td>";
                echo "<td>" . $row["name_machine"] . "</td>";
                echo "<td>" . $row["priority"] . "</td>";
                echo "<td>" . $row["subject"] . "</td>";
                echo "<td>" . $row["state"] . "</td>";
                echo "<td class='actions'><a href='cnc-details.php?id_cnc=". $row["id_cnc"]. "'>View</a></td>";

                echo "</tr>";
            }
        }
        ?>
    </tbody>
</table>


    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- Data Table JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                //disable sorting on last column
                "columnDefs": [{
                    "orderable": false,
                    "targets": 5
                }],
                language: {
                    //customize pagination prev and next buttons: use arrows instead of words
                    'paginate': {
                        'previous': '<span class="fa fa-chevron-left"></span>',
                        'next': '<span class="fa fa-chevron-right"></span>'
                    },
                    //customize number of elements to be displayed
                    "lengthMenu": 'Display <select class="form-control input-sm">' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="40">40</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">All</option>' +
                        '</select> results'
                }
            })
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
 