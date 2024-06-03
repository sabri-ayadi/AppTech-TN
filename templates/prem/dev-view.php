<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) { 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Historique Opérations</title>

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css'>
  <link rel='stylesheet' href='https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css'>
  <link rel='stylesheet' href='https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css'>
  <link rel="stylesheet" href="/assets/dev/dev-view.css">

</head>
<body>
<?php include "navbar-ad.php"; ?>
<?php include "dev/dev-view-conf.php"; ?>

<div class="container">
  <div class="row">
    <div class="col-12">
      <h3 class="titulo-tabla">Historique des opérations de l'équipement :</h3>
      <h4 class="titulo-tabla">Nom: <?php echo $deviceInfo['device_nom']; ?> Model: <?php echo $deviceInfo['device_model']; ?></h4>
      <div class="table-container">
      <table id="ejemplo" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th class="col-id">N°</th>
                <th class="col-creation">Création</th>
                <th class="col-user">User</th>
                <th class="col-user-dep">Departm</th>
                <th class="col-type-prob">Type-Prob</th>
                <th class="col-priority">Priority</th>
                <th class="col-subject">Subject</th>
                <th class="col-solution">Solution</th>
                <th class="col-state">Etat</th>
            </tr>
        </thead>
        <tbody>
          <?php foreach ($interdemandeData as $data): ?>
            <tr>
                <td><?php echo $data['id_inter']; ?></td>
                <td><?php echo $data['created_dt']; ?></td>
                <td><?php echo $data['fullname']; ?></td>
                <td><?php echo $data['department']; ?></td>
                <td><?php echo $data['problemtype']; ?></td>
                <td><?php echo $data['priority']; ?></td>
                <td><?php echo $data['subject']; ?></td>
                <td><?php echo $data['solution']; ?></td>
                <td><?php echo $data['state']; ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
          </div>
    </div>
  </div>
</div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/js/bootstrap.min.js'></script>
<script src='https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js'></script>
<script src='/assets/dev/script.js'></script>

</body>
</html>

<?php 
}
else {
    header("Location: /index.php");
    exit();
}
?>
