<?php
session_start();
require dirname(__DIR__) . '/../../includes/db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_machine = $_POST['id_machine'];
    $name = $_POST['name'];
    $model = $_POST['model'];
    $type = $_POST['type'];
    $s_n = $_POST['s_n'];
    $ip_1 = $_POST['ip_1'];
    $ip_cam_r = $_POST['ip_cam_r'];
    $ip_cam_l = $_POST['ip_cam_l'];
    $comment = $_POST['comment'];

    $sql = "UPDATE machine 
            SET name = ?, model = ?, type = ?, s_n = ?, ip_1 = ?, ip_cam_r = ?, ip_cam_l = ?, comment = ?
            WHERE id_machine = ?";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameters (including id_machine at the end)
    mysqli_stmt_bind_param($stmt, 'ssssssssi', $name, $model, $type, $s_n, $ip_1, $ip_cam_r, $ip_cam_l, $comment, $id_machine);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success_message'] = "Les informations de la machine ont été modifiées avec succès";
    } else {
        $_SESSION['error_message'] = "Échec de modification";
    }

    // Redirect to the edit page with the machine ID
    header("Location: ../cnc-dev-edit.php?id_machine=$id_machine");
    exit();
}

mysqli_close($conn);
