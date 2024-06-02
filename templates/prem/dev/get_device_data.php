<?php
require dirname(__DIR__) . '/../../includes/db_connect.php';

if (isset($_GET['id_dev'])) {
    
    $id_dev = $_GET['id_dev'];

    $sql = "SELECT nom, dep, model FROM device WHERE id_dev = $id_dev";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo json_encode($row);
        } else {
            echo json_encode(["error" => "Device not found"]);
        }
    } else {
        echo json_encode(["error" => "Query error: " . mysqli_error($conn)]);
    }
} 

mysqli_close($conn);
?>
