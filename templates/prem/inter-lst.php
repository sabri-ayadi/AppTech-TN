<?php 
// home.php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) { ?> 


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Interventions</title>

<!-- Bootstrap 5 CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<!-- Data Table CSS -->
<link rel='stylesheet' href='https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css'>
<!-- Font Awesome CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>

<link rel="stylesheet" href="/assets/suiv-ad/inter-style.css">

<style>
        p {
            font-size: 16px;
            margin-bottom: 5px;
        }
        
        strong {
            color: blue;
        }
</style>


</head>
<body>

<?php include "navbar-ad.php";?>
<?php include "conf/inter-lst-conf.php";?>
<?php include "inter/inter-modal.php";?>


  <div class="d-flex justify-content-between align-items-center my-margin">
      <h2><font color="#ad0000">Liste des Interventions</font></h2>
      <div class="flex-container">
          <a href="adm-inter.php" class="btn btn-success" type="button">Nouv. Intervention</a>
      </div>
  </div>



<table id="example" class="table table-striped">		
<thead>
    <tr>
        <th class="col-id">N°</th>
        <th class="col-creation">Création</th>
        <th class="col-user">User</th>
        <th class="col-user-dep">Departm</th>
        <th class="col-type-prob">Type-Prob</th>
        <th class="col-equipment">Equipement</th>
        <th class="col-priority">Priority</th>
        <th class="col-subject">Subject</th>
        <th class="col-state">Etat</th>
        <th class="col-actions">Actions</th>
    </tr>
</thead>

  
  <tbody>
    <?php
    if ($rowCount > 0) {
        // Display the data in the table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row["id_inter"] . "</td>";
            echo "<td>" . $row["created_dt"] . "</td>";
            echo "<td>" . $row["fullname"] . "</td>";
            echo "<td>" . $row["department"] . "</td>";
            echo "<td>" . $row["problemtype"] . "</td>";
            echo "<td>" . $row["device_name"] . "</td>";
            echo "<td>" . $row["priority"] . "</td>";
            echo "<td>" . $row["subject"] . "</td>";
            echo "<td>" . $row["state"] . "</td>";
            echo "<td class='actions'>";
            echo "<button type='button' class='btn btn-info btn-sm btn-view' data-id='" . $row["id_inter"] . "'>View</button> ";
            // echo "<button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteModal' onclick=\"setModalId({$row["id_inter"]})\">Delete</button>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        // Display a message to the user
        echo "<tr><td colspan='7'>No data found.</td></tr>";
    }
    ?>
</tbody>
</table>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Bootstrap 5 JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewModalLabel">Intervention Details:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="interventionDetails">
        <!-- Intervention details will be dynamically inserted here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="moreDetailsButton">More details</button>
      </div>
    </div>
  </div>
</div>



<script>
$(document).ready(function() {
  $('.btn-view').click(function() {
    var id_inter = $(this).data('id');
    
    $.ajax({
      url: 'inter/inter-modal.php',
      method: 'GET',
      data: { id_inter: id_inter },
      success: function(response) {
        $('#interventionDetails').html(response);
        $('#viewModal').modal('show');
        
        $('#moreDetailsButton').click(function() {
          window.location.href = 'inter-details.php?id_inter=' + id_inter;
        });
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
  });
});


</script>




<!-- jQuery -->
<script src='https://code.jquery.com/jquery-3.7.0.js'></script>
<!-- Data Table JS -->
<script src='https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js'></script>
<script src='https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js'></script>

<script>
$(document).ready(function() {
  $('#example').DataTable({
    // Disable sorting on last column
    "columnDefs": [
      { "orderable": false, "targets": 8 }
    ],
    // Enable auto width
    "autoWidth": true,
    language: {
      // Customize pagination prev and next buttons: use arrows instead of words
      'paginate': {
        'previous': '<span class="fa fa-chevron-left"></span>',
        'next': '<span class="fa fa-chevron-right"></span>'
      },
      // Customize number of elements to be displayed
      "lengthMenu": 'Display <select class="form-control input-sm">'+
      '<option value="10">10</option>'+
      '<option value="20">20</option>'+
      '<option value="30">30</option>'+
      '<option value="40">40</option>'+
      '<option value="50">50</option>'+
      '<option value="-1">All</option>'+
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
 