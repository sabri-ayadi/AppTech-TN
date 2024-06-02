<?php
require dirname(__DIR__) . '/../../includes/db_connect.php';

// Initialize counts
$count_interventions = 0;
$count_demands = 0;
$count_inter_cnc = 0; 

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

$stmt = $conn->prepare("SELECT COUNT(*) FROM user");
$stmt->execute();
$stmt->bind_result($count_users);
$stmt->fetch();
$stmt->close();

?>