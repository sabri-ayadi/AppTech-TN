<?php
session_start();
include_once dirname(__DIR__) . '/../../includes/db_connect.php';

if (isset($_POST['id_inter'])) {
    
    $id_inter = mysqli_real_escape_string($conn, $_POST['id_inter']);
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $explication = mysqli_real_escape_string($conn, $_POST['explication']);
    $solution = mysqli_real_escape_string($conn, $_POST['solution']);
    $maint = mysqli_real_escape_string($conn, $_POST['maint']);
    $currentDateTime = date('Y-m-d H:i:s');

    $sql = "UPDATE interdemande SET 
                subject = '$subject',
                explication = '$explication',
                solution = '$solution',
                maint = '$maint',
                state = 'Clôture',
                closed_dt = '$currentDateTime' 
            WHERE id_inter = '$id_inter'";

    if (mysqli_query($conn, $sql)) {
        echo "Intervention closed successfully!";
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
