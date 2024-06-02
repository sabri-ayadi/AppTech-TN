<?php 
// home.php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) { ?> 

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CNC Equip</title>

<!-- Bootstrap 5 CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<!-- Data Table CSS -->
<link rel='stylesheet' href='https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css'>
<!-- Font Awesome CSS -->
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>


<link rel="stylesheet" href="/assets/suiv-ad/inter-style.css">

<style>
  /* Styles for the dropdown button */

  
</style>
</head>
<body>

<?php include "navbar-ad.php";?>
<?php include "cnc/dev-cnc-lst-conf.php";?>


  <div class="my-margin">
      <h2><font color="#077cb0">Liste PC CNC</font></h2>
  </div>


<table id="example" class="table table-striped" style="width:100%">		
	<thead>
	    <tr>
	      	<th>ID</th>
	      	<th>Name</th>
	      	<th>model</th>
	      	<th>S.N</th>
	      	<th>Type</th>
	      	<th>IP Inter</th>
	      	<th>IP Cam R</th>
	      	<th>IP Cam L</th>
	        <th>Actions</th>
	    </tr>


	</thead>
  
  <tbody>
      <?php
          if ($rowCount > 0) {
            // Display the data in the table
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id_machine"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["model"] . "</td>";
                echo "<td>" . $row["s_n"] . "</td>";
                echo "<td>" . $row["type"] . "</td>";
                echo "<td>" . $row["ip_1"] . "</td>";
                echo "<td>" . $row["ip_cam_r"] . "</td>";
                echo "<td>" . $row["ip_cam_l"] . "</td>";
                echo "<td class='actions'><a href='inter-view.php?id_machine=". $row["id_machine"]. "'>View</a> | <a href='inter-edit.php?id_machine=". $row["id_machine"]. "'>Edit</a> | <a href='inter-delete.php?id_machine=". $row["id_machine"]. "'>Delete</a></td>";
                echo "</tr>";
            }
        } 
        // else {
        //     // Display a message to the user
        //     echo "<tr><td colspan='7'>No data found.</td></tr>";
        // } 
      ?>
                
  </tbody>

</table>

<!-- jQuery -->
<script src='https://code.jquery.com/jquery-3.7.0.js'></script>
<!-- Data Table JS -->
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
 