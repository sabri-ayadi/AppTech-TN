<?php
require dirname(__DIR__) . '/../../includes/db_connect.php';

$response = ["error" => "Device not found"];

if (isset($_GET['id_dev'])) {
    $deviceId = $_GET['id_dev'];
    $sql = "SELECT nom, type, dep, model, ip FROM device WHERE id_dev = $deviceId";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $response = $row;
        }
    } else {
        $response = ["error" => "Query error: " . mysqli_error($conn)];
    }
}

echo json_encode($response);

mysqli_close($conn);
