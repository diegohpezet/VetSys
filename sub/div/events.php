<?php 
header('Content-Type: application/json');

include("../database.php");

$query = $conn->prepare("SELECT * FROM turnos WHERE status='Confirmado' AND DATE(start) >= CURDATE()");
$query->execute();

$results = $query->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($results);
?>