<?php
include_once dirname(__DIR__) . '/../../includes/db_connect.php';

if (isset($_GET['id_inter'])) {
    $id_inter = mysqli_real_escape_string($conn, $_GET['id_inter']);
    
    $sql = "SELECT 
            i.*, 
            u.*, 
            d.nom AS device_nom,
            d.model AS device_model 
        FROM 
            interdemande AS i
        JOIN 
            user AS u ON i.mat = u.mat
        JOIN 
            device AS d ON i.id_dev = d.id_dev
        WHERE 
            i.id_inter = '$id_inter'";

    
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo "<p><strong>Intervention N°:</strong> " . $row['id_inter'] . "</p>";
        echo "<p><strong>l'Utilisateur:</strong> " . $row['fullname'] . "</p>";
        echo "<p><strong>Matricule:</strong> " . $row['mat'] . "</p>";
        echo "<p><strong>Date:</strong> " . $row['created_dt'] . "</p>";
        echo "<p><strong>Problem Type:</strong> " . $row['problemtype'] . "</p>";
        echo "<p><strong>Equipement:</strong> " . $row['device_nom'] . " " . $row['device_model'] . "</p>";
        echo "<p><strong>Priority:</strong> " . $row['priority'] . "</p>";
        echo "<p><strong>Subject:</strong> " . $row['subject'] . "</p>";
        echo "<p><strong>Explication:</strong> " . $row['explication'] . "</p>";
        echo "<p><strong>Contact:</strong> " . $row['tel'] . "<strong> Email: </strong> " . $row['mail'] . "</p>";
        echo "<p><strong>Solution:</strong> " . $row['solution'] . "</p>";

    } else {
        echo "No intervention found with ID: $id_inter";
    }

    mysqli_close($conn);
} 

// else {
//     echo "ID not provided.";
// }
?>
