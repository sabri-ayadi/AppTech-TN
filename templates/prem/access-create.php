<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) { ?> 

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <!-- to do and to be change the stylesheet -->
    <link rel="stylesheet" type="text/css" href="/assets/dev/add_print.css">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">

    <title>Add Access</title>
    
</head>
<body>

<?php include "navbar-ad.php";?>
<?php include "dev/access-create-conf.php";?>


      <div class="container">
          <div class="custom-container">
            <h2>Ajoute l'access à un utilisateur</h2>
            <br>

            <div class="form">
                
            

                <form id="user-access-form" action="" method="post">
                <h5>Select the User :</h5>
                <br>

                    <div class="row">
                        <div class="col">
                                <label for="mat">Matricule : *</label><br>
                                <input type="number" id="mat" name="mat" required>
                        </div>
                        <div class="col">
                                <label for="fullname">Nom & Prénom :</label><br>
                                <input type="text"  id="fullname" name="fullname" disabled >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                                <label for="department">Department :</label><br>
                                <input type="text" id="department" name="department" disabled >
                        </div>
                        <div class="col">
                                <label for="type">Type :</label><br>
                                <input type="text"  id="type" name="type" disabled>
                        </div>
                    </div>
                    
                    <br>
                    <hr />
                    <br>

                    <h5>Select the Device :</h5>
                    <br>

                    <div class="row">
                        <div class="col">
                                <label for="id_dev">ID Device : *</label><br>
                                <input type="text" id="id_dev" name="id_dev" required>
                        </div>
                        <div class="col">
                                <label for="nom">Nom :</label><br>
                                <input type="text"  id="nom" name="nom" disabled >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                                <label for="dep">Department :</label><br>
                                <input type="text" id="dep" name="dep" disabled >
                        </div>
                        <div class="col">
                                <label for="model">Model :</label><br>
                                <input type="text"  id="model" name="model" disabled>
                        </div>
                    </div>

                    <br>
                    <div class="divbtn">
                        <a class="btn btn-outline-danger" type="button" href="access-tab.php">Cancel</a>
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
document.getElementById('user-access-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the form data
    const formData = new FormData(event.target);

    // Send the form data to the server
    fetch('dev/access-create-conf.php', {
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
                text: "A new UserAccess has been created successfully.",
                icon: "success",
                button: "OK",
            }).then(() => {
                window.location.href = "access-tab.php";
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

<!-- fetch user data based on the "mat" input field: -->
<script>
document.getElementById('mat').addEventListener('input', function() {
    var matricul = this.value;
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var userData = JSON.parse(this.responseText);
            document.getElementById('fullname').value = userData.fullname;
            document.getElementById('department').value = userData.department;
            document.getElementById('type').value = userData.type;
        }
    };
    
    xhttp.open("GET", "dev/get_user_data.php?mat=" + matricul, true);
    xhttp.send();
});
</script>
<!-- fetch device data based on the "id_dev" input field: -->
<script>
document.getElementById('id_dev').addEventListener('input', function() {
    var id_dev = this.value;
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var deviceData = JSON.parse(this.responseText);
            document.getElementById('nom').value = deviceData.nom;
            document.getElementById('dep').value = deviceData.dep;
            document.getElementById('model').value = deviceData.model;
        }
    };

    xhttp.open("GET", "dev/get_device_data.php?id_dev=" + id_dev, true);
    xhttp.send();
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
 