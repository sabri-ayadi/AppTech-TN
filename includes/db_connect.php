<?php
$servername = "mysql"; // Docker container name
$username = "root"; // MySQL username
$password = "Tns@2424**"; // MySQL password
$database = "interapp"; // MySQL database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// else {
//     echo "Connected successfully";
// }
?>
