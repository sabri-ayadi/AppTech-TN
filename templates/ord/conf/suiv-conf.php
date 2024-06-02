<?php

require dirname(__DIR__) . '/../../includes/db_connect.php'; // Include the file that establishes the database connection

// Check if user is logged in and retrieve matricule
if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 2) {
    
    // Retrieve matricule of the logged-in user
    $userId = $_SESSION['mat']; 

   
        $query = "SELECT i.*, d.nom 
                    FROM interdemande i
                    JOIN device d ON i.id_dev = d.id_dev
                    WHERE mat = $userId
                    ORDER BY id_inter DESC";

        $result = mysqli_query($conn, $query);
        $rowCount = mysqli_num_rows($result); //function to check if there are any rows in the result set.
        

} else {
    header("Location: /index.php"); // Redirect to index.php if user is not logged in or has the wrong type
    exit();
}


?>

