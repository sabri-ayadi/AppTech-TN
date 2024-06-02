<?php 
// home.php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 2) { ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/usr_inter.css">

    <title>Intervention</title>
    
</head>    

<?php include "navbar.php";?>
<?php include "conf/dev-list.php";?> 
<?php include "conf/info-list.php";?> 


<body>
        <div class="container">
            <div class="custom-container1">
                <h2>Intervention Technique Forme</h2>
                <h5>Les champs avec le symbole (*) sont obligatoires</h5>
            </div>

            <div class="custom-container2">
            <div class="form">
                <form action="conf/inter-conf.php" method="post" enctype="multipart/form-data">
    
                    <div class="input-group">
                        <label>Type of Problem : *</label><br>
                        <div class="radio-group">
                            <input type="radio" id="software" name="problemtype" value="Logiciel" required>
                            <label for="software">Logiciel</label><br>
                            <input type="radio" id="hardware" name="problemtype" value="Matériel" required>
                            <label for="hardware">Matériel</label><br>
                            <input type="radio" id="network" name="problemtype" value="Réseau" required>
                            <label for="network">Réseau</label><br>
                            <input type="radio" id="printer" name="problemtype" value="Imprimante" required>
                            <label for="printer">Imprimante</label><br>
                            <input type="radio" id="ms365" name="problemtype" value="MS-365" required>
                            <label for="ms365">MS 365</label><br>
                            <input type="radio" id="autre" name="problemtype" value="Autre" required>
                            <label for="autre">Autre...</label><br>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="id_dev">L'équipement : *</label><br>
                        <select id="id_dev" name="id_dev" required>
                                <option value="" disabled selected>Select your device :</option>
                                <?php foreach($rows as $row) { ?>
                                    <!-- dev_id will saved in the db. the dev_id & dev_model just for display // if you want more update the query first (to do = save the id of the device only !!) --> 
                                    <option value='<?php echo $row['dev_id']; ?>'><?php echo $row['dev_nom'].' - '.$row['dev_model']; ?></option>
                                <?php } ?>

                        </select>
    
                    </div>

                     <div class="input-group">
                        <label for="priority">Priority Level: *</label><br>
                        <select id="priority" name="priority" required>
                            <option value="" selected disabled>Select priority of your request</option>
                            <option value="Emergency">Emergency</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="subject">Subject : *</label><br>
                        <input type="text" id="subject" name="subject" placeholder="Exp: changement mot de passe" required><br></div>
        
                    <div class="input-group">
                        <label for="explication">Explication :</label><br>
                        <textarea type="explication" name="explication" rows="5" cols="77" placeholder="Explication de votre problème technique .."></textarea></div>

                    <div class="input-group">
                        <label for="image">Capture d'écran :</label><br>
                        <input type="file" name="image" id="image" accept="image/png, image/jpg, image/jpeg" onchange="validateFileSize(this)"><br></div>
    
                        <div class="input-group">
                            <label for="tel">Contact :</label><br>
                            <input type="text" name="tel" value="<?php echo htmlspecialchars($tel); ?>" placeholder="Update your profile" readonly><br>
                        </div>

                        <div class="input-group">
                            <label for="mail">Email :</label><br>
                            <input type="email" name="mail" value="<?php echo htmlspecialchars($mail); ?>" placeholder="Update your profile" readonly><br>
                        </div>
                    <input type="hidden" name="form_type" value="Intervention">
    
                    <div class="divbtn">
                    <button type="submit" value='submit' id='submit'>Envoyer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



<script>
function validateFileSize(input) {
    if (input.files.length > 0) {
        const fileSize = input.files[0].size; // in bytes
        const maxSize = 2 * 1024 * 1024; // 2 MB

        if (fileSize > maxSize) {
            swal({
                title: "Oops!",
                text: "File size limit Error. Please choose a smaller Image.",
                icon: "error",
                button: "OK",
            });
            // Reset file input to clear the selected file
            input.value = '';
        }
    }
}
</script>


<!-- SweetAlert area -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
// Trigger SweetAlert on successful and errorful form submission
if (window.location.search.includes('success=')) {
    swal({
        title: "Good job!",
        text: "Suivez votre Demande dans section 'Suivie'.",
        icon: "success",
        button: "OK",
    });
} else if (window.location.search.includes('error=')) {
    const errorMessage = new URLSearchParams(window.location.search).get('error');
    swal({
        title: "Oops!",
        text: errorMessage || "Something went wrong. Please try again later.",
        icon: "error",
        button: "Try again",
    });
}
</script>


</body>
</html>


<?php 

     }

else {
     
     header("Location: /index.php");
     exit();
}

?>


