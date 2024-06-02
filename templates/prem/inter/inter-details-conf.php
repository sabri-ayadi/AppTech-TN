<?php
include_once dirname(__DIR__) . '/../../includes/db_connect.php';

if (!isset($_GET['id_inter'])) {
    echo "ID not provided.";
    exit;
}

$id_inter = mysqli_real_escape_string($conn, $_GET['id_inter']);

    $sql = "SELECT 
                i.*, 
                u.fullname, 
                u.mail, 
                u.tel,
                u.department,
                d.nom AS device_nom,
                d.type AS device_type,
                d.dep,
                d.model,
                d.ip
            FROM 
                interdemande AS i
            JOIN 
                user AS u ON i.mat = u.mat
            JOIN 
                device AS d ON i.id_dev = d.id_dev
            WHERE 
                i.id_inter = '$id_inter'";

$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "No intervention found with ID: $id_inter";
    exit;
}

$state = $row['state'];
$isClosed = $state === 'Clôture';
$imgData = $row['img_data'];

mysqli_close($conn);

