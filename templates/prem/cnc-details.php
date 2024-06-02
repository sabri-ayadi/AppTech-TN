<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) { ?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CNC Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/inter/inter-details.css">
</head>
<br>
<?php include "navbar-ad.php";?>
<?php include "cnc/cnc-details-conf.php";?>

<div class="container">
        <h4><font color="blueviolet">CNC Intervention N°= <?php echo $row['id_cnc']; ?>  </font> </h4><hr>

    <div class="row">
    <div class="col">
        <label for="add">Crée le :</label>
        <input type="text" name="add" id="add" class="form-input" value="<?php echo $row['created_dt']; ?>" readonly>
    </div>
    <div class="col">
        <label for="open">Traiter le :</label>
        <input type="text" name="open" id="open" class="form-input" value="<?php echo $row['opened_dt']; ?>" placeholder="non traité" readonly>
    </div>
    <div class="col">
        <label for="close">Fermé le :</label>
        <input type="text" name="close" id="close" class="form-input" value="<?php echo $row['closed_dt']; ?>" placeholder="non clôturé" readonly>
    </div>
    </div>

    <hr>
    <div class="row">
        <div class="col">
            <label for="fullname">l'Utilisateur :</label>
            <input type="text" name="fullname" id="fullname" class="form-input" value="<?php echo $row['fullname']; ?>" readonly>
        </div>
        <div class="col">
            <label for="mat">Matricule :</label>
            <input type="text" name="mat" id="mat" class="form-input" value="<?php echo $row['mat']; ?>" readonly>
        </div>
        <div class="col">
            <label for="department">Department :</label>
            <input type="text" name="department" id="department" class="form-input" value="<?php echo $row['department']; ?>" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="tel">Contact :</label>
            <input type="text" name="tel" id="tel" class="form-input" value="<?php echo $row['tel']; ?>" readonly>
        </div>
        <div class="col">
            <label for="mail">Email :</label>
            <input type="text" name="mail" id="mail" class="form-input" value="<?php echo $row['mail']; ?>" readonly>
        </div>
    </div>

</div>
</br>

<div class="container">
    <div class="row">
        <div class="col">
            <label for="nom">Equipement :</label>
            <input type="text" name="nom" id="nom" class="form-input" value="<?php echo $row['name_machine']; ?>" readonly>
        </div>
        <div class="col">
            <label for="model">Model :</label>
            <input type="text" name="model" id="model" class="form-input" value="<?php echo $row['model_machine']; ?>" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="ip">IP :</label>
            <input type="text" name="ip" id="ip" class="form-input" value="<?php echo $row['ip_machine']; ?>" readonly>
        </div>
        <div class="col">
            <label for="id_machine">ID :</label>
            <input type="text" name="id_machine" id="id_machine" class="form-input" value="<?php echo $row['id_machine']; ?>" readonly>
        </div>
    </div>
</div>
</br>

<div class="container">
<form id="interventionForm">

    <div class="row">
        <div class="col">
            <label for="problemtype" class="form-label">Type de Demande :</label>
            <input type="text" class="form-control" id="problemtype" name="problemtype" value="<?php echo $row['problemtype']; ?>" readonly>
        </div>
        <div class="col">
            <label for="priority" class="form-label">Priority:</label>
            <input type="text" class="form-control" id="priority" name="priority" value="<?php echo $row['priority']; ?>" readonly>
        </div>
    </div>
    
        <div class="mb-3">
            <label for="subject" class="form-label">Subject:</label>
            <input type="text" class="form-control" id="subject" name="subject" value="<?php echo $row['subject']; ?>">
        </div>
        <div class="mb-3">
            <label for="explication" class="form-label">Explication:</label>
            <textarea class="form-control" id="explication" name="explication"><?php echo $row['explication']; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="solution" class="form-label">Solution:</label>
            <textarea class="form-control" id="solution" name="solution" required><?php echo $row['solution']; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="state" class="form-label">State:</label>
            <input type="text" class="form-control" id="state" name="state" value="<?php echo $row['state']; ?>" readonly>
        </div>

        <div class="divbtn">
            <button type="button" class="btn btn-secondary" onclick="window.location.href='cnc-lst.php'">Retour</button>
            <?php if(!$isClosed): ?>
                <button type="button" class="btn btn-primary" id="openButton" <?php if($state === 'En cours') echo 'disabled'; ?>>Open</button>
                <button type="button" class="btn btn-success" id="closeButton" <?php if($state !== 'En cours') echo 'disabled'; ?>>Close</button>
            <?php endif; ?>
        </div>
    </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
            $(document).ready(function() {
                $('#openButton').click(function() {
                    swal({
                        title: "Are you sure?",
                        text: "You want to get this CNC Interv ?.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willOpen) => {
                        if (willOpen) {
                            $.post('cnc/cnc-open.php', { id_cnc: <?php echo $id_cnc; ?> }, function(response) {
                                swal("Success", "You can start the job now.", "success").then(() => {
                                    location.reload();
                                });
                            }).fail(function(xhr) {
                                swal("Error", xhr.responseText || "Something went wrong. Please try again later.", "error");
                            });
                        }
                    });
                });

                $('#closeButton').click(function() {
                    swal({
                        title: "Are you sure?",
                        text: "Once closed, you cannot modify this Intervention.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willClose) => {
                        if (willClose) {
                            const formData = {
                                id_cnc: <?php echo $id_cnc; ?>,
                                subject: $('#subject').val(),
                                explication: $('#explication').val(),
                                solution: $('#solution').val()
                            };
                            $.post('cnc/cnc-close.php', formData, function(response) {
                                swal("Success", "Intervention clôturée avec succès!.", "success").then(() => {
                                    location.reload();
                                });
                            }).fail(function(xhr) {
                                swal("Error", xhr.responseText || "Something went wrong. Please try again later.", "error");
                            });
                        }
                    });
                });
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
