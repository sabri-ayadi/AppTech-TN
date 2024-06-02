<?php
session_start();
require dirname(__DIR__) . '/../../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = $_POST['mail'];
    $tel = $_POST['tel'];

    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];

        $update_sql = "UPDATE user 
                        SET mail = '$mail', tel = '$tel' 
                        WHERE id = '$user_id'";

        if ($conn->query($update_sql) === TRUE) {
            $_SESSION['success_message_pro'] = "Profile updated successfully!";
            header("location: ../profile.php");
        } else {
            $_SESSION['error_message_pro'] = "Error updating profile: " . $conn->error;
            header("location: ../profile.php");
        }
    } else {
        $_SESSION['error_message_pro'] = "Session ID not set!";
        header("location: ../profile.php");
    }

    $conn->close();
}
?>
