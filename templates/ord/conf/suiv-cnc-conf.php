<?php

require dirname(__DIR__) . '/../../includes/db_connect.php'; // Include the file that establishes the database connection

// Check if user is logged in and retrieve matricule
if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 2) {
    
    // Retrieve matricule of the logged-in user
    $userMat = $_SESSION['mat']; 

    // Updated query to join the user table and filter by logged-in user's matricule
    $query = "SELECT 
                    c.id_cnc AS id_inter, 
                    c.created_dt, 
                    m.name, 
                    m.model, 
                    c.problemtype, 
                    c.priority, 
                    c.subject, 
                    c.state,
                    u.fullname
                FROM 
                    cnc_inter c
                JOIN 
                    machine m ON c.id_machine = m.id_machine
                JOIN 
                    user u ON c.mat = u.mat
                WHERE 
                    u.mat = '$userMat'
                ORDER BY 
                    c.id_cnc DESC";

    $result = mysqli_query($conn, $query);
    $rowCount = mysqli_num_rows($result); //function to check if there are any rows in the result set.

} else {
    header("Location: /index.php"); // Redirect to index.php if user is not logged in or has the wrong type
    exit();
}

?>