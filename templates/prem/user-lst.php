<?php 
// home.php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) { ?> 

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Utilisateurs</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel='stylesheet' href='https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>

  <link rel="stylesheet" href="/assets/suiv-ad/user-lst-style.css">

</head>


<?php include "navbar-ad.php";?>
<?php include "conf/user-lst-conf.php";?>


  <div class="d-flex justify-content-between align-items-center my-margin">
      <h2><font color="#ad0000">Liste des Utilisateurs</font></h2>
      <div class="flex-container">
          <a href="user-create.php" class="btn btn-success" type="button">New User</a>
      </div>
  </div>



<table id="example" class="table table-striped" style="width:100%">		
	<thead>
	    <tr>
	      	<th>MAT</th>
	      	<th>Nom & Prén</th>
	      	<th>Department</th>
          <th>Fonction</th>
	      	<th>Type</th>
	      	<th>Email</th>
		      <th>Contact</th>
	        <th>Actions</th>
	    </tr>


	</thead>
  
  <tbody>
      <?php
          if ($rowCount > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["mat"] . "</td>";
                echo "<td>" . $row["fullname"] . "</td>";
                echo "<td>" . $row["department"] . "</td>";
                echo "<td>" . $row["job"] . "</td>";
                echo "<td>" . $row["type"] . "</td>";
                echo "<td>" . $row["mail"] . "</td>";
                echo "<td>" . $row["tel"] . "</td>";
                echo "<td class='actions'><a href='user-edit.php?id=". $row["id"]. "'>Edit</a> | 
                                          <a href='#' onclick='confirmDelete(".$row["id"].", \"".$row["fullname"]."\")'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            // Display a message to the user
            echo "<tr><td colspan='7'>No data found.</td></tr>";
        } 
    ?>
                
  </tbody>

</table>

<!-- delete user confirmation -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.17.1/dist/sweetalert2.all.min.js"></script>
<script>
  function confirmDelete(userId, userName) {
    Swal.fire({
        title: "Are you sure ?",
        text: "You want to delete this user (" + userName + ") !",
        showCancelButton: true,
        showCloseButton: true,
        showConfirmButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: "Yes",
        timer: 3000,
    }).then(function(isConfirmed) {
        if (isConfirmed.value) {
            // If the user confirms the deletion, redirect to the delete script with the user ID
            window.location.href = 'user/user-delete.php?id=' + userId;
        }
    });
}
</script>


<!-- Data Table script -->
<script src='https://code.jquery.com/jquery-3.7.0.js'></script>
<script src='https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js'></script>
<script src='https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js'></script>

<script>
  $(document).ready(function() {
    $('#example').DataTable({
      //disable sorting on last column
      "columnDefs": [
        { "orderable": false, "targets": 5 }
      ],
      language: {
        //customize pagination prev and next buttons: use arrows instead of words
        'paginate': {
          'previous': '<span class="fa fa-chevron-left"></span>',
          'next': '<span class="fa fa-chevron-right"></span>'
        },
        //customize number of elements to be displayed
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
} );
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
 