<?php
session_start();
include_once dirname(__DIR__) . '/../../includes/db_connect.php';

if (isset($_POST['id_inter'])) {
    
    $id_inter = mysqli_real_escape_string($conn, $_POST['id_inter']);
    $servedby = isset($_SESSION['mat']) ? $_SESSION['mat'] : null;
    $currentDateTime = date('Y-m-d H:i:s');

    $sql = "UPDATE interdemande 
            SET state = 'En cours',
                servedby = '$servedby',
                opened_dt = '$currentDateTime' 
            WHERE id_inter = '$id_inter'";

    if (mysqli_query($conn, $sql)) {
        echo "Intervention opened successfully!";
    } else {
        http_response_code(500);
        echo "Error updating intervention details: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    http_response_code(400);
    echo "ID not provided.";
}
?>
