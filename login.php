<?php 
session_start(); 
include "includes/db_connect.php";

if (isset($_POST['mat']) && isset($_POST['password'])) {

	// Call validation function
    function validate($data){
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }

    $mat = validate($_POST['mat']);
    $pass = validate($_POST['password']);

	// Verify the mat and password are not empty
    if (empty($mat)) {
        header("Location: index.php?error=Matriculation Number is required");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
		// Check if mat exists in database
        $sql = "SELECT * FROM user WHERE mat='$mat'";
        $result = mysqli_query($conn, $sql);
        
        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

			// Check if password matches hashed password
            if (sha1($pass) === $row['password']) {

                $_SESSION['id'] = $row['id'];
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['mat'] = $row['mat'];
                $_SESSION['mail'] = $row['mail'];
                $_SESSION['type'] = $row['type'];
                // Redirect based on user type
                if ($row['type'] == 1) {
                    header("Location: /templates/prem/admin-panel.php");
                } else if ($row['type'] == 2) {
                    header("Location: /templates/ord/user-panel.php");
                } else {
                    header("Location: /index.php?error=Invalid user type");
                }
                exit();

            } else {
                header("Location: index.php?error=Incorrect password");
                exit();
            }
        } else {
            header("Location: index.php?error=User not found");
            exit();
        }
    }
    
} else {
    header("Location: index.php");
    exit();
}
?>
