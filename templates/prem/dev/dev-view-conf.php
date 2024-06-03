<?php 
    require dirname(__DIR__) . '../../../includes/db_connect.php';
    
    $devId = $_GET['id_dev'];

    // SQL query to fetch data from the joined tables
    $sql = "SELECT
                i.id_inter,
                i.created_dt,
                u.fullname,
                u.department,
                i.problemtype,
                i.priority,
                i.subject,
                i.solution,
                i.state,
                d.id_dev
            FROM interdemande i
            JOIN device d ON i.id_dev = d.id_dev
            JOIN user u ON i.mat = u.mat
            WHERE i.id_dev = ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $devId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $interdemandeData = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $interdemandeData[] = $row;
    }
    
    mysqli_close($conn);
?>

