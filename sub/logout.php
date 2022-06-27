<?php
session_start();

if (isset($_SESSION['user_dni'])) {
    session_destroy();
    header("Location: ../index.php");
} 