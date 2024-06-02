<?php
require dirname(__DIR__) . '/../../includes/db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mat = $_POST['mat'];
    $id_dev = $_POST['id_dev'];
    $problemtype = $_POST['problemtype'];
    $priority = $_POST['priority'];
    $subject = $_POST['subject'];
    $explication = $_POST['explication'];
    $state = "En attente";
    $servedby = $_SESSION['mat'];
    $type = "Intervention";
    $created_dt = date('Y-m-d H:i:s');

    $sql = "INSERT INTO interdemande (mat, id_dev, problemtype, priority, subject, explication, state, servedby, type, created_dt) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissssssss", $mat, $id_dev, $problemtype, $priority, $subject, $explication, $state, $servedby, $type, $created_dt);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["error" => "Error: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid request method"]);
}

mysqli_close($conn);
?>
