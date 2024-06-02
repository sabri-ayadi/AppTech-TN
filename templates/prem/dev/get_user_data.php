<?php
require dirname(__DIR__) . '/../../includes/db_connect.php';

if (isset($_GET['mat'])) {
    
    $matricul = $_GET['mat'];

    $sql = "SELECT fullname, department, type FROM user WHERE mat = $matricul";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo json_encode($row);
        } else {
            echo json_encode(["error" => "User not found"]);
        }
    } else {
        echo json_encode(["error" => "Query error: " . mysqli_error($conn)]);
    }
    
} 

mysqli_close($conn);
?>
