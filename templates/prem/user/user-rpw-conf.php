<?php
// user-rpw-conf.php
session_start();
require dirname(__DIR__) . '/../../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['id'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        $_SESSION['error_message'] = "Passwords do not match.";
        header("Location: ../user-edit.php?id=$userId");
        exit();
    }

    $hashedPassword = sha1($newPassword);
    $sql = "UPDATE user SET password = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'si', $hashedPassword, $userId);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success_message'] = "Password updated successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to update password.";
    }

    header("Location: ../user-edit.php?id=$userId");
    exit();
}

mysqli_close($conn);
?>
