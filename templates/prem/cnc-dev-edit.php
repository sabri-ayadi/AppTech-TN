<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) {
    require dirname(__DIR__) . '../../includes/db_connect.php';
    
    $machId = $_GET['id_machine'];
    
    $sql = "SELECT * FROM machine WHERE id_machine = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $machId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $mach = mysqli_fetch_assoc($result);
    
    if (!$mach) {
        $_SESSION['error_message'] = "Machine not found.";
        header("Location: cnc-lst.php");
        exit();
    }
    
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit CNC Equip</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/cnc/cnc-edit.css">
</head>
<body>

<?php include "navbar-ad.php";?>

<div class="container">
  <div class="custom-container">
      <h2><font color="077cb0">Modifier la machine CNC N° : </font><font color="#9f0404"><?php echo $mach['id_machine']; ?></h2> </font></br>
      
      <!-- Display success and error messages here -->
      <?php if (isset($_SESSION['success_message'])): ?>
          <div class="alert alert-success" role="alert">
              <?php echo $_SESSION['success_message']; ?>
          </div>
          <?php unset($_SESSION['success_message']); ?>
      <?php endif; ?>

      <?php if (isset($_SESSION['error_message'])): ?>
          <div class="alert alert-danger" role="alert">
              <?php echo $_SESSION['error_message']; ?>
          </div>
          <?php unset($_SESSION['error_message']); ?>
      <?php endif; ?>

      <form method="POST" action="cnc/cnc-edit-conf.php">
          <input type="hidden" name="id_machine" value="<?php echo $mach['id_machine']; ?>">

          <div class="row">
              <div class="col">
                  <label for="name">Nom machine: *</label>
                  <input type="text" name="name" id="name" value="<?php echo $mach['name']; ?>" required>
              </div>
          </div>

          <div class="row">
              <div class="col">
                  <label for="model">Model : *</label>
                  <input type="text" name="model" id="model" value="<?php echo $mach['model']; ?>" required>
              </div>
          </div>

          <div class="row">
              <div class="col">                    
                  <label for="type">Type:</label>
                  <input type="text" id="type" name="type" value="<?php echo $mach['type']; ?>" required><br>
              </div>
          </div>

          <div class="row">
              <div class="col">
                  <label for="s_n">S-N: *</label>
                  <input type="text" name="s_n" id="s_n" value="<?php echo $mach['s_n']; ?>" readonly required>
              </div>

              <div class="col">
                  <label for="ip_1">IP Internet: *</label>
                  <input type="text" name="ip_1" id="ip_1" value="<?php echo $mach['ip_1']; ?>" required>
              </div>
          </div>

          <div class="row">
              <div class="col">
                  <label for="ip_cam_r">IP Camera Left : *</label>
                  <input type="text" name="ip_cam_r" id="ip_cam_r" value="<?php echo $mach['ip_cam_r']; ?>" required>
              </div>

              <div class="col">
                  <label for="ip_cam_l">IP Camera Right : *</label>
                  <input type="text" name="ip_cam_l" id="ip_cam_l" value="<?php echo $mach['ip_cam_l']; ?>" required>
              </div>
          </div>
          <div class="row">
              <div class="col">
                  <label for="comment">Autre Informations : *</label>
                  <input type="text" name="comment" id="comment" value="<?php echo $mach['comment']; ?>" placeholder="no comment"></input>
              </div>
          </div>
          <br>

          <div class="divbtn">
              <a href="cnc-dev-lst.php" class="btn btn-outline-secondary">Retour</a>
              <button type="submit" class="btn btn-outline-success">Update</button>
          </div>
      </form>
  </div>
</div>

</body>
</html>

<?php 
} else {
    header("Location: /index.php");
    exit();
}
?>
