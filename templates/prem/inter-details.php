<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) { ?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Intervention Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/inter/inter-details.css">
</head>
<br>
<?php include "navbar-ad.php";?>
<?php include "inter/inter-details-conf.php";?>

<div class="container">
    <h4><font color="blueviolet">Intervention N°= <?php echo $row['id_inter']; ?>  </font> </h4>
    <hr>
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
            <input type="text" name="nom" id="nom" class="form-input" value="<?php echo $row['device_nom']; ?>" readonly>
        </div>
        <div class="col">
            <label for="type">Type :</label>
            <input type="text" name="type" id="type" class="form-input" value="<?php echo $row['device_type']; ?>" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="dep">Department :</label>
            <input type="text" name="dep" id="dep" class="form-input" value="<?php echo $row['dep']; ?>" readonly>
        </div>
        <div class="col">
            <label for="model">Model :</label>
            <input type="text" name="model" id="model" class="form-input" value="<?php echo $row['model']; ?>" readonly>
        </div>
        <div class="col">
            <label for="ip">IP :</label>
            <input type="text" name="ip" id="ip" class="form-input" value="<?php echo $row['ip']; ?>" readonly>
        </div>
        <div class="col">
            <label for="id_dev">ID :</label>
            <input type="text" name="id_dev" id="id_dev" class="form-input" value="<?php echo $row['id_dev']; ?>" readonly>
        </div>
    </div>
</div>
</br>

<div class="container">
<form id="interventionForm">

    <div class="row">
        <div class="col">
            <label for="problemtype" class="form-label">Type de Probleme:</label>
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
        <div class="form-group">
            <label for="maint" class="form-label">Type de Maintenance: *</label>
            <select id="maint" name="maint" class="form-control" required>
                <option value="Corrective" <?php if ($row['maint'] == 'Corrective') echo 'selected'; ?>>Corrective</option>
                <option value="Préventive" <?php if ($row['maint'] == 'Préventive') echo 'selected'; ?>>Préventive</option>
                <option value="Curative" <?php if ($row['maint'] == 'Curative') echo 'selected'; ?>>Curative</option>
            </select>
        </div>
        <?php if ($imgData): ?>
            <div class="mb-3">
                <label for="image" class="form-label">Attached Image:</label><br>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($imgData); ?>" class="img-fluid" alt="Intervention Image">
            </div>
        <?php endif; ?>

        <div class="divbtn">
            <button type="button" class="btn btn-secondary" onclick="window.location.href='inter-lst.php'">Retour</button>
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
                        text: "Once opened, you can start working on this intervention.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willOpen) => {
                        if (willOpen) {
                            $.post('inter/inter-open.php', { id_inter: <?php echo $id_inter; ?> }, function(response) {
                                swal("Success", "You can start your job now.", "success").then(() => {
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
                        text: "Once closed, you cannot modify this intervention.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willClose) => {
                        if (willClose) {
                            const formData = {
                                id_inter: <?php echo $id_inter; ?>,
                                subject: $('#subject').val(),
                                explication: $('#explication').val(),
                                solution: $('#solution').val(),
                                maint: $('#maint').val()
                            };
                            $.post('inter/inter-close.php', formData, function(response) {
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
