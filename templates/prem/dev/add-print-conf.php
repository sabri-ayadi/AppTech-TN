<?php
require dirname(__DIR__) . '../../../includes/db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST["type"];
    $nom = $_POST["nom"];
    $session = "n/a";
    $username = "n/a";
    $location = $_POST["location"];
    $dep = $_POST["dep"];
    $model = $_POST["model"];
    $cpu = "n/a";
    $ram = "n/a";
    $storage = "n/a";
    $os = "n/a";
    $domain = "n/a";
    $ip = $_POST["ip"];
    $mac = $_POST["mac"];
    $sn = $_POST["sn"];
    $conx_type = "Ethernet";
    $ms_office = "n/a";
    $antivirus = "n/a";
    $start_date = date("Y-m-d");
    $state = $_POST["state"];

    // Prepare the SQL query
    $sql = "INSERT INTO device (type, nom, session, username, location, dep, model, cpu, ram, storage, os, domain, ip, mac, sn, conx_type, ms_office, antivirus, start_date, state)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the query
    $stmt = mysqli_prepare($conn, $sql);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ssssssssssssssssssss", $type, $nom, $session, $username, $location, $dep, $model, $cpu, $ram, $storage, $os, $domain, $ip, $mac, $sn, $conx_type, $ms_office, $antivirus, $start_date, $state);

    try {
        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            // Return a JSON response with a success message
            echo json_encode(["success" => true]);
        } else {
            // Return a JSON response with an error message
            http_response_code(500); // Set the HTTP status code to 500 (Internal Server Error)
            echo json_encode(["error" => mysqli_error($conn)]);
        }
    } catch (mysqli_sql_exception $e) {
            // Return a generic error message
            http_response_code(500); // Set the HTTP status code to 500 (Internal Server Error)
            echo json_encode(["error" => "Something went wrong. Please try again later."]);
        }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
?>
