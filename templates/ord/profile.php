<?php 
// home.php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 2) { ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/usr_pro.css">
    <title>Profile</title>
</head>    

<body>

<?php include "navbar.php";?> 
<?php include "conf/pro-conf.php";?>

    <div class="container">
            <div class="custom-container1">
                <h2>Profile</h2>
            </div>
            
        <div class="custom-container2">
            <div class="form">

               <!-- display success and danger alerts -->
                <?php if(isset($_SESSION['success_message_pro'])): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['success_message_pro']; ?>
                </div>
                <?php unset($_SESSION['success_message_pro']); ?>
                <?php endif; ?>

                <?php if(isset($_SESSION['error_message_pro'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['error_message_pro']; ?>
                </div>
                <?php unset($_SESSION['error_message_pro']); ?>
                <?php endif; ?>

                <form method="POST" action="conf/update-profile.php">
                    <label for="mat">Matriculation Number:</label>
                    <input type="text" id="mat" name="mat" value="<?php echo $mat; ?>" readonly><br>

                    <label for="fullname">Full Name:</label>
                    <input type="text" id="fullname" name="fullname" value="<?php echo $fullname; ?>" readonly><br>

                    <label for="department">Department:</label>
                    <input type="text" id="department" name="department" value="<?php echo $department; ?>" readonly><br>

                    <label for="job">Fonction:</label>
                    <input type="text" id="job" name="job" value="<?php echo $job; ?>" readonly><br>

                    <label for="mail">Email :</label>
                    <input type="text" id="mail" name="mail" placeholder="email@mitechtn.com seulement" value="<?php echo $mail; ?>"><br>

                    <label for="tel">Phone Number:</label>
                    <input type="text" id="tel" name="tel" minlength="8" maxlength="8" required placeholder="Please provide your work phone number" value="<?php echo $tel; ?>"><br><br>

                    <div class="divbtn">
                        <button type="submit">Update</button><br><br>
                    </div>

                </form>                        
            </div>

        </div>

    </div>

    <br>

       
    <div class="container">
        <div class="custom-container2">
            <div class="form">
                <h4>Change Password :</h4>
                <br>

                <!-- display success and danger alerts -->
                <?php if(isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_SESSION['success_message']; ?>
                </div>
                <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>

                <?php if(isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['error_message']; ?>
                </div>
                <?php unset($_SESSION['error_message']); ?>
                <?php endif; ?>


                <form method="POST" action="conf/update-password.php">
                    <label for="old_password">Old Password:</label>
                    <input type="password" id="old_password" name="old_password" required><br>

                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" minlength="8" maxlength="16" required><br>

                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" minlength="8" maxlength="16" required><br><br>

                    <div class="divbtn">
                        <button type="submit">Update</button><br><br>
                    </div>
                </form>
            </div>
        </div>
    </div>

<br>


</body>
</html>


<?php 

     }

else {
     
     header("Location: /index.php");
     exit();
}
 ?>