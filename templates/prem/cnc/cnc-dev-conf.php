<?php 
require dirname(__DIR__) . '../../../includes/db_connect.php';

$machineId = $_GET['id_machine'];

// Define the query with JOINs to get the required data
$query = " SELECT 
            ci.id_cnc, 
            ci.created_dt, 
            u.fullname, 
            u.department, 
            ci.problemtype, 
            ci.priority, 
            ci.subject, 
            ci.solution, 
            ci.state
            -- u2.fullname as servedby 
        FROM cnc_inter ci 
        JOIN user u ON ci.mat = u.mat 
        -- JOIN user u2 ON ci.servedby = u2.mat 
        WHERE ci.id_machine = ?
        ";

if ($stmt = $conn->prepare($query)) {
    $stmt->bind_param("i", $machineId);
    $stmt->execute();
    $result = $stmt->get_result();
    $interdemandeData = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
} else {
    echo "Error: " . $conn->error;
}

mysqli_close($conn);
?>