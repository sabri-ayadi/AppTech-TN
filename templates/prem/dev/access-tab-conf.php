<?php

require dirname(__DIR__) . '/../../includes/db_connect.php';

// Check if user is logged in and retrieve matricule

        $query =   "SELECT 
                        u.mat, 
                        u.fullname, 
                        u.department, 
                        d.id_dev, 
                        d.type, 
                        d.nom, 
                        d.model, 
                        d.dep,
                        ua.date,
                        ua.iduser_access
                    FROM user u
                    JOIN user_access ua ON u.mat = ua.user_mat
                    JOIN device d ON ua.device_id = d.id_dev";  
                        
        $result = mysqli_query($conn, $query);
        $rowCount = mysqli_num_rows($result); //function to check if there are any rows in the result set.

    ?>

