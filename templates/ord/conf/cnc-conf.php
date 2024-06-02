<?php
require dirname(__DIR__) . '/../../includes/db_connect.php';

session_start();

if (isset($_SESSION['mat'])) {
    // Taking values from the form data (matched by name value)
    $mat = $_SESSION['mat'];
    $id_machine = $_POST['id_machine'];
    $problemtype = $_POST['problemtype'];
    $priority = $_POST['priority'];
    $subject = $_POST['subject'];
    $explication = $_POST['explication'];
    $state = "En attente";
    $created = date("Y-m-d H:i:s");
    $h_created = date("H:i:s");

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['image']['tmp_name']; // Temporary location of the uploaded file
        $img_name = $_FILES['image']['name']; // Original name of the uploaded file
        // Read the file content
        $img_data = file_get_contents($file);

        // Prepare the INSERT statement with image
        $stmt = $conn->prepare("INSERT INTO cnc_inter (mat, id_machine, problemtype, priority, subject, explication, img_name, img_data, state, created, h_created)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Check for errors in preparing the statement
        if (!$stmt) {
            $errorMessage = "Error preparing statement: " . $conn->error;
            header("Location: ../cnc.php?error=" . urlencode($errorMessage));
            exit();
        }

        // Bind the parameters to the statement
        $stmt->bind_param("sssssssssss", $mat, $id_machine, $problemtype, $priority, $subject, $explication, $img_name, $img_data, $state, $created, $h_created);

    } else {
        // Prepare the INSERT statement without image
        $stmt = $conn->prepare("INSERT INTO cnc_inter (mat, id_machine, problemtype, priority, subject, explication, state, created, h_created) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Check for errors in preparing the statement
        if (!$stmt) {
            $errorMessage = "Error preparing statement: " . $conn->error;
            header("Location: ../cnc.php?error=" . urlencode($errorMessage));
            exit();
        }

        // Bind the parameters to the statement
        $stmt->bind_param("sssssssss", $mat, $id_machine, $problemtype, $priority, $subject, $explication, $state, $created, $h_created);
    }

    // Execute the statement
    $stmt->execute();

    // Check for errors in execution
    if ($stmt->errno) {
        $errorMessage = "Error executing statement: " . $stmt->error;
        header("Location: ../cnc.php?error=" . urlencode($errorMessage));
        exit();
    } else {
        $successMessage = "Data inserted successfully!";
        header("Location: ../cnc.php?success=" . urlencode($successMessage));
        exit();
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Handle unauthorized access or session expiration
    header("Location: /index.php");
    exit();
}
?>
