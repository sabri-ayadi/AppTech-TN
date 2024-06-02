<?php
require dirname(__DIR__) . '/../../includes/db_connect.php';



// Check if form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $user_mat = $_POST['mat'];
    $device_id = $_POST['id_dev'];

    // Prepare and execute SQL query to insert data into user_access table
    $sql = "INSERT INTO user_access (user_mat, device_id, date) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_mat, $device_id);

    // Execute the statement
    if ($stmt->execute()) {
        // If insertion is successful, send success response
        echo json_encode(["success" => true]);
    } else {
        // If insertion fails, check for foreign key constraint error
        if (mysqli_errno($conn) == 1452) { // Error code for foreign key constraint failure
            echo json_encode(["error" => "User mat or device id is incorrect"]);
        } else {
            // If other error occurs, send generic error response
            echo json_encode(["error" => "Error inserting data into user_access table: " . $conn->error]);
        }
    }

    // Close statement
    $stmt->close();
} else {
    // If form submission method is not POST, send a 405 Method Not Allowed response
    http_response_code(405);
}

// Close connection
mysqli_close($conn);

?>
