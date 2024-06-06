<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) {
    require dirname(__DIR__) . '../../includes/db_connect.php';
    
    $userId = $_GET['id'];
    
    $sql = "SELECT * FROM user WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    
    if (!$user) {
        $_SESSION['error_message'] = "User not found.";
        header("Location: user-lst.php");
        exit();
    }
    
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/user/usr_edit.css">
</head>
<body>

<?php include "navbar-ad.php"; ?>

<div class="container">
    <div class="custom-container">
        <h2>Edit User</h2>
        
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
        

        <form method="POST" action="user/user-edit-pro-conf.php">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

            <div class="form-group">
                <label for="mat">Matriculation Number:</label>
                <input type="text" id="mat" name="mat" value="<?php echo $user['mat']; ?>" readonly><br>
            </div>

            <div class="form-group">
                <label for="fullname">Full Name:</label>
                <input type="text" id="fullname" name="fullname" value="<?php echo $user['fullname']; ?>" required><br>
            </div>

            <div class="form-group">
                <label for="department">Department:</label>
                <select id="department" name="department" class="form-control" required>
                    <option value="Production" <?php if ($user['department'] == 'Production') echo 'selected'; ?>>Production</option>
                    <option value="Quality" <?php if ($user['department'] == 'Quality') echo 'selected'; ?>>Quality</option>
                    <option value="Logistique" <?php if ($user['department'] == 'Logistique') echo 'selected'; ?>>Logistique</option>
                    <option value="Administration" <?php if ($user['department'] == 'Administration') echo 'selected'; ?>>Administration</option>
                    <option value="Achat" <?php if ($user['department'] == 'Achat') echo 'selected'; ?>>Achat</option>
                    <option value="Maintenance" <?php if ($user['department'] == 'Maintenance') echo 'selected'; ?>>Maintenance</option>
                    <option value="ICT" <?php if ($user['department'] == 'ICT') echo 'selected'; ?>>ICT</option>
                    <option value="RH" <?php if ($user['department'] == 'RH') echo 'selected'; ?>>RH</option>
                    <option value="Autre" <?php if ($user['department'] == 'Autre') echo 'selected'; ?>>Autre</option>
                </select>
            </div>

            <div class="form-group">
                <label for="job">Function:</label>
                <input type="text" id="job" name="job" value="<?php echo $user['job']; ?>" required><br>
            </div>

            <div class="form-group">
                <label for="type">Type:</label>
                <select id="type" name="type" class="form-control" required>
                    <option value="1" <?php if ($user['type'] == 1) echo 'selected'; ?>>Admin</option>
                    <option value="2" <?php if ($user['type'] == 2) echo 'selected'; ?>>User</option>
                    <option value="3" <?php if ($user['type'] == 3) echo 'selected'; ?>>L3</option>
                </select>
            </div>

            <div class="form-group">
                <label for="mail">Email:</label>
                <input type="email" id="mail" name="mail" value="<?php echo $user['mail']; ?>" required><br>
            </div>

            <div class="form-group">
                <label for="tel">Phone Number:</label>
                <input type="text" id="tel" name="tel" minlength="8" maxlength="8" value="<?php echo $user['tel']; ?>" required><br>
            </div>

            <div class="divbtn">
                <a href="user-lst.php" class="btn btn-outline-secondary">Retour</a>
                <button type="submit" class="btn btn-outline-success">Update</button>
            </div>
        </form>

    </div>
</div>

<div class="container">
    <div class="custom-container">
    <h4>Change Password:</h4>
        <form method="POST" action="user/user-rpw-conf.php">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" minlength="8" maxlength="16" required><br>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" minlength="8" maxlength="16" required><br>
            </div>

            <div class="divbtn">
                <a href="user-lst.php" class="btn btn-outline-secondary">Retour</a>
                <button type="submit" class="btn btn-outline-success">Update Password</button>

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
