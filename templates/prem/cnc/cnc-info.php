<?php
require dirname(__DIR__) . '/../../includes/db_connect.php';

if (isset($_GET['id_machine'])) {
    $id_machine = intval($_GET['id_machine']);

    $stmt = $conn->prepare("SELECT * FROM machine WHERE id_machine = ?");
    $stmt->bind_param("i", $id_machine);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $machine = $result->fetch_assoc();
        echo json_encode($machine);
    } else {
        echo json_encode(['error' => 'Machine not found']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'Invalid request']);
}

mysqli_close($conn);
?>
