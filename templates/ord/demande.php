<?php 
// home.php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 2) { ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/assets/usr_dem.css">
    <title>Intervention</title>
</head>    

<?php include "navbar.php";?>
<?php include "conf/dev-list.php";?>
<?php include "conf/info-list.php";?> 

<body>
        <div class="container">
            <div class="custom-container1">
                <h3>Demande d'équipement Informatique:</h3>
                <h5>Les champs avec le symbole (*) sont obligatoires</h5>
            </div>

            <div class="custom-container2">
            <div class="form">
                <form action="conf/dem-conf.php" method="post">
    
                    <div class="input-group">
                        <label>Type de demande : *</label><br>
                        <div class="radio-group">
                            <input type="radio" id="software" name="problemtype" value="Logiciel" required>
                            <label for="software">Installation Logiciel</label><br>
                            <input type="radio" id="hardware" name="problemtype" value="Matériel" required>
                            <label for="hardware">Equipement Matériel</label><br>
                            <input type="radio" id="network" name="problemtype" value="Réseau" required>
                            <label for="network">Accès Réseau</label><br>
                            <input type="radio" id="printer" name="problemtype" value="Impression" required>
                            <label for="printer">Impression</label><br>
                            <input type="radio" id="autre" name="problemtype" value="Autre" required>
                            <label for="autre">Autre...</label><br>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="id_dev">Equipement concerné : *</label><br>
                        <select id="id_dev" name="id_dev" required>
                        <option value="" disabled selected>Sélectionnez votre équipement</option>
                                <?php foreach($rows as $row) { ?>
                                    <!-- dev_model will saved in the db. the dev_id & dev_model just for display // if you want more update the query first -->
                                    <option value='<?php echo $row['dev_id']; ?>'><?php echo $row['dev_nom'].' - '.$row['dev_model']; ?></option>
                                <?php } ?>

                        </select>
    
                    </div>

                     <div class="input-group">
                        <label for="priority">Priority Level: *</label><br>
                        <select id="priority" name="priority" required>
                            <option value="" selected disabled>Priorité de votre demande</option>
                            <option value="Emergency">Emergency</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="subject">Description : *</label><br>
                        <input type="text" id="subject" name="subject" placeholder="Exp: nom périphérique, accès au, install logiciel.." required><br></div>
        
                    <div class="input-group">
                        <label for="explication">Explication :</label><br>
                        <textarea type="explication" name="explication" rows="5" cols="77" placeholder="Expliquez votre demande si besoin.."></textarea></div>
    
                    <div class="input-group">
                        <label for="tel">Contact :</label><br>
                        <input type="text" name="tel" value="<?php echo htmlspecialchars($tel); ?>" placeholder="Update your profile" readonly><br>
                    </div>
    
                    <div class="input-group">
                        <label for="mail">Email Professionel:</label><br>
                        <input type="email" name="mail" value="<?php echo htmlspecialchars($mail); ?>" placeholder="Update your profile" readonly><br>
                    </div>
    
                    <div class="divbtn">
                        <button type="submit" value='submit' id='submit'>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


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