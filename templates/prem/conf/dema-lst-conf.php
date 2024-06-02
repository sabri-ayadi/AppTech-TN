<?php

require dirname(__DIR__) . '/../../includes/db_connect.php';

// Check if user is logged in and retrieve matricule

                $query =  "SELECT 
                    i.id_inter,
                    i.created_dt,
                    i.problemtype,
                    i.priority,
                    i.subject,
                    i.explication,
                    i.state,
                    i.type,
                    u.fullname,
                    u.department,
                    d.id_dev,
                    d.nom AS device_name
                FROM 
                    interdemande AS i
                JOIN 
                    user AS u ON i.mat = u.mat
                JOIN 
                    device AS d ON i.id_dev = d.id_dev
                WHERE 
                    i.type LIKE 'Demande' 
                ORDER BY
                    i.id_inter DESC";
                        
        $result = mysqli_query($conn, $query);
        $rowCount = mysqli_num_rows($result); //function to check if there are any rows in the result set.

?>

