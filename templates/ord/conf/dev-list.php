<?php

require dirname(__DIR__) . '/../../includes/db_connect.php'; // get the absolute path of the db connection file

    // Check if user is logged in and retrieve matricule
    if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 2) {
    
    // Retrieve matricule of the logged-in user
    $logged_in_user_mat = $_SESSION['mat']; 

// Prepare and execute the SQL query
$stmt = $conn->prepare("SELECT d.id_dev AS dev_id,
                        d.nom AS dev_nom, 
                        d.model AS dev_model 
                        FROM `user` u
                        JOIN `user_access` ua ON u.mat = ua.user_mat
                        JOIN `device` d ON ua.device_id = d.id_dev
                        WHERE u.mat = ?");
                        
$stmt->bind_param("s", $logged_in_user_mat); // $logged_in_user_mat contains the matricule of the logged-in user
$stmt->execute();

// Get the result set
$result = $stmt->get_result();

// Store the result in an array
$rows = array();
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

// Close the statement
$stmt->close();

}

?>
