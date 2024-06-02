<?php
require dirname(__DIR__) . '/../../includes/db_connect.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Ensure session variable is set
    if (!isset($_SESSION['mat'])) {
        $errorMessage = "User session not found.";
        header("Location: ../demande.php?error=" . urlencode($errorMessage));
        exit();
    }

    // Retrieve form data
    $problemtype = $_POST["problemtype"];
    $id_dev = $_POST["id_dev"];
    $priority = $_POST["priority"];
    $subject = $_POST["subject"];
    $explication = $_POST['explication'];

    $mat = $_SESSION['mat'];
    $state = "En attente";
    $type = "Demande";
    
    $currentDT = date("Y-m-d H:i:s");


    // Prepare the INSERT statement
    $stmt = $conn->prepare("INSERT INTO interdemande (mat, problemtype, id_dev, priority, subject, explication, state, type, created_dt) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Check for errors in preparing the statement
    if (!$stmt) {
        $errorMessage = "Error preparing statement: " . $conn->error;
        header("Location: ../demande.php?error=" . urlencode($errorMessage));
        exit();
    }

    // Bind the parameters to the statement
    $stmt->bind_param("sssssssss", $mat, $problemtype, $id_dev, $priority, $subject, $explication, $state, $type, $currentDT);

    // Execute the statement
    $stmt->execute();

    // Check for errors in execution
    if ($stmt->errno) {
        $errorMessage = "Error executing statement: " . $stmt->error;
        header("Location: ../demande.php?error=" . urlencode($errorMessage));
        exit();
    } else {
        $successMessage = "Data inserted successfully!";
        header("Location: ../demande.php?success=" . urlencode($successMessage));
        exit();
    }

    // Close the statement
    $stmt->close();
    
    // Close the connection
    $conn->close();
}

?>


