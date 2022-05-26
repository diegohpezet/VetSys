<?php
session_start();

require 'database.php';

if (isset($_SESSION['user_dni'])) {
    $records = $conn->prepare('SELECT * FROM user WHERE dni = :dni');
    $records->bindParam(':dni', $_SESSION['user_dni']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
        $user = $results;
    }
}
?>