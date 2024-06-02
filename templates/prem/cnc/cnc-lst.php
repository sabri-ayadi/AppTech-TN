<?php
require dirname(__DIR__) . '/../../includes/db_connect.php'; 

    if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) {
    


    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT id_machine, name, model FROM machine");
                            
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Store the result in an array
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }

    // Close the statement
    $stmt->close();

}else{
    // handle unauthorized access or session timeout
    header("Location: /index.php");
    exit();
}

?>
