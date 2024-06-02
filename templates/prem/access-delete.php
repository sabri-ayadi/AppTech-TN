<?php
require dirname(__DIR__) . '../../includes/db_connect.php';

if(isset($_GET['iduser_access'])) {
    $accessId = $_GET['iduser_access'];

    // Prepare the SQL query to delete the Access
    $sql = "DELETE FROM user_access WHERE iduser_access = ?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the Access ID parameter
    mysqli_stmt_bind_param($stmt, "i", $accessId);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        // Deletion successful, redirect to the user Access Tab page
        header("Location: access-tab.php?success=Access+deleted+successfully.");
        // header("Location: access-tab.php");
        exit();
    } else {
        // Deletion failed, display an error message
        $error_message = "Error deleting this Access: " . mysqli_error($conn);
        header("Location: access-tab.php?error=" . urlencode($error_message));
        exit();
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // Access ID not provided, display an error message
    $error_message = "Access ID not provided for deletion.";
    header("Location: access-tab.php?error=" . urlencode($error_message));
    exit();
}

// Close the database connection
mysqli_close($conn);
?>