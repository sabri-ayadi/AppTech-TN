<?php
// user-edit-pro-conf.php
session_start();
require dirname(__DIR__) . '/../../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['id'];
    $fullname = $_POST['fullname'];
    $department = $_POST['department'];
    $job = $_POST['job'];
    $type = $_POST['type'];
    $mail = $_POST['mail'];
    $tel = $_POST['tel'];

    $sql = "UPDATE user SET fullname = ?, department = ?, job = ?, type = ?, mail = ?, tel = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssssi', $fullname, $department, $job, $type, $mail, $tel, $userId);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success_message'] = "User updated successfully.";
    } else {
        $_SESSION['error_message'] = "Failed to update user.";
    }

    header("Location: ../user-edit.php?id=$userId");
    exit();
}

mysqli_close($conn);
?>
