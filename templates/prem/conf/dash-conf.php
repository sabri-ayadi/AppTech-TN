<?php
require dirname(__DIR__) . '/../../includes/db_connect.php';

// Initialize counts
$count_interventions = 0;
$count_interventions_en_attente = 0;
$count_demands = 0;
$count_demands_en_attente = 0;
$count_inter_cnc = 0; 
$count_inter_cnc_en_attente = 0;
$count_devices = 0;
$count_devices_up = 0;
$count_devices_down = 0;
$count_users = 0;
$count_user_ad = 0;
$count_user_nr = 0;
$count_inter_corrective = 0;
$count_inter_preventive = 0;

// Query to count the number of interventions
$stmt = $conn->prepare("SELECT COUNT(*) FROM interdemande WHERE type = 'intervention'");
$stmt->execute();
$stmt->bind_result($count_interventions);
$stmt->fetch();
$stmt->close();

// Query to count the number of interventions where state is "En attente"
$stmt = $conn->prepare("SELECT COUNT(*) FROM interdemande WHERE type = 'intervention' AND state = 'En attente'");
$stmt->execute();
$stmt->bind_result($count_interventions_en_attente);
$stmt->fetch();
$stmt->close();


// Query to count the number of demands
$stmt = $conn->prepare("SELECT COUNT(*) FROM interdemande WHERE type = 'demande'");
$stmt->execute();
$stmt->bind_result($count_demands);
$stmt->fetch();
$stmt->close();

// Query to count the number of demands where state is "En attente"
$stmt = $conn->prepare("SELECT COUNT(*) FROM interdemande WHERE type = 'demande' AND state = 'En attente'");
$stmt->execute();
$stmt->bind_result($count_demands_en_attente);
$stmt->fetch();
$stmt->close();

// Query to count the number of Inter CNC
$stmt = $conn->prepare("SELECT COUNT(*) FROM cnc_inter");
$stmt->execute();
$stmt->bind_result($count_inter_cnc);
$stmt->fetch();
$stmt->close();

// Query to count the number of Inter CNC where state is "En attente"
$stmt = $conn->prepare("SELECT COUNT(*) FROM cnc_inter WHERE state = 'En attente'");
$stmt->execute();
$stmt->bind_result($count_inter_cnc_en_attente);
$stmt->fetch();
$stmt->close();

$stmt = $conn->prepare("SELECT COUNT(*) FROM device");
$stmt->execute();
$stmt->bind_result($count_devices);
$stmt->fetch();
$stmt->close();
// up devices count
$stmt = $conn->prepare("SELECT COUNT(*) FROM device WHERE state = 'Up'");
$stmt->execute();
$stmt->bind_result($count_devices_up);
$stmt->fetch();
$stmt->close();
// down devices count
$stmt = $conn->prepare("SELECT COUNT(*) FROM device WHERE state = 'Down'");
$stmt->execute();
$stmt->bind_result($count_devices_down);
$stmt->fetch();
$stmt->close();

$stmt = $conn->prepare("SELECT COUNT(*) FROM user");
$stmt->execute();
$stmt->bind_result($count_users);
$stmt->fetch();
$stmt->close();
// Admin Users
$stmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE type = '1'");
$stmt->execute();
$stmt->bind_result($count_user_ad);
$stmt->fetch();
$stmt->close();
// Normal Users
$stmt = $conn->prepare("SELECT COUNT(*) FROM user WHERE type = '2'");
$stmt->execute();
$stmt->bind_result($count_user_nr);
$stmt->fetch();
$stmt->close();

// Corrective
$stmt = $conn->prepare("SELECT COUNT(*) FROM interdemande WHERE maint = 'Corrective'");
$stmt->execute();
$stmt->bind_result($count_inter_corrective);
$stmt->fetch();
$stmt->close();

// Préventive
$stmt = $conn->prepare("SELECT COUNT(*) FROM interdemande WHERE maint = 'Préventive'");
$stmt->execute();
$stmt->bind_result($count_inter_preventive);
$stmt->fetch();
$stmt->close();

