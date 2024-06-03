<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) {
    require dirname(__DIR__) . '../../includes/db_connect.php';
    
    $devId = $_GET['id_dev'];
    
    $sql = "SELECT * FROM device WHERE id_dev = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $devId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $dev = mysqli_fetch_assoc($result);
    
    if (!$dev) {
        $_SESSION['error_message'] = "Device not found.";
        header("Location: dev-lst.php");
        exit();
    }
    
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Device</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/dev/dev-edit.css">
</head>
<body>

<?php include "navbar-ad.php"; ?>

<div class="container">
    <div class="custom-container">
        <h2><font color="green">Modifier Equipement N° : </font><?php echo $dev['id_dev']; ?></h2> </br>
        
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
        

        <form method="POST" action="dev/dev-edit-conf.php">
            <input type="hidden" name="id_dev" value="<?php echo $dev['id_dev']; ?>">

            <div class="row">
                <div class="col">                    
                    <label for="type">Type:</label>
                    <input type="text" id="type" name="type" value="<?php echo $dev['type']; ?>" readonly><br>
                </div>
                <div class="col">
                    <label for="nom">Name PC: *</label>
                    <input type="text" name="nom" id="nom" value="<?php echo $dev['nom']; ?>" required>
                </div>
                <div class="col">
                    <label for="session">Session: *</label>
                    <input type="text" name="session" id="session" value="<?php echo $dev['session']; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label for="username">Username: *</label>
                    <input type="text" name="username" id="username" value="<?php echo $dev['username']; ?>" required>
                </div>

                <div class="col">
                    <label for="location">Location: *</label>
                    <select name="location" id="location">
                    <option value="Mitech 1" <?php if ($dev['location'] == 'Mitech 1') echo 'selected'; ?>>Mitech 1</option>
                    <option value="Mitech 2" <?php if ($dev['location'] == 'Mitech 2') echo 'selected'; ?>>Mitech 2</option>
                    <option value="Mitech 3" <?php if ($dev['location'] == 'Mitech 3') echo 'selected'; ?>>Mitech 3</option>
                    </select>
                </div>
            </div>

            <div class="row">
            <div class="col">
                <label for="dep">Department :</label>
                <select id="dep" name="dep">
                    <option value="Production" <?php if ($dev['dep'] == 'Production') echo 'selected'; ?>>Production</option>
                    <option value="Quality" <?php if ($dev['dep'] == 'Quality') echo 'selected'; ?>>Quality</option>
                    <option value="Logistique" <?php if ($dev['dep'] == 'Logistique') echo 'selected'; ?>>Logistique</option>
                    <option value="Administration" <?php if ($dev['dep'] == 'Administration') echo 'selected'; ?>>Administration</option>
                    <option value="Achat" <?php if ($dev['dep'] == 'Achat') echo 'selected'; ?>>Achat</option>
                    <option value="Maintenance" <?php if ($dev['dep'] == 'Maintenance') echo 'selected'; ?>>Maintenance</option>
                    <option value="ICT" <?php if ($dev['dep'] == 'ICT') echo 'selected'; ?>>ICT</option>
                    <option value="RH" <?php if ($dev['dep'] == 'RH') echo 'selected'; ?>>RH</option>
                    <option value="Autre" <?php if ($dev['dep'] == 'Autre') echo 'selected'; ?>>Autre</option>
                </select>
            </div>

            <div class="col">
                <label for="model">Model: *</label>
                <input type="text" name="model" id="model" value="<?php echo $dev['model']; ?>" placeholder="Lenovo" required>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="cpu">CPU: *</label>
                <input type="text" name="cpu" id="cpu" value="<?php echo $dev['cpu']; ?>" placeholder="i7" required>
            </div>

            <div class="col">
                <label for="ram">RAM: *</label>
                <input type="text" name="ram" id="ram" value="<?php echo $dev['ram']; ?>" placeholder="8GB" required>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="storage">Storage: *</label>
                <input type="text" name="storage" id="storage" value="<?php echo $dev['storage']; ?>" placeholder="256GB SSD/HDD" required>
            </div>

            <div class="col">
                <label for="os">OS: *</label>
                <input type="text" name="os" id="os" value="<?php echo $dev['os']; ?>" value="Windows --" required>
            </div>
            <div class="col">
                <label for="domain">Domain: *</label>
                <input type="text" name="domain" id="domain" value="<?php echo $dev['domain']; ?>" value="mitechtn.lan" required readonly>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="ip">IP:</label>
                <input type="text" name="ip" id="ip" value="<?php echo $dev['ip']; ?>" value="192.168.7. --">
            </div>
            <div class="col">
                <label for="mac">MAC:</label>
                <input type="text" name="mac" id="mac" value="<?php echo $dev['mac']; ?>" placeholder="00:00:00:00:00:00">
            </div>
            <div class="col">
                <label for="sn">Serial Number:</label>
                <input type="text" name="sn" id="sn" value="<?php echo $dev['sn']; ?>" placeholder="S/N">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label for="ms_office">MS Office:</label>
                <input type="text" name="ms_office" id="ms_office" value="<?php echo $dev['ms_office']; ?>" placeholder="MS Office 365">
            </div>
            <div class="col">
                <label for="antivirus">Antivirus :</label>
                <select id="antivirus" name="antivirus">
                    <option value="Yes" <?php if ($dev['antivirus'] == 'Yes') echo 'selected'; ?>>Yes</option>
                    <option value="No" <?php if ($dev['antivirus'] == 'No') echo 'selected'; ?>>No</option>
                    <option value="N/A" <?php if ($dev['antivirus'] == 'N/A') echo 'selected'; ?>>N/A</option>
                </select>
            </div>
            <div class="col">
                <label for="state">State :</label>
                <select id="state" name="state">
                    <option value="Up" <?php if ($dev['state'] == 'Up') echo 'selected'; ?>>Up</option>
                    <option value="Down" <?php if ($dev['state'] == 'Down') echo 'selected'; ?>>Down</option>
                </select>
            </div>
            
        </div>
        <br>

            <div class="divbtn">
                <a href="dev-lst.php" class="btn btn-outline-secondary">Retour</a>
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
