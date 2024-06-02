<?php
include_once dirname(__DIR__) . '/../../includes/db_connect.php';

if (!isset($_GET['id_cnc'])) {
    echo "ID not provided.";
    exit;
}

$id_cnc = mysqli_real_escape_string($conn, $_GET['id_cnc']);

$sql = "SELECT 
            i.id_cnc, 
            i.created_dt, 
            i.opened_dt,
            i.closed_dt,
            u.mat, 
            u.fullname,
            u.department,
            u.tel,
            u.mail,
            i.problemtype,
            m.id_machine,
            m.name AS name_machine,
            m.model AS model_machine,
            m.ip_1 AS ip_machine,
            i.priority, 
            i.subject,
            i.explication,
            i.solution,
            i.state,
            i.img_data
        FROM 
            cnc_inter i
        JOIN 
            user u ON i.mat = u.mat
        JOIN 
            machine m ON i.id_machine = m.id_machine
        WHERE 
            i.id_cnc = '$id_cnc'
        ORDER BY 
            i.id_cnc DESC";

$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "No intervention found with ID: $id_cnc";
    exit;
}

$state = $row['state'];
$isClosed = $state === 'Clôture';
$imgData = $row['img_data'];

mysqli_close($conn);
?>
