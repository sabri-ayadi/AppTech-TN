<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) { ?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Création Intervention</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/inter/inter-details.css">
</head>
<br>
<?php include "navbar-ad.php";?>
<?php include "ad-create/user-info.php";?>
<?php include "cnc/cnc-lst.php"; ?>

<div class="container">
<form id="cncForm">
    <h4><font color="#003be5">Intervention pour machine CNC</font> </h4>
    <hr>
    <div class="d-flex justify-content-between align-items-center">
        <h5><font color="#ad0000">Utilisateur :</font></h5> 
        <p><a href="user-lst.php" target="_blank"><i>List Users</i></a></p>
    </div>

    <div class="row">
        <div class="col">
            <label for="mat">Matricule : *</label>
            <input type="text" name="mat" id="mat" class="form-input" value="" placeholder="Mat here" required>
        </div>
        <div class="col">
            <label for="fullname">Nom & Prénom :</label>
            <input type="text" name="fullname" id="fullname" class="form-input" value="" readonly>
        </div>
        <div class="col">
            <label for="department">Department :</label>
            <input type="text" name="department" id="department" class="form-input" value="" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="tel">Contact :</label>
            <input type="text" name="tel" id="tel" class="form-input" value="" readonly>
        </div>
        <div class="col">
            <label for="mail">Email :</label>
            <input type="text" name="mail" id="mail" class="form-input" value="" readonly>
        </div>
    </div>

</div>
</br>

<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h5><font color="#ad0000">Machine :</font></h5> 
        <p><a href="cnc.lst.php" target="_blank"><i>Device CNC</i></a></p>
    </div>
    <div class="row">
        <div class="col">
        <label for="machine">Select Machine: *</label><br>
            <select id="machine" name="id_machine" required>
                <option value="" disabled selected>Select your Machine :</option>
                <?php foreach($rows as $row) { ?>
                    <!-- id_machine will be saved in the db. the id_machine & name are just for display -->
                    <option value='<?php echo htmlspecialchars($row['id_machine']); ?>'>
                                    <?php echo htmlspecialchars($row['name']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col">
            <label for="model">Model :</label>
            <input type="text" name="model" id="model" class="form-input" value="" readonly>
        </div>
        <div class="col">
            <label for="type">Type :</label>
            <input type="text" name="type" id="type" class="form-input" value="" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="s_n">SN :</label>
            <input type="text" name="s_n" id="s_n" class="form-input" value="" readonly>
        </div>
        <div class="col">
            <label for="ip_1">IP :</label>
            <input type="text" name="ip_1" id="ip_1" class="form-input" value="" readonly>
        </div>
        <div class="col">
            <label for="id_machine">ID :</label>
            <input type="text" name="id_machine" id="id_machine" class="form-input" value="" readonly>
        </div>
    </div>
</div>
</br>

<div class="container">
    <h5><font color="#ad0000">Détails Intervention :</font></h5>
    <div class="row">
        <div class="col">
            <label for="problemtype">Type Interv : *</label><br>
            <select id="problemtype" name="problemtype" required>
                <option value="" selected disabled>Select Type</option>
                <option value="Logiciel">Logiciel</option>
                <option value="Réseau">Réseau</option>
                <option value="Périphérique">Périphérique</option>
            </select>
        </div>

        <div class="col">
            <label for="priority">Priority Level : *</label><br>
            <select id="priority" name="priority" required>
                <option value="" selected disabled>Select priority of your request</option>
                <option value="Emergency">Emergency</option>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label for="subject" class="form-label">Subject : *</label>
        <input type="text" class="form-control" id="subject" name="subject" placeholder="Sujet de problème" required>
    </div>
    <div class="mb-3">
        <label for="explication" class="form-label">Explication :</label>
        <textarea class="form-control" id="explication" name="explication"></textarea>
    </div>

    <div class="divbtn">
        <button type="button" class="btn btn-secondary" onclick="window.location.href='cnc-lst.php'">Liste Interventions</button> &nbsp;
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- fetch user data based on the "mat" input field: -->
<script>
document.getElementById('mat').addEventListener('input', function() {
    var matricul = this.value;
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var userData = JSON.parse(this.responseText);
            if (userData.error) {
                document.getElementById('fullname').value = "not exist";
                document.getElementById('department').value = "not exist";
                document.getElementById('tel').value = "not exist";
                document.getElementById('mail').value = "not exist";
            } else {
                document.getElementById('fullname').value = userData.fullname;
                document.getElementById('department').value = userData.department;
                document.getElementById('tel').value = userData.tel;
                document.getElementById('mail').value = userData.mail;
            }
        }
    };
    
    xhttp.open("GET", "ad-create/user-info.php?mat=" + matricul, true);
    xhttp.send();
});
</script>


<!-- fetch Machine CNC data based on the "id_machine" select field: -->
    <script>
    document.getElementById('machine').addEventListener('change', function() {
        var id_machine = this.value;

        if (id_machine) {
            $.ajax({
                url: 'cnc/cnc-info.php',
                method: 'GET',
                data: { id_machine: id_machine },
                success: function(response) {
                    var data = JSON.parse(response);

                    if (data.error) {
                        alert(data.error);
                    } else {
                        document.getElementById('model').value = data.model;
                        document.getElementById('type').value = data.type;
                        document.getElementById('s_n').value = data.s_n;
                        document.getElementById('ip_1').value = data.ip_1;
                        document.getElementById('id_machine').value = data.id_machine;
                    }
                },
                error: function() {
                    alert('An error occurred while fetching the machine data.');
                }
            });
        }
    });
    </script>

<!-- Handle the Form Submission with SweetAlert -->
<script>
document.getElementById('cncForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    var formData = new FormData(this);
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response.success) {
                    swal({
                        title: "Good job!",
                        text: "CNC Intervention créée avec succès.",
                        icon: "success",
                        button: "OK",
                    }).then(() => {
                        window.location.href = 'cnc-lst.php';
                    });
                } else {
                    swal({
                        title: "Oops!",
                        text: response.error,
                        icon: "error",
                        button: "Try again",
                    });
                }
            } else {
                swal({
                    title: "Oops!",
                    text: "Something went wrong with the server request.",
                    icon: "error",
                    button: "Try again",
                });
            }
        }
    };
    
    xhttp.open("POST", "ad-create/save-cnc.php", true);
    xhttp.send(formData);
});
</script>

</body>
</html>

<?php 
} else {
    header("Location: /index.php");
    exit();
}
?>
