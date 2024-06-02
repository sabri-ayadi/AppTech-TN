<?php
session_start();
require dirname(__DIR__) . '/../../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    if (isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
        // get the old password from the database
        $sql = "SELECT password FROM user WHERE id = '$user_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $old_password_hash = $row['password'];

            // hash the old password input before comparing it to the password input
            $old_password_input_hash = sha1($old_password);

            // compare the hashed old password input to the hashed old password from the database
            if ($old_password_input_hash === $old_password_hash) {
                if ($new_password === $confirm_password) {
                    // hash the new password before storing it in the database
                    $new_password_hash = sha1($new_password);
                    $update_sql = "UPDATE user SET password = '$new_password_hash' WHERE id = '$user_id'";
                    
                    if ($conn->query($update_sql) === TRUE) {
                        $_SESSION['success_message'] = "Password updated successfully!";
                        header("location: ../profile.php");
                    } else {
                        $_SESSION['error_message'] = "Error updating password: " . $conn->error;
                        header("location: ../profile.php");
                    }
                } else {
                    $_SESSION['error_message'] = "New password and Confirm password do not match!";
                    header("location: ../profile.php");
                }
            } else {
                $_SESSION['error_message'] = "Incorrect old password!";
                header("location: ../profile.php");
            }
        } else {
            $_SESSION['error_message'] = "User not found!";
            header("location: ../profile.php");
        }
    } else {
        $_SESSION['error_message'] = "Session ID not set!";
        header("location: ../profile.php");
    }

    $conn->close();
}
?>
