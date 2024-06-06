<?php
require dirname(__DIR__) . '/../../includes/db_connect.php';

// Set the content type to JSON
header('Content-Type: application/json');

// Initialize data array
$data = ['interventions' => [], 'demands' => []];

// Check if the connection was successful
if ($conn->connect_error) {
    $data = ["error" => "Connection failed: " . $conn->connect_error];
    echo json_encode($data);
    exit();
}

// Query to get the count of interventions per month
$sqlInterventions = "SELECT MONTHNAME(created_dt) as month, COUNT(*) as count
                     FROM interdemande
                     WHERE type = 'intervention'
                     GROUP BY YEAR(created_dt), MONTH(created_dt)
                     ORDER BY YEAR(created_dt), MONTH(created_dt)";
$resultInterventions = $conn->query($sqlInterventions);

// Check if the query for interventions was successful
if ($resultInterventions === FALSE) {
    $data = ["error" => "Query for interventions failed: " . $conn->error];
    echo json_encode($data);
    exit();
}

// Fetch interventions data
while ($row = $resultInterventions->fetch_assoc()) {
    $data['interventions'][] = $row;
}

// Query to get the count of demands per month
$sqlDemands = "SELECT MONTHNAME(created_dt) as month, COUNT(*) as count
               FROM interdemande
               WHERE type = 'demande'
               GROUP BY YEAR(created_dt), MONTH(created_dt)
               ORDER BY YEAR(created_dt), MONTH(created_dt)";
$resultDemands = $conn->query($sqlDemands);

// Check if the query for demands was successful
if ($resultDemands === FALSE) {
    $data = ["error" => "Query for demands failed: " . $conn->error];
    echo json_encode($data);
    exit();
}

// Fetch demands data
while ($row = $resultDemands->fetch_assoc()) {
    $data['demands'][] = $row;
}

// Close the connection
$conn->close();

// Encode data in JSON format
echo json_encode($data);
