<?php
session_start();
require dirname(__DIR__) . '/../../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $devID = $_POST['id_dev'];
    $nom = $_POST['nom'];
    $session = $_POST['session'];
    $username = $_POST['username'];
    $location = $_POST['location'];
    $dep = $_POST['dep'];
    $model = $_POST['model'];
    $cpu = $_POST['cpu'];
    $ram = $_POST['ram'];
    $storage = $_POST['storage'];
    $os = $_POST['os'];
    $domain = $_POST['domain'];
    $ip = $_POST['ip'];
    $mac = $_POST['mac'];
    $sn = $_POST['sn'];
    $ms_office = $_POST['ms_office'];
    $antivirus = $_POST['antivirus'];
    $state = $_POST['state'];

    $sql = "UPDATE device 
            SET nom = ?, session = ?, username = ?, location = ?, dep = ?, model = ?, cpu = ?, ram = ?, storage = ?, os = ?, ip = ?, mac = ?, sn = ?, domain = ?, ms_office = ?, antivirus = ?, state = ?
            WHERE id_dev = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssssssssssssssssi', $nom, $session, $username, $location, $dep, $model, $cpu, $ram, $storage, $os, $ip, $mac, $sn, $domain, $ms_office, $antivirus, $state, $devID);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success_message'] = "L'équipement a été modifié avec succès.";
    } else {
        $_SESSION['error_message'] = "Échec de modification.";
    }

    header("Location: ../dev-edit.php?id_dev=$devID");
    exit();
}

mysqli_close($conn);
?>
