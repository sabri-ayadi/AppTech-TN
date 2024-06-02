<?php

require dirname(__DIR__) . '/../../includes/db_connect.php';

// Check if user is logged in and retrieve matricule

        $query =   "SELECT * FROM user";  
                        
        $result = mysqli_query($conn, $query);
        $rowCount = mysqli_num_rows($result); //function to check if there are any rows in the result set.

    ?>

