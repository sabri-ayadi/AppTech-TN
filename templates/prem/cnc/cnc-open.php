<?php
session_start();
include_once dirname(__DIR__) . '/../../includes/db_connect.php';

if (isset($_POST['id_cnc'])) {
    
    $id_cnc = mysqli_real_escape_string($conn, $_POST['id_cnc']);
    $servedby = isset($_SESSION['mat']) ? $_SESSION['mat'] : null;
    $currentDateTime = date('Y-m-d H:i:s');

    $sql = "UPDATE cnc_inter 
            SET state = 'En cours',
                servedby = '$servedby',
                opened_dt = '$currentDateTime' 
            WHERE id_cnc = '$id_cnc'";

    if (mysqli_query($conn, $sql)) {
        echo "CNC Intervention opened successfully!";
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
