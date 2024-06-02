<?php
// Include your database connection file
include_once dirname(__DIR__) . '/../includes/db_connect.php';

// Check if id_inter parameter is set
if (isset($_GET['id_inter'])) {
    $id_inter = mysqli_real_escape_string($conn, $_GET['id_inter']);

    // Query to fetch additional details based on id_inter
    $query = "SELECT *
         FROM interdemande AS i
         JOIN user AS u ON i.mat = u.mat
         WHERE id_inter = '$id_inter'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    // Output data as JSON, including the image data
    echo json_encode($row);
} else {
    // No data found for the provided id_inter
    echo json_encode(array('error' => 'No data found.'));
}

} 
// else {
//     // id_inter parameter not set
//     echo json_encode(array('error' => 'ID not provided.'));
// }

// Close database connection
// mysqli_close($conn);
?>
