<?php 
// home.php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) { ?> 

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Equipement</title>

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
<?php include "conf/dev-lst-conf.php";?>


  <div class="my-margin">
      <h2><font color="#077cb0">Liste des Equipements</font></h2>
  </div>


<table id="example" class="table table-striped" style="width:100%">		
	<thead>
	    <tr>
	      	<th>ID</th>
	      	<th>Type</th>
	      	<th>Name</th>
	      	<th>Session</th>
	      	<th>UserName</th>
	      	<!-- <th>Location</th> -->
	      	<th>Departement</th>
	      	<th>Model</th>
	      	<!-- <th>CPU</th> -->
	      	<!-- <th>RAM</th> -->
	      	<!-- <th>Stotage</th> -->
	      	<!-- <th>OS</th> -->
	      	<th>IP</th>
	      	<!-- <th>MAC</th> -->
	      	<!-- <th>S/N</th> -->
	      	<!-- <th>Domaine</th> -->
	      	<!-- <th>Conx-Type</th> -->
	      	<!-- <th>MS Office</th> -->
	      	<!-- <th>Antivirus</th> -->
	      	<!-- <th>StartDate</th> -->
		      <th>State</th>
			    <!-- <th>Health</th> -->
	        <th>Actions</th>
	    </tr>


	</thead>
  
  <tbody>
      <?php
          if ($rowCount > 0) {
            // Display the data in the table
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id_dev"] . "</td>";
                echo "<td>" . $row["type"] . "</td>";
                echo "<td>" . $row["nom"] . "</td>";
                echo "<td>" . $row["session"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                // echo "<td>" . $row["location"] . "</td>";
                echo "<td>" . $row["dep"] . "</td>";
                echo "<td>" . $row["model"] . "</td>";
                // echo "<td>" . $row["cpu"] . "</td>";
                // echo "<td>" . $row["ram"] . "</td>";
                // echo "<td>" . $row["storage"] . "</td>";
                // echo "<td>" . $row["os"] . "</td>";
                echo "<td>" . $row["ip"] . "</td>";
                // echo "<td>" . $row["mac"] . "</td>";
                // echo "<td>" . $row["sn"] . "</td>";
                // echo "<td>" . $row["domain"] . "</td>";
                // echo "<td>" . $row["conx_type"] . "</td>";
                // echo "<td>" . $row["ms_office"] . "</td>";
                // echo "<td>" . $row["antivirus"] . "</td>";
                // echo "<td>" . $row["start_date"] . "</td>";
                echo "<td>" . $row["state"] . "</td>";
                // echo "<td>" . $row["health"] . "</td>";
                echo "<td class='actions'><a href='inter-view.php?id_dev=". $row["id_dev"]. "'>View</a> | <a href='inter-edit.php?id_dev=". $row["id_dev"]. "'>Edit</a> | <a href='inter-delete.php?id_dev=". $row["id_dev"]. "'>Delete</a></td>";
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
 