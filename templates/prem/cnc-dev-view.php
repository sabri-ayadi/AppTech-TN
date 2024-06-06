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
<?php include "cnc/cnc-dev-conf.php";?>


  <div class="my-margin">
      <h2><font color="#077cb0">Historique des opérations sur la machine : </font></h2>
  </div>

  <table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th class="col-id">N°</th>
            <th class="col-creation">Création</th>
            <th class="col-user">User</th>
            <th class="col-user-dep">Departement</th>
            <th class="col-type-prob">Type-Prob</th>
            <th class="col-priority">Priority</th>
            <th class="col-subject">Subject</th>
            <th class="col-solution">Solution</th>
            <th class="col-state">Etat</th>
            <!-- <th class="col-servedby">Served</th> -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($interdemandeData as $data): ?>
        <tr>
            <td><?php echo htmlspecialchars($data['id_cnc']); ?></td>
            <td><?php echo htmlspecialchars($data['created_dt']); ?></td>
            <td><?php echo htmlspecialchars($data['fullname']); ?></td>
            <td><?php echo htmlspecialchars($data['department']); ?></td>
            <td><?php echo htmlspecialchars($data['problemtype']); ?></td>
            <td><?php echo htmlspecialchars($data['priority']); ?></td>
            <td><?php echo htmlspecialchars($data['subject']); ?></td>
            <td><?php echo htmlspecialchars($data['solution']); ?></td>
            <td><?php echo htmlspecialchars($data['state']); ?></td>
            <!-- <td><?php echo htmlspecialchars($data['servedby']); ?></td> -->
        </tr>
        <?php endforeach; ?>
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
 