<?php
require dirname(__DIR__) . '../../../includes/db_connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST["type"];
    $nom = $_POST["nom"];
    $session = $_POST["session"];
    $username = $_POST["username"];
    $location = $_POST["location"];
    $dep = $_POST["dep"];
    $model = $_POST["model"];
    $cpu = $_POST["cpu"];
    $ram = $_POST["ram"];
    $storage = $_POST["storage"];
    $os = $_POST["os"];
    $domain = $_POST["domain"];
    $ip = $_POST["ip"];
    $mac = $_POST["mac"];
    $sn = $_POST["sn"];
    $conx_type = "Ethernet";
    $ms_office = $_POST["ms_office"];

    if (isset($_POST["antivirus"])) {
        $antivirus = $_POST["antivirus"];
    } else {
        http_response_code(400); // Set the HTTP status code to 400 (Bad Request)
        echo json_encode(["error" => "Antivirus ? Yes or No."]);
        exit();
    }

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
