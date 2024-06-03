<?php 
require dirname(__DIR__) . '../../../includes/db_connect.php';

$devId = $_GET['id_dev'];

// SQL query to fetch device details
$sqlDevice = "SELECT 
            nom AS device_nom,
            model AS device_model
            FROM device WHERE id_dev = ?";
$stmtDevice = mysqli_prepare($conn, $sqlDevice);
if (!$stmtDevice) {
    die('mysqli_prepare failed: ' . mysqli_error($conn));
}
mysqli_stmt_bind_param($stmtDevice, 'i', $devId);
mysqli_stmt_execute($stmtDevice);
$resultDevice = mysqli_stmt_get_result($stmtDevice);
$deviceInfo = mysqli_fetch_assoc($resultDevice);

// Initialize deviceInfo with defaults if no device info is found
if (!$deviceInfo) {
    $deviceInfo = [
        'device_nom' => 'Unknown Device',
        'device_model' => 'Unknown Model',
    ];
}

// SQL query to fetch historical data
$sql = "SELECT
            i.id_inter,
            i.created_dt,
            u.fullname,
            u.department,
            i.problemtype,
            i.priority,
            i.subject,
            i.solution,
            i.state
        FROM interdemande i
        JOIN user u ON i.mat = u.mat
        WHERE i.id_dev = ?";
$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    die('mysqli_prepare failed: ' . mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt, 'i', $devId);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$interdemandeData = [];
while ($row = mysqli_fetch_assoc($result)) {
    $interdemandeData[] = $row;
}

mysqli_close($conn);
?>
