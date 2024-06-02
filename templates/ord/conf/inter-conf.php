<?php
require dirname(__DIR__) . '/../../includes/db_connect.php';

session_start();

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Taking values from the form data (matched by name value)
    $problemtype =  $_POST['problemtype'];
    $id_dev = $_POST['id_dev'];
    $priority =  $_POST['priority'];
    $subject = $_POST['subject'];
    $explication = $_POST['explication'];

    $mat = $_SESSION['mat'];
    $state = "En attente";
    $currentDT = date("Y-m-d H:i:s");
    $type = "Intervention";

// Handle file upload
if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['image']['tmp_name']; // Temporary location of the uploaded file
    $img_name = $_FILES['image']['name']; // Original name of the uploaded file
    // Read the file content
    $img_data = file_get_contents($file);

    // Prepare the INSERT statement with image
    $stmt = $conn->prepare("INSERT INTO interdemande (mat, problemtype, id_dev, priority, subject, explication, state, type, created_dt, img_name, img_data) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Check for errors in preparing the statement
    if (!$stmt) {
        echo "Error: " . $conn->error;
        exit(); // Stop execution if there's an error
    }

    // Bind the parameters to the statement
    $stmt->bind_param("sssssssssss", $mat, $problemtype, $id_dev, $priority, $subject, $explication, $state, $type, $currentDT, $img_name, $img_data);

} else {
    // Prepare the INSERT statement without image
    $stmt = $conn->prepare("INSERT INTO interdemande (mat, problemtype, id_dev, priority, subject, explication, state, type, created_dt) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Check for errors in preparing the statement
    if (!$stmt) {
        echo "Error: " . $conn->error;
        exit(); // Stop execution if there's an error
    }

    // Bind the parameters to the statement
    $stmt->bind_param("sssssssss", $mat, $problemtype, $id_dev, $priority, $subject, $explication, $state, $type, $currentDT);
}

// Execute the statement
$stmt->execute();

// Check for errors in execution
if ($stmt->errno) {
    $errorMessage = "Error: " . $stmt->error;
    header("Location: ../inter.php?error=" . urlencode($errorMessage));
    exit();
} else {
    $successMessage = "Data inserted successfully!";
    header("Location: ../inter.php?success=" . urlencode($successMessage));
    exit();
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
