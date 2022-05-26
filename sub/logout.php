<?php
session_start();
header("Refresh:1; url = ../index.php");
if (isset($_SESSION['user_dni'])) {

?>
<?php
    session_destroy();
    header("Refresh:1; url = ../index.php");
} else {
?>
    <script>
        alert("Usuario no logeado");
    </script>
<?php
    header('Refresh:1; url = login.php');
}
?>