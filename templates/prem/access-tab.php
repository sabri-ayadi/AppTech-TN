<?php 
// home.php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) { ?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Access Tab</title>

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Data Table CSS -->
    <link rel='stylesheet' href='https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css'>
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>    

    <link rel="stylesheet" href="/assets/suiv-ad/access-tab.css">

</head>

<body>

    <?php include "navbar-ad.php";?>
    <?php include "dev/access-tab-conf.php";?>
   
    <div class="d-flex justify-content-between align-items-center my-margin">
      <h2><font color="#001dad">Table d'access aux Equipements</font></h2>
        <div class="flex-container">
            <a href="access-create.php" class="btn btn-success" type="button">Ajouter Accès</a>
        </div>
    </div>


    <table id="example" class="table table-striped" style="width:100%">
        

        <?php
        // Check if success message is set after a successful Access get deleted
        if (isset($_GET['success'])) {
            // Display success message using Bootstrap alert component
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
            echo '<strong>Success!</strong> ' . $_GET['success'];
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        }
        ?>


        <thead>
            <tr>
                <th>#Ref</th>
                <th>Created</th>
                <th>Mat User</th>
                <th>Nom & Prén</th>
                <th>Department</th>
                <th>ID Equip</th>
                <th>Type</th>
                <th>Nom</th>
                <th>Model</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if ($rowCount > 0) {
                // Display the data in the table
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["iduser_access"] . "</td>";
                    echo "<td>" . $row["date"] . "</td>";
                    echo "<td>" . $row["mat"] . "</td>";
                    echo "<td>" . $row["fullname"] . "</td>";
                    echo "<td>" . $row["department"] . "</td>";
                    echo "<td>" . $row["id_dev"] . "</td>";
                    echo "<td>" . $row["type"] . "</td>";
                    echo "<td>" . $row["nom"] . "</td>";
                    echo "<td>" . $row["model"] . "</td>";
                    echo "<td>" . $row["dep"] . "</td>";
                    echo "<td class='actions'><a href='#' onclick='confirmDelete(".$row["iduser_access"].", \"".$row["fullname"]."\")'>Delete</a></td>";

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

 <!-- this script is for deleting successful Alert -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- delete access confirmation -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.1/dist/sweetalert2.all.min.js"></script>
<script>
  function confirmDelete(accessId, fullname) {
    Swal.fire({
        title: "Are you sure ?",
        text: "You want to delete this User Access for " + fullname + " !",
        showCancelButton: true,
        showCloseButton: true,
        showConfirmButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: "Yes",
        timer: 3000,
    }).then(function(isConfirmed) {
        if (isConfirmed.value) {
            // If the user confirms the deletion, redirect to the delete script with the access ID
            window.location.href = 'access-delete.php?iduser_access=' + accessId;
        }
    });
}
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
 