<?php
require dirname(__DIR__) . '/../../includes/db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mat = $_POST["mat"];
    $fullname = $_POST["fullname"];
    $password = sha1($_POST["password"]);

    // Check if the "department" and "type" fields are set
    if (isset($_POST["department"]) && isset($_POST["type"])) {
        $department = $_POST["department"];
        $type = $_POST["type"];
    } else {
        // If either "department" or "type" is missing, return a JSON response with an error message
        http_response_code(400); // Set the HTTP status code to 400 (Bad Request)
        echo json_encode(["error" => "Both 'Department' and 'Type' fields are required."]);
        exit();
    }

    $job = $_POST["job"];
    $tel = $_POST["tel"];
    $mail = $_POST["mail"];

    // Prepare the SQL query
    $sql = "INSERT INTO user (mat, fullname, password, department, job, type, tel, mail)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Execute the query
    try {
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "isssssis", $mat, $fullname, $password, $department, $job, $type, $tel, $mail);
            if (mysqli_stmt_execute($stmt)) {
                // Return a JSON response with a success message
                echo json_encode(["success" => true]);
                exit();
            } else {
                // Return a JSON response with an error message
                http_response_code(500); // Set the HTTP status code to 500 (Internal Server Error)
                echo json_encode(["error" => mysqli_error($conn)]);
                exit();
            }
        } else {
            // Return a JSON response with an error message
            http_response_code(500); // Set the HTTP status code to 500 (Internal Server Error)
            echo json_encode(["error" => "Failed to prepare the SQL statement."]);
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        // Check if the error is a duplicate entry error
        if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
            // Return a JSON response with the specific error message
            http_response_code(400); // Set the HTTP status code to 400 (Bad Request)
            echo json_encode(["error" => $e->getMessage()]);
            exit();
        } else {
            // Return a generic error message
            http_response_code(500); // Set the HTTP status code to 500 (Internal Server Error)
            echo json_encode(["error" => "Something went wrong. Please try again later."]);
            exit();
        }
    }
}

// Close the database connection
mysqli_close($conn);
