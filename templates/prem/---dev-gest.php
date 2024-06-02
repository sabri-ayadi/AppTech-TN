<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat']) && $_SESSION['type'] == 1) { 
?> 

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Gestion Devices</title>


  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/css/bootstrap-combined.min.css'>

  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
  <!-- Include DataTables CSS -->
  <link rel='stylesheet' href='https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css'>
  <!-- Include Font Awesome CSS -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css'>




</head>
<body>
	
<!-- <?php include "navbar-ad.php";?> -->

<div class="container">
  


<ul class="nav nav-tabs tabs-up" id="friends">
      <li><a href="dev/access-tab.php" data-target="#contacts" class="media_node active span" id="contacts_tab" data-toggle="tabajax" rel="tooltip"> Contacts </a></li>
      <li><a href="dev/access-tab.php" data-target="#friends_list" class="media_node span" id="friends_list_tab" data-toggle="tabajax" rel="tooltip"> Friends list</a></li>
      <li><a href="dev/access-tab.php" data-target="#awaiting_request" class="media_node span" id="awaiting_request_tab" data-toggle="tabajax" rel="tooltip">Awaiting request</a></li>
</ul>

<div class="tab-content">
<div class="tab-pane active" id="contacts">

      </div>
      <div class="tab-pane" id="friends_list">

      </div>
      <div class="tab-pane  urlbox span8" id="awaiting_request">

      </div>
    </div>

</div>

<script src='https://code.jquery.com/jquery-3.7.0.js'></script>
<script src='https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js'></script>
<script src='https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js'></script>
<script src='https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js'></script>

<script src='https://netdna.bootstrapcdn.com/twitter-bootstrap/2.1.1/js/bootstrap.min.js'></script>

<script>

$('[data-toggle="tabajax"]').click(function(e) {
    var $this = $(this),
        loadurl = $this.attr('href'),
        targ = $this.attr('data-target');

    $.get(loadurl, function(data) {
        $(targ).html(data);
    });

    $this.tab('show');
    return false;
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
