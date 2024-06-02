<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) { ?> 

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/assets/dev/add_print.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">

    <title>New Laptop</title>
    
</head>
<body>

<?php include "navbar-ad.php";?>

      <div class="container">
          <div class="custom-container">
            <h2>Nouveau Imprimante</h2>
            <br>

            <div class="form">
                <form id="laptop-create-form" action="" method="post">

                        <div class="row">
                            <div class="col">
                                <label for="type">Type: *</label>
                                <select name="type" id="type" class="form-select" required>
                                    <option value="" selected disabled>Type Imprimante</option>
                                    <option value="Imprimante L-N">Impr Laser Noir</option>
                                    <option value="Imprimante L-C">Impr Laser Couleur</option>
                                    <option value="Imprimante J-E">Impr Jet d'encre</option>
                                    <option value="Imprimante TH">Imprimante Thermique</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="nom">Name Imprimant: *</label>
                                <input type="text" name="nom" id="nom" class="form-input" placeholder="Konica Minolta" required>
                            </div>
                            <div class="col">
                                <label for="model">Model: *</label>
                                <input type="text" name="model" id="model" class="form-input" placeholder="c257i" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="location">Location: *</label>
                                <select name="location" id="location" class="form-select" required>
                                    <option value="" selected disabled>Select Location</option>
                                    <option value="m1">Mitech 1</option>
                                    <option value="m2">Mitech 2</option>
                                    <option value="m3">Mitech 3</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="dep">Department: *</label>
                                <select name="dep" id="dep" class="form-select" required>
                                    <option value="" selected disabled>Select Department</option>
                                    <option value="Production">Production</option>
                                    <option value="Quality">Quality</option>
                                    <option value="Logistique">Logistique</option>
                                    <option value="Administration">Administration</option>
                                    <option value="Achat">Achat</option>
                                    <option value="Maintenance">Maintenance</option>
                                    <option value="ICT">ICT</option>
                                    <option value="RH">RH</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="conx_type">Type connection: *</label>
                                <select name="conx_type" id="conx_type" class="form-select" required>
                                    <option value="" selected disabled>Select Type</option>
                                    <option value="m1">USB</option>
                                    <option value="m2">Ethernet</option>
                                    <option value="m3">WiFi</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="ip">IP:</label>
                                <input type="text" name="ip" id="ip" class="form-input" placeholder="192.168.7.198">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="mac">MAC:</label>
                                <input type="text" name="mac" id="mac" class="form-input" placeholder="00:00:00:00:00:00">
                            </div>
                            <div class="col">
                                <label for="sn">Serial Number:</label>
                                <input type="text" name="sn" id="sn" class="form-input" placeholder="S/N">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="state">State:</label>
                                <select name="state" id="state" class="form-select">
                                    <option value="Up">Up</option>
                                    <option value="Down">Down</option>
                                </select>
                            </div>
                            
                        </div>
                        <br>

                        <div class="divbtn">
                            <a class="btn btn-outline-danger" type="button" href="dev-lst.php">Cancel</a>
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
document.getElementById('laptop-create-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the form data
    const formData = new FormData(event.target);

    // Send the form data to the server
    fetch('dev/add-print-conf.php', {
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
                text: "A new Printer has been add successfully.",
                icon: "success",
                button: "OK",
            }).then(() => {
                window.location.href = "dev-lst.php";
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
 