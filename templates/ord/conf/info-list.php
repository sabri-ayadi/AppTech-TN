<?php
require dirname(__DIR__) . '/../../includes/db_connect.php';

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 2) {
    // Retrieve matricule of the logged-in user
    $logged_in_user_mat = $_SESSION['mat']; 

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT tel, mail FROM user WHERE mat = ?");
    $stmt->bind_param("i", $logged_in_user_mat);
    $stmt->execute();
    $stmt->bind_result($tel, $mail);
    $stmt->fetch();

    // Close the statement
    $stmt->close();
}
?>