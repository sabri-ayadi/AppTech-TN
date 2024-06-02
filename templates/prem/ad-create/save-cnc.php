<?php
require dirname(__DIR__) . '/../../includes/db_connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mat = $_POST['mat'];
    $id_machine = $_POST['id_machine'];
    $problemtype = $_POST['problemtype'];
    $priority = $_POST['priority'];
    $subject = $_POST['subject'];
    $explication = $_POST['explication'];
    $state = "En attente";
    $servedby = $_SESSION['mat'];
    $currentDT = date("Y-m-d H:i:s");

    $sql = "INSERT INTO cnc_inter (mat, id_machine, problemtype, priority, subject, explication, state, servedby, created_dt) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisssssis", $mat, $id_machine, $problemtype, $priority, $subject, $explication, $state, $servedby, $currentDT);

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
