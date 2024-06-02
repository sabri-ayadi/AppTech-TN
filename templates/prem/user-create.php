<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) { ?> 

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/assets/usr_create.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">

    <title>New User</title>
    
</head>
<body>

<?php include "navbar-ad.php";?>

      <div class="container">
          <div class="custom-container">
            <h2>Création Nouveau Utilisateur</h2>

            <div class="form">
                <form id="user-create-form" action="" method="post">

                    <div class="form-group">
                        <label for="mat">Matricule : *</label><br>
                        <input type="text" id="mat" name="mat" maxlength="4" minlength="4" placeholder="4321" required>
                    </div>

                    <div class="form-group">
                    <label for="fullname">Nom & Prénom : *</label><br>
                    <input type="text"  id="fullname" name="fullname" placeholder="Nom et Prénom" required>
                    </div>

                    <div class="form-group">
                    <label for="password">Password : *</label><br>
                    <input type="password" id="password" name="password" placeholder="mi1234**" required>
                    </div>

                    <!-- update the user-edit also if you update this dropdown list below -->
                    <div class="form-group">
                        <label for="department">Department: *</label><br>
                        <div class="input-group">
                            <select id="department" name="department" required>
                                <option value="" selected disabled>Select</option>
                                <option value="Production">Production</option>
                                <option value="Quality">Quality</option>
                                <option value="Logistique">Logistique</option>
                                <option value="Administration">Administration</option>
                                <option value="Achat">Achat</option>
                                <option value="Maintenance">Maintenance</option>
                                <option value="ICT">ICT</option>
                                <option value="RH">RH</option>
                                <option value="Autre">Autre</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="job">Fonction : *</label><br>
                        <input type="text" id="job" name="job" required>
                    </div>
                    
                    <!-- update the user-edit also if you update this dropdown list below -->
                    <div class="form-group">
                        <label for="type">Privilège : *</label><br>
                        <div class="input-group">
                            <select id="type" name="type" required>
                                <option value="" selected disabled>Select</option>
                                <option value="2">User (2)</option>
                                <option value="1">Admin (1)</option>
                                <option value="3">L3 (3)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tel">Tel : *</label><br>
                        <input type="text" id="tel" name="tel" maxlength="8" minlength="8" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="mail">Email :</label><br>
                        <input type="email" id="mail" name="mail">
                    </div>     
        
                        <div class="divbtn">
                            <a class="btn btn-outline-danger" type="button" href="user-lst.php">Cancel</a>
                            <button class="btn btn-outline-success" type="submit" value='submit' id='submit'>Create</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

<!-- bootstrap script for button create and cancel -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert area and send data to PHP conf file -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
// Trigger SweetAlert on successful and errorful form submission
document.getElementById('user-create-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the form data
    const formData = new FormData(event.target);

    // Send the form data to the server
    fetch('user/user-create-conf.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            return response.json().then(data => {
                throw new Error(data.error);
            });
        }
    })
    .then(data => {
        if (data.success) {
            swal({
                title: "Good job!",
                text: "A new user has been created successfully.",
                icon: "success",
                button: "OK",
            }).then(() => {
                window.location.href = "user-lst.php";
            });
        } else {
            swal({
                title: "Oops!",
                text: data.error,
                icon: "error",
                button: "Try again",
            });
        }
    })
    .catch(error => {
        swal({
            title: "Oops!",
            text: error.message,
            icon: "error",
            button: "Try again",
        });
    });
});



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
 