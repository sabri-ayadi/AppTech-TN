<?php

require dirname(__DIR__) . '/../../includes/db_connect.php'; // Include the file that establishes the database connection

// Check if user is logged in and retrieve matricule
if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 2) {
    
    // Retrieve matricule of the logged-in user
    $userId = $_SESSION['id']; 

   
        $query = "SELECT * FROM user WHERE id = $userId";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $fullname = $row['fullname'];
            $department = $row['department'];
            $job = $row['job'];
            $mat = $row['mat'];
            $mail = $row['mail'];
            $tel = $row['tel'];
        }
 

} else {
    header("Location: /index.php"); // Redirect to index.php if user is not logged in or has the wrong type
    exit();
}
