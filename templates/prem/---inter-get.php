<?php
session_start();

include_once dirname(__DIR__) . '../../includes/db_connect.php';

if (isset($_POST['id_inter'])) {
    $id_inter = mysqli_real_escape_string($conn, $_POST['id_inter']);
    
    // Assuming you have a user mat stored in the session
    $servedby = isset($_SESSION['mat']) ? $_SESSION['mat'] : null;

    // Update query
    $sql = "UPDATE interdemande 
            SET state = 'Traitement', servedby = '$servedby' 
            WHERE id_inter = '$id_inter'";
    
    if (mysqli_query($conn, $sql)) {
        echo "Intervention details updated successfully!";
    } else {
        echo "Error updating intervention details: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "ID not provided.";
}
?>
