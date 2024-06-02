<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) { ?> 

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/assets/dev/add_laptop.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">

    <title>New Laptop</title>
    
</head>
<body>

<?php include "navbar-ad.php";?>

      <div class="container">
          <div class="custom-container">
            <h2>Nouveau Ordinateur</h2>
            <br>

            <div class="form">
                <form id="laptop-create-form" action="" method="post">

                        <div class="row">
                            <div class="col">
                                <label for="type">Type: *</label>
                                <select name="type" id="type" class="form-select" required>
                                    <option value="" selected disabled>Device Type</option>
                                    <option value="Desktop">Desktop</option>
                                    <option value="Laptop">Laptop</option>
                                    <option value="Workstation">Workstation</option>
                                    <option value="Server">Server</option>
                                    <option value="Switch">Switch</option>
                                    <option value="NAS">NAS</option>
                                    <option value="AP">AP</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="nom">Name PC: *</label>
                                <input type="text" name="nom" id="nom" class="form-input" placeholder="P7000" required>
                            </div>
                            <div class="col">
                                <label for="session">Session: *</label>
                                <input type="text" name="session" id="session" class="form-input" placeholder="TNFIRS-LAST" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="username">Username: *</label>
                                <input type="text" name="username" id="username" class="form-input" placeholder="User Name" required>
                            </div>

                            <div class="col">
                                <label for="location">Location: *</label>
                                <select name="location" id="location" class="form-select" required>
                                    <option value="" selected disabled>Select Location</option>
                                    <option value="Mitech 1">Mitech 1</option>
                                    <option value="Mitech 2">Mitech 2</option>
                                    <option value="Mitech 3">Mitech 3</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
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
                                    <option value="Autre">Autre</option>
                                </select>
                            </div>

                            <div class="col">
                                <label for="model">Model: *</label>
                                <input type="text" name="model" id="model" class="form-input" placeholder="Lenovo" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="cpu">CPU: *</label>
                                <input type="text" name="cpu" id="cpu" class="form-input" placeholder="i7" required>
                            </div>

                            <div class="col">
                                <label for="ram">RAM: *</label>
                                <input type="text" name="ram" id="ram" class="form-input" placeholder="8GB" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="storage">Storage: *</label>
                                <input type="text" name="storage" id="storage" class="form-input" placeholder="256GB SSD/HDD" required>
                            </div>

                            <div class="col">
                                <label for="os">OS: *</label>
                                <input type="text" name="os" id="os" class="form-input" value="Windows --" required>
                            </div>
                            <div class="col">
                                <label for="domain">Domain: *</label>
                                <input type="text" name="domain" id="domain" class="form-input" value="mitechtn.lan" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="ip">IP:</label>
                                <input type="text" name="ip" id="ip" class="form-input" value="192.168.7. --">
                            </div>
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
                                <label for="ms_office">MS Office:</label>
                                <input type="text" name="ms_office" id="ms_office" class="form-input" placeholder="MS Office 365">
                            </div>
                            <div class="col">
                                <label>Antivirus:</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="antivirus" value="yes"> Yes</label> &nbsp; &nbsp;
                                    <label><input type="radio" name="antivirus" value="no"> No</label>
                                </div>
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
    fetch('dev/add-laptop-conf.php', {
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
                text: "A new PC has been created successfully.",
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
 