<?php

require dirname(__DIR__) . '/../../includes/db_connect.php';
// Construct the SQL query to join the tables and fetch the required data
        $query = " SELECT 
                i.id_cnc, 
                i.created_dt, 
                u.fullname, 
                u.department, 
                i.problemtype, 
                m.name AS name_machine, 
                i.priority, 
                i.subject,
                i.state
            FROM 
                cnc_inter i
            JOIN 
                user u ON i.mat = u.mat
            JOIN 
                machine m ON i.id_machine = m.id_machine
            ORDER BY 
                i.id_cnc DESC";

$result = mysqli_query($conn, $query);
$rowCount = mysqli_num_rows($result); 