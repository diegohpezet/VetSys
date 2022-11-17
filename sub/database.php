<?php
    $server = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'medsys';

    try {
        $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die('Connection failed: '. $e->getMessage());
    }
?>