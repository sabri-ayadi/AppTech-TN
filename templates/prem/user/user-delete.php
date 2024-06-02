<?php
require dirname(__DIR__) . '../../../includes/db_connect.php';

if(isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Prepare the SQL query to delete the user
    $sql = "DELETE FROM user WHERE id = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the user ID parameter
    mysqli_stmt_bind_param($stmt, "i", $userId);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        // Deletion successful, redirect to the user list page
        header("Location: ../user-lst.php");
        exit();
    } else {
        // Deletion failed, display an error message
        $error_message = "Error deleting the user: " . mysqli_error($conn);
        header("Location: ../user-lst.php?error=" . urlencode($error_message));
        exit();
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // User ID not provided, display an error message
    $error_message = "User ID not provided for deletion.";
    header("Location: ../user-lst.php?error=" . urlencode($error_message));
    exit();
}

// Close the database connection
mysqli_close($conn);