<?php 
// home.php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['mat'])&& $_SESSION['type'] == 1) {

     ?>
     <!DOCTYPE html>
     <html>
     <head>
          <title>HOME AppTech</title>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="/assets/user/ad-panel.css">

          <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
          <link rel='stylesheet' href='https://unicons.iconscout.com/release/v3.0.6/css/line.css'>

     </head>
     <?php include "navbar-ad.php";?>
     <?php include "conf/dash-conf.php";?>
     <body>

          <div class="p-4">
          <h1 class="fs-3">Dashboard:</h1>

          <div class="welcome">
               <div class="content rounded-3 p-3">
               <h1 class="fs-3">Bienvenue, <?php echo $_SESSION['fullname']; ?></h1>
               <p class="mb-0">- Email : <?php echo $_SESSION['mail']; ?></p>
               <p class="mb-0">- User Type : <?php echo $_SESSION['type']; ?></p>
               <p class="mb-0">- Matriculation Number : <?php echo $_SESSION['mat']; ?></p>
               <p class="mb-0">- Today is : <?php echo date("Y-m-d"); ?></p>
               <p class="mb-0">- The time is : <?php echo date("h:i a"); ?></p>

               <?php
               $host = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
               echo $host;
               ?> 
               
               </div>

          </div>


          <section class="statistics mt-4">
               <div class="row">
               <div class="col-lg-4">
                    <div class="box d-flex rounded-2 align-items-center mb-4 mb-lg-0 p-3">
                    <i class="uil-envelope-shield fs-2 text-center bg-primary rounded-circle"></i>
                    <div class="ms-3">
                    <div class="d-flex align-items-center">
                         <h3 class="mb-0"><?php echo $count_interventions; ?></h3> <span class="d-block ms-2">Intervention</span> &#160;
                         <h3 class="mb-0"><?php echo $count_interventions_en_attente; ?></h3> <span class="d-block ms-2">En attente</span>
                    </div>
                    <p class="fs-normal mb-0">Intervention Technique</p>
                    </div>
                    </div>
               </div>
               <div class="col-lg-4">
                    <div class="box d-flex rounded-2 align-items-center mb-4 mb-lg-0 p-3">
                    <i class="uil-file fs-2 text-center bg-danger rounded-circle"></i>
                    <div class="ms-3">
                    <div class="d-flex align-items-center">
                         <h3 class="mb-0"><?php echo $count_demands; ?></h3> <span class="d-block ms-2">Demande</span> &#160;
                         <h3 class="mb-0"><?php echo $count_demands_en_attente; ?></h3> <span class="d-block ms-2">En attente</span>
                    </div>
                    <p class="fs-normal mb-0">Demande d'équipement Informatique</p>
                    </div>
                    </div>
               </div>
               <div class="col-lg-4">
                    <div class="box d-flex rounded-2 align-items-center p-3">
                    <i class="uil-users-alt fs-2 text-center bg-success rounded-circle"></i>
                    <div class="ms-3">
                    <div class="d-flex align-items-center">
                         <h3 class="mb-0"><?php echo $count_inter_cnc; ?></h3> <span class="d-block ms-2">Inter CNC</span> &#160;
                         <h3 class="mb-0"><?php echo $count_inter_cnc_en_attente; ?></h3> <span class="d-block ms-2">En attente</span>
                    </div>
                    <p class="fs-normal mb-0">Machine CNC LECTRA - Comelz...</p>
                    </div>
                    </div>
               </div>
               </div>
          </section>


          <section class="charts mt-4">
               <div class="row">
               <div class="col-lg-6">
                    <div class="chart-container rounded-2 p-3">
                    <h3 class="fs-6 mb-3">Chart title number one</h3>
                    <canvas id="myChart"></canvas>
                    </div>
               </div>
               <div class="col-lg-6">
                    <div class="chart-container rounded-2 p-3">
                    <h3 class="fs-6 mb-3">Chart title number two</h3>
                    <canvas id="myChart2"></canvas>
                    </div>
               </div>
               </div>
          </section>
          

          <section class="statis mt-4 text-center">
               <div class="row">
               <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <div class="box bg-primary p-3">
                    <i class="uil-eye"></i>
                    <h3><?php echo $count_devices; ?></h3>
                    <p class="lead">Device</p>
                    </div>
               </div>
               <div class="col-md-6 col-lg-3 mb-4 mb-lg-0">
                    <div class="box bg-danger p-3">
                    <i class="uil-user"></i>
                    <h3><?php echo $count_users; ?></h3>
                    <p class="lead">User registered</p>
                    </div>
               </div>
               <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
                    <div class="box bg-warning p-3">
                    <i class="uil-shopping-cart"></i>
                    <h3>5,154</h3>
                    <p class="lead">Product sales</p>
                    </div>
               </div>
               <div class="col-md-6 col-lg-3">
                    <div class="box bg-success p-3">
                    <i class="uil-feedback"></i>
                    <h3>5,154</h3>
                    <p class="lead">Transactions</p>
                    </div>
               </div>
               </div>
          </section>


          <!-- partial -->
     <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js'></script>
     <!-- <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>
     <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script> -->
     <script  src="/assets/user/ad-script.js"></script>
  


     </body>
     </html>

     <?php 

     }

else {
     
     header("Location: /index.php");
     exit();
}
 ?>
